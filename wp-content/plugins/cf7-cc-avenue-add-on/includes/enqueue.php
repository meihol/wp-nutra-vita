<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



	// admin enqueue
	function cf7ccav_admin_enqueue() {

		// admin css
		wp_register_style( 'cf7ccav-admin-css',plugins_url('../assets/css/cfccav-admin.css',__FILE__),false,false );
		wp_enqueue_style( 'cf7ccav-admin-css' );

		// admin js
		wp_enqueue_script( 'cf7ccav-admin',plugins_url('../assets/js/admin.js',__FILE__),array( 'jquery' ),false );

	}
	add_action( 'admin_enqueue_scripts','cf7ccav_admin_enqueue' );



	// public enqueue
	function cf7ccav_public_enqueue() {

		// path
		$site_url = get_site_url();
		$path = $site_url.'/?cf7ccav_redirect=';

		// CCAvenue Options from Admin
		$options = get_option( 'cf7ccav_options' );
		
		
		// set defaults in case uplugin has been updated without savings the settings page
		if (!isset($options['failed'])) {

			$options['failed'] 			= 	'Payment Failed';
			$options['pay'] 			= 	'Pay';
			$options['processing'] 		= 	'Processing Payment';
			$options['mode_ccavenue'] 	= 	'live';
			$options['pub_key_live'] 	= 	'';

		}

		// Front css
		wp_register_style( 'cf7ccav-front-css',plugins_url('../assets/css/cfccav-front.css',__FILE__),false,false );
		wp_enqueue_style( 'cf7ccav-front-css' );
		
		// redirect method js
		wp_enqueue_script( 'cf7ccav-redirect_method' , plugins_url( '../assets/js/redirect_method.js', __FILE__ ), array( 'jquery' ), null );
		wp_localize_script( 'cf7ccav-redirect_method', 'ajax_object_cf7ccav',
			array (
				'ajax_url' 			=> admin_url('admin-ajax.php'),
				'forms' 			=> cf7ccav_forms_enabled(),
				'path'				=> $path,
				'failed' 			=> $options['cancel']
			)
		);

	}
	add_action('wp_enqueue_scripts','cf7ccav_public_enqueue',10);
