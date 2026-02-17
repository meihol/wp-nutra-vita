<?php
$theme            = wp_get_theme( 'ekommart' );
$ekommart_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}
require get_theme_file_path('inc/class-tgm-plugin-activation.php');
$ekommart = (object) array(
	'version' => $ekommart_version,
	/**
	 * Initialize all the things.
	 */
	'main'    => require 'inc/class-main.php',
);

require get_theme_file_path('inc/functions.php');
require get_theme_file_path('inc/template-hooks.php');
require get_theme_file_path('inc/template-functions.php');

require_once get_theme_file_path('inc/merlin/vendor/autoload.php');
require_once get_theme_file_path('inc/merlin/class-merlin.php');
require_once get_theme_file_path('inc/merlin-config.php');

require_once get_theme_file_path('inc/class-customize.php');

if ( ekommart_is_woocommerce_activated() ) {
	$ekommart->woocommerce = require get_theme_file_path('inc/woocommerce/class-woocommerce.php');

	require get_theme_file_path('inc/woocommerce/class-woocommerce-adjacent-products.php');

	require get_theme_file_path('inc/woocommerce/woocommerce-functions.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-template-functions.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-template-hooks.php');
	require get_theme_file_path('inc/woocommerce/template-hooks.php');
	require get_theme_file_path('inc/woocommerce/class-woocommerce-size-chart.php');
    require get_theme_file_path('inc/woocommerce/class-woocommerce-extra.php');
    require get_theme_file_path('inc/woocommerce/class-woocommerce-gallery-video.php');
    require get_theme_file_path('inc/woocommerce/class-woocommerce-clever.php');

    if (class_exists('WeDevs_Dokan')) {
        require get_theme_file_path('inc/dokan/class-dokan.php');
        require get_theme_file_path('inc/dokan/dokan-template-functions.php');
        require get_theme_file_path('inc/dokan/dokan-template-hooks.php');
    }
}

if ( ekommart_is_elementor_activated() ) {
	require get_theme_file_path('inc/elementor/functions-elementor.php');
	$ekommart->elementor = require get_theme_file_path('inc/elementor/class-elementor.php');
	$ekommart->megamenu  = require get_theme_file_path('inc/megamenu/megamenu.php');

	require get_theme_file_path('inc/elementor/class-elementor-pro.php');
}

if ( ! is_user_logged_in() ) {
	require get_theme_file_path('inc/modules/class-login.php');
}
 ?>