<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://getcharla.com
 * @since      1.0.0
 *
 * @package    Charla_Live_Chat
 * @subpackage Charla_Live_Chat/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Charla_Live_Chat
 * @subpackage Charla_Live_Chat/includes
 * @author     Yehia A.Salam <yehia.asalam@gmail.com>
 */
class Charla_Live_Chat_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'charla-live-chat',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
