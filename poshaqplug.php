<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link               http://getposhaq.com/
 * @since             1.0.0
 * @package           Poshaqplug
 *
 * @wordpress-plugin
 * Plugin Name:       PoshaqPlug
 * Plugin URI:        http://getposhaq.com/
 * Description:       We add intelligence to your blogs.
 * Version:           1.0.0
 * Author:            poshaQ
 * Author URI:         http://getposhaq.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       poshaqplug
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The hook that runs during plugin activation.
 */
register_activation_hook( __FILE__, 'poshaq_activate' );
/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook( __FILE__, 'poshaq_deactivate' );
/**
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-poshaqplug.php';

/**
 * Begins execution of the plugin.
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 * @since    1.0.0
 */

function run_poshaqplug() {

	$plugin = new Poshaqplug();
	$plugin->run();

}
run_poshaqplug();

/* 
** The code that runs during plugin activation. 
*/
add_action( 'my_daily_event',  'update_poshaq_db_daily' );
	
	function poshaq_activate() {
		if ( ! wp_next_scheduled( 'my_daily_event' ) ) {
			wp_schedule_event( time(), 'twicedaily', 'my_daily_event' );
		}
	}

/* 
 ** This code will fetch published and Drafted Post data from the bloggers site. 
*/
		function update_poshaq_db_daily() {
		$articles = get_posts(
			array(
				'numberposts' => -1,
				'post_status' => array('publish', 'draft'),
				'post_type' => get_post_types('', 'names'),
			)
		);
		foreach ($articles as $article) {
			if (!get_post_meta($article->ID, '_pshq_sync', true)) {
			$args= array(
			"website"=> $_SERVER['SERVER_NAME'],
			"post"=>  $article /*$_REQUEST['post']*/
		);
			$response 	= wp_remote_post( 'http://onboarding.getposhaq.com/api/v1/posts', array(
			'headers'   => array('Content-Type' => 'application/json; charset=utf-8'),
			'body'      => json_encode($args), 
			'method'    => 'POST'
		));
				var_dump(metadata_exists($article->post_type, $article->ID, '_pshq_sync'));
				//print_r($article->ID);
				print_r($article->post_type); //this is a column? yess i guess
				update_post_meta($article->ID, '_pshq_sync', true);
				$_REQUEST['post'] = $article;
		
	 	
			}
			
		}
		
	}

/* 
 ** This will deactivate the plugin
 ** And dequeue the event which was scheduled when plugin was activated. 
*/

	function poshaq_deactivate() {
		$timestamp = wp_next_scheduled( 'my_daily_event' );
		wp_unschedule_event( $timestamp, 'my_daily_event' );
	}

?>