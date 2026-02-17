<?php
/**
 * Plugin Name: iFolders - Ultimate Folder Organizer for Media Library, Pages, Posts and Users
 * Plugin URI: https://1.envato.market/getifolders
 * Description: A better way to organize WordPress media library, posts, pages, users & custom post types in a logical way. Just drag & drop items into folders you and use them easely.
 * Version: 2.9.1
 * Requires at least: 4.6
 * Requires PHP: 7.4
 * Author: Avirtum
 * Author URI: https://1.envato.market/avirtum
 * License: GPLv3
 * Text Domain: ifolders
 * Domain Path: /languages
 */
namespace iFolders;

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'iFolders\\Plugin' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/Fallbacks/plugin-exist.php';
    add_action( 'admin_init', function() { deactivate_plugins( plugin_basename( __FILE__ ) ); } );
    return;
}

define( 'IFOLDERS_PLUGIN_NAME', 'ifolders' );
define( 'IFOLDERS_PLUGIN_VERSION', '2.9.1' );
define( 'IFOLDERS_PLUGIN_DB_VERSION', '2.0.0');
define( 'IFOLDERS_PLUGIN_DB_TABLE_PREFIX', 'ifolders' );
define( 'IFOLDERS_PLUGIN_SHORTCODE_NAME', 'ifolders' );
define( 'IFOLDERS_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'IFOLDERS_PLUGIN_PATH', __DIR__ );
define( 'IFOLDERS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'IFOLDERS_PLUGIN_REST_URL', 'ifolders/v1' );
define( 'IFOLDERS_PLUGIN_PUBLIC_REST_URL', 'ifolders/public/v1' );
define( 'IFOLDERS_FEEDBACK_URL', 'https://avirtum.com/api/feedback/' );
define( 'IFOLDERS_LICENSE_URL', 'https://avirtum.com/api/license/' );

register_activation_hook( __FILE__, [ 'iFolders\\Plugin', 'activate' ] );
register_deactivation_hook( __FILE__, [ 'iFolders\\Plugin', 'deactivate' ] );

require_once( __DIR__ . '/vendor/autoload.php' );
require_once( __DIR__ . '/includes/autoload.php' );

Plugin::run();