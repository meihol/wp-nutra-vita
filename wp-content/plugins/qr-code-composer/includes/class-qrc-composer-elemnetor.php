<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com/
 * @since      5.9.0
 *
 * @package    qrc_composer
 * @subpackage qrc_composer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      5.9.0
 * @package    qrc_composer
 * @subpackage qrc_composer/includes
 * @author     Sharabindu Bakshi <sharabindu.bakshi@gmail.com>
 */
class QrcELementorLightWidget
{
    public function __construct()
    {
        add_action("elementor/widgets/register", [
            $this,
            "register_qrc_widget",
        ]);

        add_action("elementor/frontend/after_enqueue_styles", [
            $this,
            "register_qrc_styles",
        ]);

        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_admin_style' ] );

        add_action("elementor/elements/categories_registered", [
            $this,
            "register_qrc_categories",
        ]);

    }
    function register_qrc_widget($widgets_manager)
    {
        require_once QRC_COMPOSER_PATH .
            "/includes/elements/qrc_composer_elements.php";
        // Register widget
        $widgets_manager->register(new \Qrc_Elements_Widget());
    }



    function register_qrc_styles()
    {
    
        wp_register_script(
            "qrc_elementor",
            QRC_COMPOSER_URL . "admin/js/qrc_elementor.js",
            ["jquery", "qr-code-styling"],
            QRC_COMPOSER_VERSION,
            true
        );


    }


    function widget_admin_style()
    {
        wp_enqueue_style(
            "qrc_elementor",
            QRC_COMPOSER_URL . "admin/css/qrc-elementor.css", array(),
            QRC_COMPOSER_VERSION,
            'all'
        );



    }

    function register_qrc_categories($elements_manager)
    {
        $elements_manager->add_category("qrccategory", [
            "title" => esc_html__("QR Composer", "qr-code-composer"),
            "icon" => "fa fa-plug",
        ]);
    }
}
if (class_exists("QrcELementorLightWidget")) {
    new QrcELementorLightWidget();
}
