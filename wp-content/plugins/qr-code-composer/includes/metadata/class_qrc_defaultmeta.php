<?php 


/**
 * summary
 */
class QRCDefaultmeta
{
    /**
     * summary
     */
    public function __construct()
    {

        add_action('admin_init', array($this ,'qcr_metabox_page'));
        add_action('save_post', array($this ,'qrc_save_post_meta'));
        
    }

    /**
     *  metabox function
     */

    public function qcr_metabox_page()
    {
        $excluded_posttypes = array('attachment','revision','nav_menu_item','custom_css','customize_changeset','oembed_cache','user_request','wp_block','scheduled-action','product_variation','shop_order','shop_order_refund','shop_coupon','elementor_library','e-landing-page');

        $types = get_post_types();
        $post_types = array_diff($types, $excluded_posttypes);

        $options12 = get_option('qrc_autogenerate');

        $checked = isset($options12['removemetabox']) ? 'checked' : '';
        if(!$checked ){

        add_meta_box('qrccompoer_metabox', esc_html__('QR Code Composer', 'qr-code-composer') , array(
            $this,
            'qrc_metabox_func'
        ) , array(
            $post_types
        ));
    }

    }

    /**
     * This is call back function of add_meta_box
     */

    public function qrc_metabox_func($post)
    {
        wp_enqueue_script('qrccreateqr');
        wp_enqueue_style('qrc-admin-css');
        $qrc_meta_check_info = get_post_meta($post->ID, 'qrc_metabox', true) ? get_post_meta($post->ID, 'qrc_metabox', true) : 1;
        require QRC_COMPOSER_PATH . 'includes/data/data.php';
        
    ?>
        <ul class="qrcomposeroutput_wrap">
        <li class="qrcmetalintitle">
            <h3><?php esc_html_e('Hide QR Code', 'qr-code-composer') ?></h3>
            <p><?php esc_html_e('Remove QR code from front end. When you select yes the QR code will be removed from the frontend of this page but will remain here', 'qr-code-composer') ?></p>
            </li><li class="qrcmetalinkchekc">
                <select name="qrc_select_field" class=" qrc_metaoutput">
                    
                <option value="1" <?php echo esc_attr($qrc_meta_check_info) == 1 ? 'selected' : '' ?>><?php esc_html_e('No', 'qr-code-composer'); ?></option>
                <option value="2" <?php echo esc_attr($qrc_meta_check_info) == 2 ? 'selected' : '' ?>><?php esc_html_e('Yes', 'qr-code-composer'); ?></option>

                </select>
            </li>
        <?php

echo  '<li class="qrcmetaqrcode"><div class="qrcswholewtapper"><div class="qrcprowrapper"><div class="qrc_canvass" id="qrc_cuurentlinks" data-text="'.esc_attr($current_id_link).'" style="width:'.esc_attr($qrc_size).'px;display:inline-block"></div><div><a class="qrcdownloads" download="' . esc_attr($current_title) . '.png"><button type="button" style="min-width:' . esc_attr($qrc_size) . 'px;" class="button button-secondary is-button is-default is-large">' . esc_html($download_qr) . '</button></a></div></div></div></li></ul>';



    }

    /**
     * This function save meta data
     */

    public function qrc_save_post_meta($post_id)
    {

    $nonce = wp_create_nonce( 'qrc-nonce' );
    if ( ! wp_verify_nonce( $nonce, 'qrc-nonce' ) ) return;

        if (array_key_exists('qrc_select_field', $_POST))
        {

            update_post_meta($post_id, 'qrc_metabox', sanitize_text_field(wp_unslash($_POST['qrc_select_field'])));
        }

    }
}
if(class_exists('QRCDefaultmeta')){

    new QRCDefaultmeta();
}