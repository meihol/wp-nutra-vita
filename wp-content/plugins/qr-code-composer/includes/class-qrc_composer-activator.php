<?php

/**
 * Fired during plugin activation
 *
 * @link       https://sharabindu.com
 * @since      3.0.4
 *
 * @package    Qrc_composer
 * @subpackage Qrc_composer/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      3.0.4
 * @package    Qrc_composer
 * @subpackage Qrc_composer/includes
 * @author     Sharabindu Bakshi <sharabindu86@gmail.com>
 */
class Qrc_composer_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    3.0.4
	 */
	public static function activate() {
		flush_rewrite_rules();

	}

}
