<?php
namespace iFolders\System;

defined( 'ABSPATH' ) || exit;

use iFolders\Models\HelperModel;
use iFolders\Models\ConfigModel;
use iFolders\Models\ImportModel;
use iFolders\Models\SecurityProfilesModel;

class Settings {
    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    public function init() {
        add_action( 'admin_menu', [ $this, 'adminMenu' ] );
        add_action( 'in_admin_header', [ $this, 'removeNotices' ] );
    }

    public function adminMenu() {
       add_submenu_page(
            'options-general.php',
            'iFolders Settings',
            'iFolders',
            'manage_options',
            'ifolders-settings',
            [ $this, 'adminMenuPageSettings' ]
        );
    }

    public function adminMenuPageSettings() {
        $page = sanitize_key( filter_input( INPUT_GET, 'page', FILTER_DEFAULT ) );
        if ( $page === 'ifolders-settings' ) {
            $globals = [
                'data' => [
                    'version' => IFOLDERS_PLUGIN_VERSION,
                    'accesstypes' => [
                        'commonfolders' => [
                            'id' => SecurityProfilesModel::COMMON_FOLDERS,
                            'title' => SecurityProfilesModel::getPredefinedTitle( SecurityProfilesModel::COMMON_FOLDERS )
                        ],
                        'personalfolders' => [
                            'id' => SecurityProfilesModel::PERSONAL_FOLDERS,
                            'title' => SecurityProfilesModel::getPredefinedTitle( SecurityProfilesModel::PERSONAL_FOLDERS )
                        ],
                    ],
                    'plugins_to_import' => ImportModel::getPluginsToImport(),
                    'token' => ConfigModel::getToken()
                ],
                'msg' => HelperModel::getMessagesForSettings(),
                'api' => [
                    'nonce' => wp_create_nonce( 'wp_rest' ),
                    'url' => esc_url_raw( rest_url( IFOLDERS_PLUGIN_REST_URL ) ),
                    'license_url' => IFOLDERS_LICENSE_URL
                ]
            ];

            wp_enqueue_script( 'ifolders-feather-icons', IFOLDERS_PLUGIN_URL . 'assets/vendor/feather-icons/feather.js', [], IFOLDERS_PLUGIN_VERSION, false );
            wp_enqueue_script( 'ifolders-angular-light', IFOLDERS_PLUGIN_URL . 'assets/vendor/angular-light/angular-light.js', [], IFOLDERS_PLUGIN_VERSION, false );
            wp_enqueue_script( 'ifolders-cookies', IFOLDERS_PLUGIN_URL . 'assets/vendor/cookie/cookie.js', [], IFOLDERS_PLUGIN_VERSION, false );

            wp_enqueue_style( 'ifolders-notify', IFOLDERS_PLUGIN_URL . 'assets/css/notify.css', [], IFOLDERS_PLUGIN_VERSION );
            wp_enqueue_script( 'ifolders-notify', IFOLDERS_PLUGIN_URL . 'assets/js/notify.js', ['jquery'], IFOLDERS_PLUGIN_VERSION, false );

            wp_enqueue_style( 'ifolders-colorpicker', IFOLDERS_PLUGIN_URL . 'assets/css/colorpicker.css', [], IFOLDERS_PLUGIN_VERSION );
            wp_enqueue_script( 'ifolders-colorpicker', IFOLDERS_PLUGIN_URL . 'assets/js/colorpicker.js', ['jquery'], IFOLDERS_PLUGIN_VERSION, false );

            wp_enqueue_style( 'ifolders-settings', IFOLDERS_PLUGIN_URL . 'assets/css/settings.css', [], IFOLDERS_PLUGIN_VERSION );
            wp_enqueue_script( 'ifolders-settings', IFOLDERS_PLUGIN_URL . 'assets/js/settings.js', ['jquery'], IFOLDERS_PLUGIN_VERSION, false );
            wp_localize_script( 'ifolders-settings', 'ifolders_settings_globals', $globals);

            require_once( IFOLDERS_PLUGIN_PATH . '/includes/Views/settings.php' );
        }
    }

    public function removeNotices() {
        $page = sanitize_key( filter_input( INPUT_GET, 'page', FILTER_DEFAULT ) );
        if ( $page === 'ifolders-settings' ) {
            remove_all_actions( 'admin_notices' );
            remove_all_actions( 'all_admin_notices' );
        }
    }
}
