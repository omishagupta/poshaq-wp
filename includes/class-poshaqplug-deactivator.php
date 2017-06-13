<?php

/**
 * Fired during plugin deactivation
 *
 * @link        http://getposhaq.com/
 * @since      1.0.0
 *
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 * @author     poshaQ < http://getposhaq.com/>
 */
 include_once 'E:\XAMPP\htdocs\wordpress\wp-content\plugins\poshaqplug\includes\class-poshaqplug-activator.php';
class Poshaqplug_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
	$timestamp = wp_next_scheduled( 'my_hourly_event' );
	wp_unschedule_event( $timestamp, 'my_hourly_event' );
	//die ("Deactivation successful") ;
	}

}
