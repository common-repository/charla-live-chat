<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://getcharla.com
 * @since             1.0.0
 * @package           Charla_Live_Chat
 *
 * @wordpress-plugin
 * Plugin Name:       Charla Live Chat
 * Plugin URI:        https://getcharla.com
 * Description:       Add Charla Live Chat Widget to your site without writing a single line of code.
 * Version:           1.2.5
 * Author:            Charla LLC
 * Author URI:		  https://getcharla.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       charla-live-chat
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CHARLA_LIVE_CHAT_VERSION', '1.2.5' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-charla-live-chat-activator.php
 */
function activate_charla_live_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-charla-live-chat-activator.php';
	Charla_Live_Chat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-charla-live-chat-deactivator.php
 */
function deactivate_charla_live_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-charla-live-chat-deactivator.php';
	Charla_Live_Chat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_charla_live_chat' );
register_deactivation_hook( __FILE__, 'deactivate_charla_live_chat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-charla-live-chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_charla_live_chat() {

	$plugin = new Charla_Live_Chat();
	$plugin->run();

}
run_charla_live_chat();
