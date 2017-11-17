<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.johnperricruz.com
 * @since             1.0.0
 * @package           Login_Ip_Restriction
 *
 * @wordpress-plugin
 * Plugin Name:       Login IP Restriction
 * Plugin URI:        https://github.com/johnperricruz/login-ip-restriction
 * Description:       IP Address based Restriction custom made by John Perri Cruz
 * Version:           1.0.0
 * Author:            John Perri Cruz
 * Author URI:        https://www.johnperricruz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       login-ip-restriction
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-login-ip-restriction-activator.php
 */
function activate_login_ip_restriction() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-login-ip-restriction-activator.php';
	Login_Ip_Restriction_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-login-ip-restriction-deactivator.php
 */
function deactivate_login_ip_restriction() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-login-ip-restriction-deactivator.php';
	Login_Ip_Restriction_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_login_ip_restriction' );
register_deactivation_hook( __FILE__, 'deactivate_login_ip_restriction' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-login-ip-restriction.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_login_ip_restriction() {

	$plugin = new Login_Ip_Restriction();
	$plugin->run();
	
	

}
run_login_ip_restriction();
