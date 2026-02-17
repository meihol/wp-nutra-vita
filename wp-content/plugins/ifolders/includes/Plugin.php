<?php
namespace iFolders;

defined( 'ABSPATH' ) || exit;

class Plugin {
    public static function run() {
        add_action( 'plugins_loaded', [ 'iFolders\\Plugin', 'pluginsLoaded' ] );
    }

    public static function activate() {
        new System\Installer();
    }

    public static function deactivate() {
    }

    public static function pluginsLoaded() {
        new Rest\Routes();
        new Blocks\GalleryBlock();
        new System\Notice();
        new System\Folders();
        new System\Feedback();
        new System\Settings();
    }
}