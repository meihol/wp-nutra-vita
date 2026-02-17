<?php
/*
Plugin Name: WooCommerce Return Management
Description: A plugin to manage return orders in WooCommerce and integrate with Shipping Rocket.
Version: 1.0
Author: Your Name
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
// Add return button to orders
function wrm_add_return_button_to_orders($actions, $order) {
    // Add return button for each order
    $actions['return'] = array(
        'url'  => wp_nonce_url(admin_url('admin-ajax.php?action=wrm_initiate_return&order_id=' . $order->get_id()), 'wrm_return_order'),
        'name' => __('Return', 'woocommerce'),
    );
    return $actions;
}
add_filter('woocommerce_my_account_my_orders_actions', 'wrm_add_return_button_to_orders', 10, 2);

// Enqueue jQuery and custom script
function wrm_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('wrm-custom-js', plugin_dir_url(__FILE__) . 'js/wrm-custom.js', array('jquery'), '1.0', true);
    wp_localize_script('wrm-custom-js', 'wrm_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wrm_enqueue_scripts');

// Handle return request via AJAX
function wrm_initiate_return() {
    check_ajax_referer('wrm_return_order', 'nonce');

    $order_id = absint($_GET['order_id']);
    $user_id = get_current_user_id();

    // Verify the order belongs to the current user
    $order = wc_get_order($order_id);
    if ($order && $order->get_user_id() == $user_id) {
        // Get the order items
        $items = $order->get_items();
        $product_id = array_keys($items)[0]; // Assuming single product per order for simplicity

        // Display the reason for return form
        ?>
        <form id="return-request-form" method="post">
            <input type="hidden" name="action" value="wrm_handle_return_request">
            <input type="hidden" name="order_id" value="<?php echo esc_attr($order_id); ?>">
            <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>">
            <p>
                <label for="reason">Reason for Return:</label>
                <textarea id="reason" name="reason" required></textarea>
            </p>
            <p>
                <input type="submit" name="submit_return_request" value="Submit Return Request">
            </p>
        </form>
        <?php
    } else {
        echo 'Invalid order.';
    }
    wp_die();
}
add_action('wp_ajax_wrm_initiate_return', 'wrm_initiate_return');

// Handle return request form submission
function wrm_handle_return_request() {
    $order_id = absint($_POST['order_id']);
    $product_id = absint($_POST['product_id']);
    $reason = sanitize_textarea_field($_POST['reason']);

    // Handle the return request (e.g., save to database, notify admin)
    $return_id = wp_insert_post(array(
        'post_title' => 'Return Request for Order ' . $order_id,
        'post_content' => $reason,
        'post_status' => 'publish',
        'post_type' => 'return_request',
        'meta_input' => array(
            'order_id' => $order_id,
            'product_id' => $product_id,
            'reason' => $reason,
        ),
    ));

    // Notify the admin
    wp_mail(get_option('admin_email'), 'New Return Request', 'A new return request has been submitted for Order ' . $order_id);

    // Integrate with Shipping Rocket
    $result = wrm_create_return_shipment($order_id, $product_id);
    wp_send_json_success($result);
}
add_action('wp_ajax_nopriv_wrm_handle_return_request', 'wrm_handle_return_request');
add_action('wp_ajax_wrm_handle_return_request', 'wrm_handle_return_request');


// Function to create a return shipment with Shipping Rocket
function wrm_create_return_shipment($order_id, $product_id) {
    $api_url = 'https://api.shippingrocket.com/returns';
    $api_key = 'your_shipping_rocket_api_key';

    $response = wp_remote_post($api_url, array(
        'method' => 'POST',
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
        ),
        'body' => json_encode(array(
            'order_id' => $order_id,
            'product_id' => $product_id,
            'return_reason' => get_post_meta($order_id, 'reason', true),
        )),
    ));

    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['error'])) {
        return 'Error: ' . $data['error'];
    }

    return 'Return shipment created successfully. Tracking number: ' . $data['tracking_number'];
}
