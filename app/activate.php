<?php

/** @var  \Herbert\Framework\Application $container */
/** @var  \Herbert\Framework\Http $http */
/** @var  \Herbert\Framework\Router $router */
/** @var  \Herbert\Framework\Enqueue $enqueue */
/** @var  \Herbert\Framework\Panel $panel */
/** @var  \Herbert\Framework\Shortcode $shortcode */
/** @var  \Herbert\Framework\Widget $widget */

include_once 'PostController.php';
define('DISABLE_WP_CRON', true);
add_action( 'my_hourly_event',  'update_db_hourly' );
public static function activate() {
    wp_schedule_event( time(), 'twicedaily', 'my_hourly_event' );
}
public static function deactivate() {
    wp_clear_scheduled_hook('my_hourly_event');
}
public function update_db_hourly() {
	$url=$_SERVER['REQUEST_URL'];
    $content = showPost($url); 
	$args = array(
   "website" => $url,
   "post" => $content
); 
	$response = wp_remote_post( 'http://onboarding.getposhaq.com/api/v1/posts', array(
    'headers'   => array('Content-Type' => 'application/json; charset=utf-8'),
    'body'      => json_encode($args), 
    'method'    => 'POST'
));

}
register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );
?>