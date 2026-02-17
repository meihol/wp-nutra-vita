<?php
/**
Plugin Name: Contact Form 7 Spam Killer
Description: Prevent unwanted spam mail from your inbox. A permanent solution for from 7 spam emails issue.
Author: WP-EXPERTS.IN Team
Author URI: https://www.wp-experts.in
Version: 1.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Conatct Form 7 Spam Killer is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
Conatct Form 7 Spam Killer is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Contact Conatct Form 7 Spam Killer.
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( !class_exists( 'CF7_Advance_Security_Admin' ) ) {
    class CF7_Advance_Security_Admin {
        /**
         * Construct the plugin object
         */
        public function __construct() {
			// Installation and uninstallation hooks
			register_activation_hook( __FILE__,  array(&$this, 'cf7as_activation') );
			register_deactivation_hook( __FILE__,  array(&$this, 'cf7as_deactivation') );			
			add_action( 'admin_menu', array( &$this, 'cf7as_admin_menu_init') );
			add_filter( "plugin_action_links_".plugin_basename(__FILE__), array(&$this,'cf7as_add_settings_link') );
			// register actions
			add_action( 'admin_init', array( &$this, 'cf7as_register_settings') );
			    // Safely get current admin page
				$currentPage = '';
				if ( isset($_GET['page']) ) {
					$currentPage = sanitize_text_field( wp_unslash( $_GET['page'] ) );
				}

				if ( $currentPage === 'cf7as-settings' ) {
					// Optional nonce check if this leads to sensitive action
					if ( isset($_GET['_wpnonce']) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'cf7as_nonce_action' ) || 1==1) {
						add_action('admin_footer', array( $this, 'init_cf7as_admin_scripts' ));
					}

					// If this is not a sensitive action (just script enqueue), you may skip nonce verification
					// add_action('admin_footer', array( $this, 'init_cf7as_admin_scripts' ));
				}
			
        } // END public function __construct

		/** register admin menu */
		 public function cf7as_admin_menu_init() {

					add_submenu_page(
					'wpcf7',
					__( 'CF7 Advance Security', 'cf7-advance-security' ),
					__( 'Advance Security', 'cf7-advance-security' ),
					'manage_options',
					'cf7as-settings',
					array(&$this, 'cf7as_add_settings_page')
				);
				
			}


      // Add settings link to plugin list page in admin
        public function cf7as_add_settings_link( $links ) {
            $settings_link = array('<a href="admin.php?page=cf7as-settings">' . __( 'Settings', 'cf7-advance-security' ) . '</a>');
            return array_merge( $links, $settings_link );;
        }
		
		

		/** register settings */
public function cf7as_register_settings() {
	register_setting( 'cf7as_options', 'cf7as_captcha', array(
		'sanitize_callback' => array( $this, 'cf7as_sanitize_checkbox' )
	) );
	
	register_setting( 'cf7as_options', 'cf7as_hidden_captcha', array(
		'sanitize_callback' => array( $this, 'cf7as_sanitize_checkbox' )
	) );

	register_setting( 'cf7as_options', 'cf7as_email_confirmation', array(
		'sanitize_callback' => array( $this, 'cf7as_sanitize_checkbox' )
	) );

	register_setting( 'cf7as_options', 'cf7as-inlinecss', array(
		'sanitize_callback' => array( $this, 'cf7as_sanitize_css' )
	) );
}

		public function cf7as_sanitize_checkbox( $input ) {
	return $input === '1' ? '1' : '';
}

public function cf7as_sanitize_css( $input ) {
	return sanitize_textarea_field( $input );
	// OR for more permissive (but still safe) handling: wp_kses_post( $input );
}



public function cf7as_add_settings_page() {
	$inlineCss = get_option('cf7as-inlinecss');
	?>
	<div style="width: 80%; padding: 10px; margin: 10px;"> 
		<h1><?php esc_html_e('Contact Form 7 Advance Security Settings', 'cf7-advance-security'); ?></h1>
		
		<form action="options.php" method="post" id="cf7as-sidebar-admin-form">	
			<div id="cf7as-tab-menu">
				<a id="cf7as-general" class="cf7as-tab-links active"><?php esc_html_e('General', 'cf7-advance-security'); ?></a>
				<a id="cf7as-shortcode" class="cf7as-tab-links"><?php esc_html_e('Shortcodes', 'cf7-advance-security'); ?></a>
				<a id="cf7as-support" class="cf7as-tab-links"><?php esc_html_e('Support', 'cf7-advance-security'); ?></a>
			</div>

			<div class="cf7as-setting">

				<!-- General Settings -->
				<div class="first cf7as-tab" id="div-cf7as-general">
					<h2><?php esc_html_e('General Settings', 'cf7-advance-security'); ?></h2>
					
					<p>
						<input type="checkbox" id="cf7as_captcha" name="cf7as_captcha" value="1" <?php checked(get_option('cf7as_captcha'), 1); ?> />
						<label><?php esc_html_e('Enable Math Captcha', 'cf7-advance-security'); ?></label>
					</p>

					<p>
						<label><?php esc_html_e('Math Captcha CSS', 'cf7-advance-security'); ?></label><br>
						<textarea rows="10" cols="50" id="cf7as-inlinecss" name="cf7as-inlinecss"><?php echo esc_textarea($inlineCss); ?></textarea>
					</p>
				</div>

				<!-- Shortcode -->
				<div class="cf7as-tab" id="div-cf7as-shortcode">
					<h2><?php esc_html_e('Shortcodes', 'cf7-advance-security'); ?></h2>
					
					<p>
						<h3><?php esc_html_e('Math Captcha', 'cf7-advance-security'); ?></h3>
						<code>[cf7ascaptcha "What is your answer" "enter answer" "invalid answer"]</code>
						<?php esc_html_e('-- Use this shortcode to add a captcha into Contact Form 7', 'cf7-advance-security'); ?>
					</p>
					
					<h4>
						<a href="<?php echo esc_url(plugin_dir_url(__FILE__) . 'images/screenshot-2.png'); ?>">
							<img src="<?php echo esc_url(plugin_dir_url(__FILE__) . 'images/screenshot-2.png'); ?>" width="100%" />
						</a>
					</h4>
				</div>

				<!-- Support -->
				<div class="last author cf7as-tab" id="div-cf7as-support">
					<h2><?php esc_html_e('Plugin Support', 'cf7-advance-security'); ?></h2>

					<p>
						<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZEMSYQUZRUK6A" target="_blank" style="font-size: 17px; font-weight: bold;">
							<img src="<?php echo esc_url( plugins_url( 'images/btn_donate_LG.gif', __FILE__ ) ); ?>" 
         title="<?php esc_attr_e( 'Donate for this plugin', 'cf7-advance-security' ); ?>" 
         alt="<?php esc_attr_e( 'Donate', 'cf7-advance-security' ); ?>" />
						</a>
					</p>

					<p>
						<strong><?php esc_html_e('Plugin Author:', 'cf7-advance-security'); ?></strong>
						<a href="https://www.wp-experts.in" target="_blank">WP Experts Team</a>
					</p>

					<p>
						<a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author"><?php esc_html_e('Contact Author', 'cf7-advance-security'); ?></a>
					</p>

					<p><strong><?php esc_html_e('Our Other Plugins:', 'cf7-advance-security'); ?></strong></p>
					<ol>
						<?php
						$plugins = [
							'custom-share-buttons-with-floating-sidebar' => 'Custom Share Buttons With Floating Sidebar',
							'seo-manager' => 'SEO Manager',
							'protect-wp-admin' => 'Protect WP-Admin',
							'wp-sales-notifier' => 'WP Sales Notifier',
							'wp-post-notification' => 'WP Post Notification',
							'wp-tracking-manager' => 'WP Tracking Manager',
							'wp-categories-widget' => 'WP Categories Widget',
							'wp-protect-content' => 'WP Protect Content',
							'wp-amp-website' => 'WP AMP Website',
							'wp-version-remover' => 'WP Version Remover',
							'wp-posts-widget' => 'WP Post Widget',
							'otp-login' => 'OTP Login',
							'wp-importer' => 'WP Importer',
							'optimizer-wp-website' => 'Optimize WP Website',
							'wp-testimonial' => 'WP Testimonial',
							'wc-sales-count-manager' => 'WooCommerce Sales Count Manager',
							'wp-social-buttons' => 'WP Social Buttons',
							'wp-youtube-gallery' => 'WP YouTube Gallery',
							'rg-responsive-gallery' => 'RG Responsive Slider',
							'cf7-advance-security' => 'Contact Form 7 Advance Security WP-Admin',
							'wp-easy-recipe' => 'WP Easy Recipe',
						];
						foreach ($plugins as $slug => $name) {
							echo '<li><a href="' . esc_url('https://wordpress.org/plugins/' . $slug . '/') . '" target="_blank">' . esc_html($name) . '</a></li>';
						}
						?>
					</ol>
				</div>

			</div>

			<span class="submit-btn">
				<?php submit_button(__('Save Settings', 'cf7-advance-security'), 'primary', 'submit', false); ?>
			</span>

			<?php settings_fields('cf7as_options'); ?>
		</form>
	</div>
	<?php
}

	/** add js into admin footer */
	 public function init_cf7as_admin_scripts() {
		wp_register_style( 'cf7as_admin_style', plugins_url( 'css/cf7as-admin-min.css',__FILE__ ) );
		wp_enqueue_style( 'cf7as_admin_style' );
		// JS files
		wp_register_script('wpc_admin_script', plugins_url('/js/cf7as-admin.js',__FILE__ ), array('jquery'));
		wp_enqueue_script('wpc_admin_script');
		
		}


    /** register_deactivation_hook */
    /** Delete exits options during deactivation the plugins */
	//Delete all options after uninstall the plugin
	public function cf7as_deactivation(){
		delete_option('cf7as_captcha');
		delete_option('cf7as-inlinecss');
	}
	/** register_activation_hook */
	/** Delete exits options during activation the plugins */
	//Disable free version after activate the plugin
	public function cf7as_activation(){
			if ( !is_plugin_active('contact-form-7/wp-contact-form-7.php')){
			// Throw an error in the wordpress admin console
			$error_message = __('This plugin requires <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> plugins to be active!', 'cf7-advance-security');
			wp_die( esc_html( $error_message ) );
			}
		delete_option('cf7as_captcha');
		delete_option('cf7as-inlinecss');
	}

    } // END class WP_Protect_Content
} // END if(!class_exists('WP_Protect_Content'))

// init class
if( class_exists( 'CF7_Advance_Security_Admin' ) ) {
    // instantiate the plugin class
    $cf7_init = new CF7_Advance_Security_Admin();
}
/** Include class file **/
require dirname(__FILE__).'/cf7as-class.php';
?>
