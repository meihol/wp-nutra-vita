<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com
 * @since      3.0.4
 *
 * @package    Qrc_composer
 * @subpackage Qrc_composer/includes
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
 * @since      3.0.4
 * @package    Qrc_composer
 * @subpackage Qrc_composer/includes
 * @author     Sharabindu Bakshi <sharabindu86@gmail.com>
 */


class Qrc_composer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    3.0.4
	 * @access   protected
	 * @var      Qrc_composer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    3.0.4
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    3.0.4
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    3.0.4
	 */
	public function __construct() {
		if ( defined( 'QRC_COMPOSER_VERSION' ) ) {
			$this->version = QRC_COMPOSER_VERSION;
		} else {
			$this->version = '3.0.4';
		}
		$this->plugin_name = 'qr-code-composer';
	
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		


	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Qrc_composer_Loader. Orchestrates the hooks of the plugin.
	 * - Qrc_composer_i18n. Defines internationalization functionality.
	 * - Qrc_composer_Admin. Defines all hooks for the admin area.
	 * - Qrc_composer_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    3.0.4
	 * @access   private
	 */
	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-qrc_composer-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-qrc-composer-elemnetor.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-qrc_composer-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/shortcode/class_qrc_customlinks.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-qrc_composer-public.php';

		$this->loader = new Qrc_composer_Loader();

	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    3.0.4
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Qrc_composer_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_filter( 'plugin_action_links_' .plugin_basename( dirname( __DIR__ ).'/qrc_composer.php' ), $plugin_admin, 'plugin_settings_link');

		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'adminFooterTextQR', 1, 1);


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    3.0.4
	 * @access   private
	 */
	private function define_public_hooks() {
		$options1 = get_option('qrc_autogenerate');	
    	$qrcppagelocation = isset($options1['qrcppagelocation']) ? $options1['qrcppagelocation'] : 'inatab';
		$plugin_public = new Qrc_composer_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter('the_content' , $plugin_public,'qcr_code_element');

        $checked = isset($options1['removeautodisplay']) ? 'checked' : '';
	if($qrcppagelocation === 'inatab' && !$checked ){
		$this->loader->add_filter('woocommerce_product_tabs' , $plugin_public,'woo_custom_product_tabs');

	}elseif($qrcppagelocation === 'endofpmeta' && !$checked ){

		$this->loader->add_action('woocommerce_product_meta_end', $plugin_public,'woo_qrc_tab_content');
	}elseif($qrcppagelocation === 'bellowofcart' && !$checked ){

		$this->loader->add_action('woocommerce_after_add_to_cart_form',$plugin_public,'woo_qrc_tab_content');
	}elseif($qrcppagelocation === 'abvofcart' && !$checked ){

		$this->loader->add_action('woocommerce_before_add_to_cart_form',$plugin_public,'woo_qrc_tab_content');
	}



	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    3.0.4
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     3.0.4
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     3.0.4
	 * @return    Qrc_composer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     3.0.4
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
