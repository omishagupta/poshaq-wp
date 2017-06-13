<?php

/**
 * Fired during plugin activation
 *
 * @link        http://getposhaq.com/
 * @since      1.0.0
 *
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 * @author     poshaQ < http://getposhaq.com/>
 */
	
	
	
	class Poshaqplug_Activator{
		public function  _construct() {
		add_action( 'my_hourly_event',  'update_db_hourly' );
		
	}
	function activate() {
	
	if ( ! wp_next_scheduled( 'my_hourly_event' ) ) {
	//date_default_timezone_set('Asia/Kolkata');
	//add_filter( 'cron_schedules', 'add_cron_interval' );
    wp_schedule_event( time(), 'hourly', 'my_hourly_event' );
	}
	}
		
	/* function add_cron_interval( $schedules ) {
             $schedules["5sec"] = array(
            'interval' => 5,
            'display' => __('Once every 5 seconds'));
			return $schedules;
} */
	function update_db_hourly(){
	file_put_contents("open.txt", "w");	
	$articles = get_posts(
	array(
	'numberposts' => -1,
	'post_status' => array('publish', 'draft'),
    'post_type' => get_post_types('', 'names')
	)
	);
	$args= array(
	"website"=> "ppppp", //$_SERVER['SERVER_NAME'],
	"post"=> $articles
	);
	$response 	= wp_remote_post( 'http://onboarding.getposhaq.com/api/v1/posts', array(
    'headers'   => array('Content-Type' => 'application/json; charset=utf-8'),
    'body'      => json_encode($args), 
    'method'    => 'POST'
		)); 

	}	
}
/* function act_poshaqplug() {
	$plugin = new Poshaqplug_Activator();
	$plugin->activate();

}
act_poshaqplug();
 */?>
