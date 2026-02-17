<?php
namespace iFolders\System;

defined( 'ABSPATH' ) || exit;

class Notice {
    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    public function init() {
        add_action( 'admin_notices', [ $this, 'adminNotices' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueueScripts' ] );
    }

    public function adminNotices() {
        if ( get_option( 'ifolders_dismiss_first_use_notification', false ) || ( get_current_screen() && get_current_screen()->base === 'upload' ) ) {
            return;
        }

        $classes = [
            'notice',
            'notice-info',
            'is-dismissible',
        ];
        $msg = '<span>' . esc_html__( "Thanks for start using the plugin iFolders. Let's create first folders.", 'ifolders' ) . ' <a href="' . esc_url( admin_url('/upload.php') ) . '">' . esc_html__( "Go to WordPress Media Library.", 'ifolders' ) . '</a></span>';

        printf( '<div id="ifolders-first-use-notification" class="%s"><p>%s</p></div>', esc_html( trim( implode( ' ', $classes ) ) ), wp_kses_post ( $msg ) );
    }

    public function enqueueScripts() {
        wp_enqueue_style( 'ifolders-notice', IFOLDERS_PLUGIN_URL . 'assets/css/notice.css', [], IFOLDERS_PLUGIN_VERSION );
        wp_enqueue_script( 'ifolders-notice', IFOLDERS_PLUGIN_URL . 'assets/js/notice.js', ['jquery'], IFOLDERS_PLUGIN_VERSION, false );
        wp_localize_script( 'ifolders-notice', 'ifolders_notice_globals', $this->getGlobals() );
    }

    private function getGlobals() {
        $globals = [
            'api' => [
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'url' => esc_url_raw( rest_url( IFOLDERS_PLUGIN_REST_URL ) )
            ]
        ];
        return $globals;
    }
}