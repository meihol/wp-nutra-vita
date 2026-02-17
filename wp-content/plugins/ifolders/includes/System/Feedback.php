<?php
namespace iFolders\System;

defined( 'ABSPATH' ) || exit;

use iFolders\Models\ConfigModel;

class Feedback {
    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    public function init() {
        add_filter( 'plugin_action_links_' . IFOLDERS_PLUGIN_BASE_NAME, [ $this, 'pluginActionLinks' ], 10, 4);
        add_action( 'admin_footer', [ $this, 'adminFooter' ] );
    }

    public function adminFooter() {
        if ( get_current_screen() && get_current_screen()->base !== 'plugins' ) {
            return;
        }

        $globals = [
            'version' => IFOLDERS_PLUGIN_VERSION,
            'token' => ConfigModel::getToken(),
            'api' => [
                'feedback_url' => IFOLDERS_FEEDBACK_URL
            ]
        ];

        wp_enqueue_style( 'ifolders-feedback', IFOLDERS_PLUGIN_URL . 'assets/css/feedback.css', [], IFOLDERS_PLUGIN_VERSION );
        wp_enqueue_script( 'ifolders-feedback', IFOLDERS_PLUGIN_URL . 'assets/js/feedback.js', ['jquery'], IFOLDERS_PLUGIN_VERSION, false );
        wp_localize_script( 'ifolders-feedback', 'ifolders_feedback_globals', $globals );

        require_once( IFOLDERS_PLUGIN_PATH . '/includes/Views/feedback.php' );
    }

    public function pluginActionLinks($actions) {
        $links = [];
        $links['settings'] = '<a href="' . network_admin_url('options-general.php?page=ifolders-settings') . '">Settings</a>';

        if ( !ConfigModel::getTicket() ) {
            $links['gopro'] = '<a href="https://1.envato.market/getifolders" target="_blank" >Go Pro</a>';
        }

        return array_merge($actions, $links);
    }
}
