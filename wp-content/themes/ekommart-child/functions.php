<?php

/**
 * Theme functions and definitions.
 */
function customscript(){ ?>
     <script>
        jQuery(document).ready(function(){
            jQuery('.ekommart-mobile-nav').append(`<?php echo do_shortcode('[elementor-template id="8364"]'); ?>`);
            jQuery('.ekommart-mobile-nav').append(`<?php echo do_shortcode('[elementor-template id="8389"]'); ?>`);


            const swiper = new Swiper('.swiper', {
                // Optional parameters
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
            });
        });
     </script>
<?php }
add_action('wp_footer','customscript');

function sscript(){
    wp_register_style( 'swiper-css', get_template_directory_uri() . '-child/assets/css/swiper-bundle.min.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_register_script( 'swiper-js', get_template_directory_uri() . '-child/assets/js/swiper-bundle.min.js', array(), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_style( 'swiper-css' );
    wp_enqueue_script( 'swiper-js' );
}
add_action('wp_enqueue_scripts','sscript');

function admin_sscript() {
    wp_enqueue_style('my-admin-css', get_template_directory_uri() . '-child/assets/css/admin/admin.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('admin_enqueue_scripts', 'admin_sscript');

function shortcodeforhome(){ ?>
        <?php if( have_rows('slider') ): ?>
            <div class="swiper">
                <div class="swiper-wrapper">
                  <?php while( have_rows('slider') ): the_row(); ?>
                    <?php $mobile_image = get_sub_field('mobile_image'); ?>
                    <?php $tablet_image = get_sub_field('tablet_image'); ?>
                    <?php $desktop_image = get_sub_field('desktop_image'); ?>
                    <div class="swiper-slide">
                        <picture>
                            <source media="(max-width: 691px)" srcset="<?php echo $mobile_image; ?>">
                            <source media="(max-width: 991px)" srcset="<?php echo $tablet_image; ?>">
                            <source media="(min-width: 992px)" srcset="<?php echo $desktop_image; ?>">
                            <img style="width:100%" src="<?php echo $desktop_image; ?>">
                        </picture>
                    </div>
                  <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
<?php }

add_shortcode('shortcodeforhome','shortcodeforhome');

// Develop GST Field
function ekommart_custom_woocommerce_billing_fields($fields) {
    $fields['billing_gst_number'] = array(
        'type'        => 'text',
        'label'       => __('GST Number', 'woocommerce'),
        'placeholder' => _x('Enter GST Number', 'placeholder', 'woocommerce'),
        'class'       => array('form-row-wide'),
        'required'    => false, // Set to true if you want to make it a required field
        'clear'       => true,
        'priority'    => 120,
    );
    return $fields;
}
add_filter('woocommerce_billing_fields', 'ekommart_custom_woocommerce_billing_fields');

// GST Field Place in Checkout Page
function ekommart_custom_woocommerce_checkout_fields($fields) {
    $fields['billing']['billing_gst_number'] = array(
        'type'        => 'text',
        'label'       => __('GST Number', 'woocommerce'),
        'placeholder' => _x('GST Number', 'placeholder', 'woocommerce'),
        'class'       => array('form-row-wide'),
        'required'    => false, // Set to true if you want to make it a required field
        'clear'       => true,
        'priority'    => 120,
    );
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'ekommart_custom_woocommerce_checkout_fields');

// GST Field in Admin
function ekommart_custom_woocommerce_admin_billing_fields($fields) {
    $fields['gst_number'] = array(
        'label' => __('GST Number', 'woocommerce'),
        'show'  => true,
    );
    return $fields;
}
add_filter('woocommerce_admin_billing_fields', 'ekommart_custom_woocommerce_admin_billing_fields');

// GST Field Data Save
function ekommart_save_gst_number_field($order_id) {
    if (!empty($_POST['billing_gst_number'])) {
        update_post_meta($order_id, '_billing_gst_number', sanitize_text_field($_POST['billing_gst_number']));
    }
}
add_action('woocommerce_checkout_update_order_meta', 'ekommart_save_gst_number_field');

// GST Show Admin Side
function ekommart_display_gst_number_in_admin_order_meta($order) {
    $gst_number = get_post_meta($order->get_id(), '_billing_gst_number', true);
    if ($gst_number) {
        echo '<p><strong>' . __('GST Number') . ':</strong> ' . $gst_number . '</p>';
    }
}
add_action('woocommerce_admin_order_data_after_billing_address', 'ekommart_display_gst_number_in_admin_order_meta', 10, 1);

// Add new field - usage restriction tab
function action_woocommerce_coupon_options_usage_restriction( $coupon_get_id, $coupon ) {
    woocommerce_wp_text_input( array(
        'id' => 'customer_user_id',
        'label' => __( 'User ID restrictions', 'woocommerce' ),
        'placeholder' => __( 'No restrictions', 'woocommerce' ),
        'description' => __( 'List of allowed user IDs. Separate user IDs with commas.', 'woocommerce' ),
        'desc_tip' => true,
        'type' => 'text',
    ));
}
add_action( 'woocommerce_coupon_options_usage_restriction', 'action_woocommerce_coupon_options_usage_restriction', 10, 2 );

// Save
function action_woocommerce_coupon_options_save( $post_id, $coupon ) {
    // Isset
    if ( isset ( $_POST['customer_user_id'] ) ) {
        $coupon->update_meta_data( 'customer_user_id', sanitize_text_field( $_POST['customer_user_id'] ) );
        $coupon->save();
    }
}
add_action( 'woocommerce_coupon_options_save', 'action_woocommerce_coupon_options_save', 10, 2 );

//QR Code
function add_qr_code_column($columns) {
    $columns['qr_code'] = 'QR Code';
    return $columns;
}

add_filter('manage_edit-product_columns', 'add_qr_code_column');

function display_qr_code_column($column, $post_id) {
    if ($column === 'qr_code') {
        error_log('QR Code Column Displayed for Post ID: ' . $post_id); // Debug log

        $product_data = get_permalink($post_id);
        $qr_code_url = 'https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=' . urlencode($product_data);

        echo '<img src="' . esc_url($qr_code_url) . '" alt="QR Code">';
    }
}
add_action('manage_product_posts_custom_column', 'display_qr_code_column', 10, 2);

add_filter( 'get_terms', 'exclude_category', 10, 3 );

function exclude_category( $terms, $taxonomies, $args ) {
    if ( is_shop() && is_array( $terms ) ) {
        $exclude_terms = array();
        foreach ( $terms as $key => $term ) {
            if ( 'product_cat' === $term->taxonomy && 'throwable' === $term->slug ) {
                $exclude_terms[] = $term->term_id;
            }
        }

        foreach ( $terms as $key => $term ) {
            if ( 'product_cat' === $term->taxonomy && in_array( $term->parent, $exclude_terms ) ) {
                $exclude_terms[] = $term->term_id;
            }
        }

        $filtered_terms = array();
        foreach ( $terms as $key => $term ) {
            if ( ! in_array( $term->term_id, $exclude_terms ) ) {
                $filtered_terms[] = $term;
            }
        }

        $terms = $filtered_terms;
    }

    return $terms;
}

//Throwable code
add_filter('get_terms', 'exclude_categories_except_throwable', 10, 3);

function exclude_categories_except_throwable($terms, $taxonomies, $args) {
    if (is_product_category() && !is_admin()) {
        // Get the current product category
        $current_category = get_queried_object();

        // Get the 'Throwable' category and its subcategories
        $throwable_categories = get_term_children(get_term_by('slug', 'throwable', 'product_cat')->term_id, 'product_cat');
        $throwable_categories[] = get_term_by('slug', 'throwable', 'product_cat')->term_id;

        // Filter the terms to include only 'Throwable' and its subcategories
        $filtered_terms = array();
        foreach ($terms as $term) {
            if (in_array($term->term_id, $throwable_categories) || term_is_ancestor_of($term, $current_category, 'product_cat')) {
                $filtered_terms[] = $term;
            }
        }
        $terms = $filtered_terms;
    }
    return $terms;
}
add_filter( 'get_terms', 'ts_get_subcategory_terms', 10, 3 );

function ts_get_subcategory_terms( $terms, $taxonomies, $args ) {

	$new_terms = array();

	// if it is a product category and on the shop page
	if ( in_array( 'product_cat', $taxonomies ) && ! is_admin() && is_shop() ) {

	foreach ( $terms as $key => $term ) {

		if ( ! in_array( $term->slug, array( 'Throwable' ) ) ) { //pass the slug name here
			$new_terms[] = $term;
		}
	}
	$terms = $new_terms;
	}

	return $terms;
}

function hide_throwable_products_on_shop_page( $query ) {
    // Check if it's the main query and the URL is https://nutra-vita.com/shop/
    if ( $query->is_main_query() && is_shop() && strpos( $_SERVER['REQUEST_URI'], '/shop/' ) !== false ) {
        // Get the category ID of "Throwable" category
        $category = get_term_by('name', 'Throwable', 'product_cat');

        if ( $category ) {
            // Get all the child category IDs, including "Throwable"
            $category_ids = array( $category->term_id );
            $subcategory_ids = get_term_children( $category->term_id, 'product_cat' );
            if ( ! empty( $subcategory_ids ) ) {
                $category_ids = array_merge( $category_ids, $subcategory_ids );
            }

            // Exclude products in "Throwable" category and its subcategories
            $query->set( 'tax_query', array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'id',
                    'terms'    => $category_ids,
                    'operator' => 'NOT IN',
                ),
            ) );
        }
    }
}
add_action( 'pre_get_posts', 'hide_throwable_products_on_shop_page' );

//Custom Phonepe payment Code
function phonepe_custom_payment(){
    wp_enqueue_script( 'jvalidate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js' );
    wp_enqueue_script( 'jvalidateadd', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js' );
    wp_enqueue_script( 'jvalidateaddval', get_template_directory_uri() . '-child/assets/js/phonepevalidation.js' );

    $payment_form = '<form method="post" id="phonepeform" name="phonepeform">';
        $payment_form .= wp_nonce_field('custom_phone_pe_action', 'custom_phone_pe_nonce');
        $payment_form .= '<p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">';
            $payment_form .= '<label for="billing_first_name" class="">First name&nbsp;<abbr class="required" title="required">*</abbr></label>';
            $payment_form .= '<span class="woocommerce-input-wrapper">';
                $payment_form .= '<input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name">';
            $payment_form .= '</span>';
        $payment_form .= '</p>';

        $payment_form .= '<p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">';
            $payment_form .= '<label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>';
            $payment_form .= '<span class="woocommerce-input-wrapper">';
                $payment_form .= '<input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name">';
            $payment_form .= '</span>';
        $payment_form .= '</p>';

        $payment_form .= '<p class="form-row form-row-first validate-required" id="billing_phone_field" data-priority="30">';
            $payment_form .= '<label for="billing_phonenumber" class="">Mobile Number&nbsp;<abbr class="required" title="required">*</abbr></label>';
            $payment_form .= '<span class="woocommerce-input-wrapper">';
                $payment_form .= '<input type="tel" class="input-text " name="billing_phonenumber" id="billing_phonenumber" placeholder="" value="">';
            $payment_form .= '</span>';
        $payment_form .= '</p>';

        $payment_form .= '<p class="form-row form-row-last validate-required" id="billing_email_field" data-priority="40">';
            $payment_form .= '<label for="billing_email" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>';
            $payment_form .= '<span class="woocommerce-input-wrapper">';
                $payment_form .= '<input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="">';
            $payment_form .= '</span>';
        $payment_form .= '</p>';

        $payment_form .= '<p class="form-row form-row-first validate-required" id="amount_field" data-priority="50">';
            $payment_form .= '<label for="amount" class="">Amount&nbsp;<abbr class="required" title="required">*</abbr></label>';
            $payment_form .= '<span class="woocommerce-input-wrapper">';
                $payment_form .= '<input type="number" class="input-text " name="amount" id="amount" placeholder="" value="">';
            $payment_form .= '</span>';
        $payment_form .= '</p>';

        $payment_form .= '<button type="submit" name="process_phonepe_payment">Pay with PhonePe</button>';
    $payment_form .= '</form>';

    // Handle form submission
    if (isset($_POST['custom_phone_pe_nonce']) && check_admin_referer( 'custom_phone_pe_action', 'custom_phone_pe_nonce' )) {
        // Nonce is valid; process the form data here
        // Extract and sanitize form data, perform necessary actions
        $tid = generate_transaction_id();
        $save_userdata = save_custom_phone_pe_userdata($_POST, $tid);

        if( $save_userdata ){
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // die();
            call_phone_pe_gateway($_POST, $tid);
        }else{
            echo "Error saving data";
        }
    }

    return $payment_form;
}
add_shortcode( 'phonepe_custom_payment', 'phonepe_custom_payment' );

function save_custom_phone_pe_userdata( $userdata, $tid ){
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_payment'; // Replace 'custom_table' with your actual table name

    $data = array(
        'first_name' => $userdata['billing_first_name'],
        'last_name' => $userdata['billing_last_name'],
        'phone_no' => $userdata['billing_phonenumber'],
        'email_id' => $userdata['billing_email'],
        'amount' => $userdata['amount'],
        'transaction_id' => $tid,
        'payment_status' => 0,

    );

    if($wpdb->insert($table_name, $data)){
        $_SESSION['temp_userid'] = $wpdb->insert_id;
        return true;
    }else{
        return false;
    }
    return false;
}

function generate_transaction_id($prefix = 'MT') {
    $min = pow(10, 15);  // Minimum 16-digit number
    $max = pow(10, 16) - 1;  // Maximum 16-digit number

    $random_number = mt_rand($min, $max);

    // Format the random number to ensure it's 16 digits
    $formatted_number = sprintf("%016d", $random_number);

    return $prefix.$formatted_number;
}

function call_phone_pe_gateway( $userdata, $tid, $paymentLink = null ){

    //$merchantId = 'PGTESTPAYUAT'; // sandbox or test merchantId
    $merchantId = 'NUTRAVITAONLINE'; // Live merchantId
    //$apiKey="099eb0cd-02cf-4e2a-8aca-3e6c6aff0399"; // sandbox or test APIKEY
    $apiKey="cc96a3c3-9c75-4bba-b222-3cfd2b7fefe8"; // Live APIKEY
    $redirectUrl = site_url( 'cpayment' );

    // Set transaction details
    $order_id = uniqid();
    $name=$userdata['billing_first_name'].' '.$userdata['billing_last_name'];
    $email=$userdata['billing_email'];
    $mobile=$userdata['billing_phonenumber'];
    $amount = $userdata['amount']; // amount in INR
    $description = 'Payment from '.$userdata['billing_first_name'].' '.$userdata['billing_last_name'];


    $paymentData = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' => $tid, // test transactionID
            "merchantUserId"=>"MUID123",
            'amount' => $amount*100,
            'redirectUrl'=>$redirectUrl,
            'redirectMode'=>"POST",
            'callbackUrl'=>$redirectUrl,
            "merchantOrderId"=>$order_id,
            "mobileNumber"=>$mobile,
            "message"=>$description,
            "email"=>$email,
            "shortName"=>$name,
            "paymentInstrument"=> array(
                "type"=> "PAY_PAGE",
            )
    );

    $jsonencode = json_encode($paymentData);
    $payloadMain = base64_encode($jsonencode);
    $salt_index = 1; //key index 1
    $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
    //$payload = $payloadMain . $apiKey;
    $sha256 = hash("sha256", $payload);
    $final_x_header = $sha256 . '###' . $salt_index;
    $request = json_encode(array('request'=>$payloadMain));

    $curl = curl_init();
    curl_setopt_array($curl, [
        //CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
        CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
            "X-VERIFY: " . $final_x_header,
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    // print_r($response);
    // print_r($err);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $res = json_decode($response);

        if(isset($res->success) && $res->success == '1') {
            $paymentCode = $res->code;
            $paymentMsg = $res->message;
            $payUrl = $res->data->instrumentResponse->redirectInfo->url;
            
            if($paymentLink == 1) {
                echo '
                    <button id="copyButton" class="button">Copy Payment Link</button>
                    <input type="text" id="payUrl" value="'.$payUrl.'" style="position:absolute; left:-9999px;">
                    <script>
                        document.getElementById("copyButton").addEventListener("click", function() {
                            var copyText = document.getElementById("payUrl");
                            copyText.select();
                            document.execCommand("copy");
                        });
                    </script>';
            } else {
                echo '<script>window.location.href="'.$payUrl.'"</script>';
            }
        }        
        
    }

}

require_once 'sms.php';
// Include the PhonePe SDK
// require 'vendor/autoload.php';

// use PhonePe\PhonePe;

// Initialize the PhonePe SDK
/*function initializePhonePeSDK() {
    $phonepe = PhonePe::init(
        "NUTRAVITAONLINE", // Merchant ID
        "", // Merchant User ID
        "cc96a3c3-9c75-4bba-b222-3cfd2b7fefe8", // Salt Key
        "1", // Salt Index
        "https://webhook.site/f7b80fd4-dc89-49a5-b569-d9d0a10b19c8", // Redirect URL
        "https://webhook.site/f7b80fd4-dc89-49a5-b569-d9d0a10b19c8", // Callback URL
        "DEV" // or "PROD"
    );

    return $phonepe;
}

// Create a PhonePe transaction
function createPhonePeTransaction($amountInPaisa, $userMobile) {
    $phonepe = initializePhonePeSDK();
    $transactionID = "MERCHANT" . rand(100000, 999999);

    // Create the PhonePe transaction
    $transaction = $phonepe->standardCheckout()->createTransaction($amountInPaisa, $userMobile, $transactionID);

    // Get the transaction URL
    $transactionURL = $transaction->getTransactionURL();

    return $transactionURL;
}

// Validate a PhonePe transaction
function validatePhonePeTransaction() {
    $phonepe = initializePhonePeSDK();

    // Validate and process the PhonePe transaction (use appropriate methods)
    // Example: Get the transaction response
    $transactionResponse = $phonepe->standardCheckout()->getTransactionResponse();

    // Example: Get transaction status
    $transactionStatus = $phonepe->standardCheckout()->getTransactionStatus();

    // Example: Check if the transaction is successful
    $isTransactionSuccess = $phonepe->standardCheckout()->isTransactionSuccess();

    // Implement your validation logic here

    return $transactionResponse;
}

// Add shortcode for displaying the PhonePe payment form
function phonePePaymentForm() {
    ob_start();
    ?>
    <form method="post" action="">
        <!-- Add form fields here as per your requirements -->
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="amount">Amount (in paisa):</label>
        <input type="text" id="amount" name="amount" required>
        <button type="submit" name="process_phonepe_payment">Pay with PhonePe</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('phonepe_payment_form', 'phonePePaymentForm');

// Add shortcode for processing the PhonePe payment
function processPhonePePayment() {
    if (isset($_POST['process_phonepe_payment'])) {
        // Retrieve the form data
        $full_name = sanitize_text_field($_POST['full_name']);
        $email = sanitize_email($_POST['email']);
        $amountInPaisa = intval($_POST['amount']);
        $userMobile = "9999999999"; // Replace with user's mobile number

        // Create the PhonePe transaction and get the transaction URL
        $transactionURL = createPhonePeTransaction($amountInPaisa, $userMobile);

        // Redirect to PhonePe for payment
        wp_redirect($transactionURL);
        exit;
    }
}
add_shortcode('process_phonepe_payment', 'processPhonePePayment');
*/
/**
 * Disables REFILL function in WPCF7 if Recaptcha is in use
 */

add_action('wp_enqueue_scripts', 'wpcf7_recaptcha_no_refill', 15, 0);
function wpcf7_recaptcha_no_refill() {
  $service = WPCF7_RECAPTCHA::get_instance();
	if ( ! $service->is_active() ) {
		return;
	}
  wp_add_inline_script('contact-form-7', 'wpcf7.cached = 0;', 'before' );
}

// Order Print code
// Add a Print Invoice button with a Font Awesome print icon
add_action('woocommerce_admin_order_actions_end', 'custom_print_invoice_button');
function custom_print_invoice_button($order) {
    $order_id = $order->get_id();
    echo '<a class="button tips print-invoice-button print" href="' . wp_nonce_url(admin_url('admin-ajax.php?action=print_invoice&order_id=' . $order_id), 'print_invoice') . '" target="_blank" alt="' . esc_attr__('Print Invoice', 'woocommerce') . '">';
    echo 'Print Order' . __('Print Invoice', 'woocommerce');
    echo '</a>';
}

// Handle the printing of the invoice when the button is clicked
add_action('wp_ajax_print_invoice', 'custom_print_invoice');
function custom_print_invoice() {
    if (!current_user_can('edit_shop_orders') || !check_admin_referer('print_invoice')) {
        wp_die(__('You do not have permission to access this page.', 'woocommerce'));
    }

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    if (!$order_id) {
        wp_die(__('Invalid order ID.', 'woocommerce'));
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        wp_die(__('Invalid order.', 'woocommerce'));
    }
    
    // Fetch GST number
    $gst_number = get_post_meta($order->get_id(), '_billing_gst_number', true);

    // Set up invoice HTML
    echo '<html><head><title>Invoice for Order #' . $order_id . '</title>';

    // Add some simple styles for the invoice
    echo '<style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { font-size: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background-color: #f7f7f7; }
        p { font-size: 14px; }
        .address-section { margin-bottom: 30px; }
        .nutravita-logo-wrapper {margin-bottom: 20px; }
        .nutravita-logo-inner img { max-height: 40px; margin-block-end: 30px;}
        .nutravita-company-details { margin-left: 15px;}
        .nutravita-company-name { font-size: 18px; font-weight: bold; }
        .nutravita-main-wrapper {display: grid;grid-template-columns: 1fr 1fr;gap: 50px;}
        .nutravita-order-details-wrapper {order: -1;}
        .nutravita-company-contactno .nutravita-contactno {padding-block: 15px;display: flex;}
    </style>';

    // Add JavaScript to automatically trigger the print dialog and close window after printing
    echo '<script>
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.close();
            };
        };
    </script>';

    echo '</head><body>';

    echo '<div class="nutravita-main-wrapper">';

    // Nutravita logo and company details
    echo '<div class="nutravita-logo-wrapper">
        <div class="nutravita-logo-inner">
            <img src="https://nutra-vita.com/wp-content/uploads/2024/09/logo.png" alt="nutravita-company-logo"/>
        </div>
        <div class="nutravita-company-details">
            <div class="nutravita-company-name">
                <span class="nutravita-name">Nutra Vita</span>
            </div>
            <div class="nutravita-company-contactno">
                <span class="nutravita-contactno">+91 9375888400</span>
            </div>
            <div class="nutravita-company-address">
                <span class="nutravita-address">204, Mahan Terrace, Road, opp. Bhulka Bhavan Sch, opp. Bhulka Bhavan School, Mahan Terrance, Adajan Gam, Adajan, Surat, Gujarat 395009</span>
            </div>
        </div>
    </div>';

    echo '<div class="nutravita-order-details-wrapper"><h1>Invoice for Order #' . $order_id . '</h1>';

    // Display order information
    echo '<p><strong>Order Date:</strong> ' . date_i18n('F j, Y', strtotime($order->get_date_created())) . '</p>';
    echo '<p><strong>Customer:</strong> ' . $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . '</p>';
    echo '<p><strong>Email:</strong> ' . $order->get_billing_email() . '</p>';
    
    // Display GST number if available
    if ($gst_number) {
        echo '<p><strong>GST Number:</strong> ' . esc_html($gst_number) . '</p>';
    }

    // Billing address
    echo '<div class="address-section">';
    echo '<h3>Billing Address:</h3>';
    echo '<p>' . $order->get_formatted_billing_address() . '</p>';
    echo '</div>';

    // Shipping address (only if different from billing address)
    if ( $order->get_formatted_shipping_address() ) {
        echo '<div class="address-section">';
        echo '<h3>Shipping Address:</h3>';
        echo '<p>' . $order->get_formatted_shipping_address() . '</p>';
        echo '</div>';
    }
    echo '</div></div>';

    // Display ordered items
    echo '<table>';
    echo '<thead><tr><th>Product</th><th>Quantity</th><th>Price</th></tr></thead>';
    echo '<tbody>';
    foreach ($order->get_items() as $item_id => $item) {
        $product = $item->get_product();
        echo '<tr>';
        echo '<td>' . $product->get_name() . '</td>';
        echo '<td>' . $item->get_quantity() . '</td>';
        echo '<td>' . wc_price($item->get_total()) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    // Display totals
    echo '<p><strong>Total:</strong> ' . $order->get_formatted_order_total() . '</p>';

    echo '</body></html>';

    exit;
}

// Register a custom admin page
function register_custom_payment_link_page() {
    add_menu_page(
        'Generate Payment Link', // Page title
        'Payment Link', // Menu title
        'manage_options', // Capability
        'payment-link-generator', // Menu slug
        'display_payment_link_generator_page', // Callback function
        'dashicons-money-alt', // Icon URL or Dashicons class or Font Awesome icon class
        50 // Position in menu
    );
}
add_action('admin_menu', 'register_custom_payment_link_page');

function display_payment_link_generator_page() {
    ?>
    <style>
        .payment-generator-form {
            max-width: 600px;
            margin: 20px auto;
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .payment-generator-form h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .payment-generator-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .payment-generator-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .payment-generator-form input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        .payment-generator-form input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-table {
            width: 100%;
        }

        .form-table th {
            padding-right: 15px;
            text-align: left;
            vertical-align: middle;
        }

        .form-table td {
            padding-bottom: 15px;
        }
    </style>

    <div class="payment-generator-form">
        <h1>Generate Payment Link</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="billing_first_name">First Name</label></th>
                    <td><input name="billing_first_name" type="text" id="billing_first_name" class="regular-text" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="billing_last_name">Last Name</label></th>
                    <td><input name="billing_last_name" type="text" id="billing_last_name" class="regular-text" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="billing_email">Email</label></th>
                    <td><input name="billing_email" type="email" id="billing_email" class="regular-text" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="billing_phonenumber">Phone Number</label></th>
                    <td><input name="billing_phonenumber" type="text" id="billing_phonenumber" class="regular-text" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="amount">Amount (INR)</label></th>
                    <td><input name="amount" type="number" id="amount" class="regular-text" required /></td>
                </tr>
            </table>
            <?php submit_button('Generate Payment Link'); ?>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userdata = array(
                'billing_first_name' => sanitize_text_field($_POST['billing_first_name']),
                'billing_last_name' => sanitize_text_field($_POST['billing_last_name']),
                'billing_email' => sanitize_email($_POST['billing_email']),
                'billing_phonenumber' => sanitize_text_field($_POST['billing_phonenumber']),
                'amount' => floatval($_POST['amount']),
            );

            $tid = uniqid(); // Generate a unique transaction ID

            $result = call_phone_pe_gateway($userdata, $tid, 1);
        }
        ?>
    </div>
    <?php
}
function my_custom_upload_mimes($mimes = array()) {
  $mimes['csv'] = "text/csv";
  return $mimes;
}
add_action('upload_mimes', 'my_custom_upload_mimes');
?>