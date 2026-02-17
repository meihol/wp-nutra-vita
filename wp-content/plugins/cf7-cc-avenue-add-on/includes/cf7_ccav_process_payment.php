<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed


	// returns the form id of the forms that have ccavenue enabled
	function cf7ccav_forms_enabled() {

		// array that will contain which forms ccavenue is enabled on
		$enabled = array();
		
		$args = array(
			'posts_per_page'   => 999,
			'post_type'        => 'wpcf7_contact_form',
			'post_status'      => 'publish',
		);
		$posts_array = get_posts( $args) ;
		
		
		// loop through them and find out which ones have ccavenue enabled
		foreach( $posts_array as $post ) {
			
			$post_id = $post->ID;
			
			// paypal
			$enable = get_post_meta( $post_id, "_cf7ccav_enable", true );
			
			if ($enable == "1") {
				$enabled[] = $post_id.'|ccavenue';
			}
			
			// ccavenue
			$enable_ccavenue = get_post_meta( $post_id, "_cf7ccav_enable_ccavenue", true);
			
			if ($enable == "1") {
				$enabled[] = $post_id.'|ccavenue';
			}
			
		}


		return json_encode($enabled);

	}


	// hook for after form submit into contact form 7
	add_action( 'template_redirect' , 'cf7ccav_redirect_method' );
	function cf7ccav_redirect_method() {

		if ( isset( $_GET['cf7ccav_redirect'] ) ) {

			// get the id from the cf7ccav_before_send_mail function theme redirect
			$post_id = $_GET['cf7ccav_redirect'];

			cf7ccav_redirect( $post_id );
			exit;

		}
	}


	// hook into contact form 7 - before redirection after form submit
	add_action( 'wpcf7_before_send_mail', 'cf7ccav_before_send_mail' );
	function cf7ccav_before_send_mail() {

		$wpcf7 = WPCF7_ContactForm::get_current();

		// need to save submission for later and the variables get lost in the cf7 javascript redirect
		$submission_orig = WPCF7_Submission::get_instance();

		if ( $submission_orig ) {
			// get form post id
			$posted_data 		= 	$submission_orig->get_posted_data();
			
			$options 			= 	get_option( 'cf7ccav_options' );
			
			$post_id 			= 	$posted_data['_wpcf7'];
			$amount_total 		= 	get_post_meta( $post_id, "_cf7ccav_price", true );
			
			$enable 			= 	get_post_meta( $post_id, "_cf7ccav_enable", true );
			$enable_ccavenue 	= 	get_post_meta( $post_id, "_cf7ccav_enable_ccavenue", true );
			
			
			
			if ( $enable == '1' ) {
				$gateway = 'ccavenue';
			}
			
			
			if ( !isset( $options['default_symbol'] ) ) {
				$options['currency'] 	= 'INR';
			}
			
			
			
			if ( isset( $options['mode'] ) ) {
				if ( $options['mode'] == "1" ) {
					$tags['ccavenue_state'] = "test";
				} else {
					$tags['ccavenue_state'] = "live";
				}
			} else {
				$tags['ccavenue_state'] = "live";
			}

			$_SESSION['gateway'] 		= 	$gateway;
			$_SESSION['amount_total'] 	= 	$amount_total;
			$_SESSION['currency'] 		= 	$options['currency'];
			$_SESSION['ccavenue_state'] = 	$tags['ccavenue_state'];
		}
	}


	add_action( 'wp_ajax_cf7ccav_get_form_post' , 'cf7ccav_get_form_post_callback' );
	add_action( 'wp_ajax_nopriv_cf7ccav_get_form_post' , 'cf7ccav_get_form_post_callback' );
	
	function cf7ccav_get_form_post_callback() {

		$response = array(
			'gateway' => $_SESSION['gateway']
		);
		
		echo json_encode( $response );

		wp_die();
	}


	// return ccavenue payment form
	add_action( 'wp_ajax_cf7ccav_get_form_ccavenue' , 'cf7ccav_get_form_ccavenue_callback' );
	add_action( 'wp_ajax_nopriv_cf7ccav_get_form_ccavenue' , 'cf7ccav_get_form_ccavenue_callback' );
	function cf7ccav_get_form_ccavenue_callback() {

		// generate nonce
		$salt = wp_salt();
		$nonce = wp_create_nonce('cf7ccav_'.$salt);

		$options = get_option('cf7ccav_options');
		
		
		$result = '';
		
	
		// show ccavenue test mode div
		if ($_SESSION['ccavenue_state'] == 'test') {
			$result .= "<a href='#' target='_blank' class='cf7ccav-test-mode'>Sandbox Testing</a>";
		}
		include_once( plugin_dir_path( __FILE__ ) . 'ccavenue/crypto.php' );

		// CCAvenue Minimum Required data		
		$merchant_id 	= 	$options['merchant_id'];
		$order_id 		= 	$post_id;
		$currency 		= 	$options['currency'];
		$redirect_url 	= 	$options['return'];
		$cancel_url 	= 	$options['cancel'];

		$merchant_data	=	$options['merchant_id'];
		$working_key	=	$options['working_key'];//Shared by CCAVENUES
		$access_code	=	$options['access_code'];//Shared by CCAVENUES
		
		foreach ($_POST as $key => $value){
			$merchant_data	.=	$key.'='.$value.'&';
		}

		$encrypted_data=encrypt($merchant_data,$working_key);

		$result .= '<div class="cf7ccav_ccavenue_container">';
			$result .= '<div class="cf7ccav_ccavenue_heading cf7ccav_bottom_sep_white"><label>'.__('Payment Details','cf7-ccavenue').'</label></div>';
			$result .= '<form id="ccavenue" method="post" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">';
				$result .= "<div class='cf7ccav_body'>";
					$result .= "<div class='cf7ccav_row cf7ccav_bottom_sep_white'>";
						$result .= "<div class='cf7ccav_details_input'>";
							$result .= '<label class="sub_head">'.$options['title'].'</label><br/><span>'.$options['description'].'</span>';
						$result .= "</div>";

					$result .= "</div>";
					$result .= "<div class='cf7ccav_row cf7ccav_bottom_sep_white'>";
						$result .= "<div class='cf7ccav_details_input'>";
							$result .= "<div class='cf7ccav_amount_text'>";
								$result .= __('Amount to Pay - ','cf7-ccavenue');
							$result .= "</div>";
							$result .= "<div class='cf7ccav_amount_pay'>";
								$result .= "".$options['pay']." ".$options['currency']." ".$_SESSION['amount_total']."";
							$result .= "</div>";							
						$result .= "</div>";

					$result .= "</div>";
					$result .= "<div id='card-errors' role='alert'></div>";
					$result .= "<br />&nbsp;<input id='cf7ccav-ccavenue-submit' value='".__('Proceed to CCAvenue','cf7-ccavenue')."' type='submit'>";
				$result .= "<div>";
			$result .= '<input type="hidden" id="cf7ccav_ccavenue_nonce" value="$nonce">';
			$result .= '<input type=hidden name="encRequest" value="'. $encrypted_data. '">';
			$result .= '<input type="hidden" name="Amount" value="'.$_SESSION['amount_total'].'">';
			$result .= '<input type="hidden" name="access_code" value="'. $access_code .'">';
			$result .= '<input type="hidden" name="currency" value="'.$currency.'"/>';

			

			$result .= "</form>";
		$result .= "<div>";
		$result .= '<div class="ccav_branding" ><img src="'. plugins_url( '../assets/img/ccavenue.png', __FILE__ ) . '" /></div>';


		$response = array(
			'html' 	=> $result,
		);

		echo json_encode($response);
		wp_die();
	}