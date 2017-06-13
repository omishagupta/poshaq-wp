<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link        http://getposhaq.com/
 * @since      1.0.0
 *
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 * @author     poshaQ < http://getposhaq.com/>
 */
class Poshaqplug_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'poshaqplug',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
