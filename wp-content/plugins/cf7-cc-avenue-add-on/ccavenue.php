<?php
/*
Plugin Name: Contact Form 7 - CC Avenue Add-on
Plugin URI: https://masiwebsol.com/ccavenue/
Description: Integrates CCAvenue Payment Gateway with Contact Form 7
Author: Mahesh Bisen
Text Domain: cf7-ccavenue
Author URI: https://masiwebsol.com
License: GPL2
Version: 1.0
*/

/*  Copyright 2018 Mahesh Bisen

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/



// plugin variable: cf7ccav


//  plugin functions
register_activation_hook( 	__FILE__, "cf7ccav_activate" );
register_deactivation_hook( __FILE__, "cf7ccav_deactivate" );
register_uninstall_hook( 	__FILE__, "cf7ccav_uninstall" );

function cf7ccav_activate() {
	
	// default options
	$cf7ccav_options = array(
		'currency'    		=> '25',
		'language'    		=> '3',
		'liveaccount'    	=> '',
		'sandboxaccount'    => '',
		'mode' 				=> '2',
		'cancel'    		=> '',
		'return'    		=> '',
		'redirect'			=> '2',
		'pub_key_live'		=> '',
		'sec_key_live'		=> '',
		'pub_key_test'		=> '',
		'sec_key_test'		=> '',
	);
	
	add_option("cf7ccav_options", $cf7ccav_options);
	
}

function cf7ccav_deactivate() {	
	delete_option("cf7ccav_my_plugin_notice_shown");
}

function cf7ccav_uninstall() {
}

// check to make sure contact form 7 is installed and active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {		
	
	// public includes
	include_once('includes/functions.php');
	include_once('includes/cf7_ccav_process_payment.php');
	include_once('includes/enqueue.php');
	
	// admin includes
	if (is_admin()) {
		include_once('includes/admin/tabs_page.php');
		include_once('includes/admin/settings_page.php');
		include_once('includes/admin/menu_links.php');
	}
	
	
	// start session if not already started
	function cf7ccav_session() {
		if(!session_id()) {
			session_start();
		}
	}
	add_action('init', 'cf7ccav_session', 1);
	
	
} else {
	
	// give warning if contact form 7 is not active
	function cf7ccav_my_admin_notice() {
		?>
		<div class="error">
			<p><?php _e( '<b>Contact Form 7 - CCAvenue Add-on:</b> Contact Form 7 is not installed and / or active! Please install <a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.', 'cf7ccav' ); ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'cf7ccav_my_admin_notice' );
	
}

add_action( 'plugins_loaded', 'cf7ccavenue_load_textdomain' );
function cf7ccavenue_load_textdomain() {
	load_plugin_textdomain( 'cf7-ccavenue', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

?>