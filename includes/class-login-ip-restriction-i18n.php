<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.johnperricruz.com
 * @since      1.0.0
 *
 * @package    Login_Ip_Restriction
 * @subpackage Login_Ip_Restriction/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Login_Ip_Restriction
 * @subpackage Login_Ip_Restriction/includes
 * @author     John Perri Cruz <johnperricruz@gmail.com>
 */
class Login_Ip_Restriction_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'login-ip-restriction',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
