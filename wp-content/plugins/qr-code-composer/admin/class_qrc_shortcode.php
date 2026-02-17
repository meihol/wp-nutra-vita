<?php
/**
 * The file that defines the bulk print admin area
 *
 * public-facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com
 * @since      3.1.0
 *
 * @package    qr-code-composer
 * @subpackage qr-code-composer/admin
 */
class QRC_Shortcode_lite {
    public function __construct() {

        add_action("show_user_profile", [$this, "qrc_user_profile_fields"]);
        add_action("edit_user_profile", [$this, "qrc_user_profile_fields"]);
        add_action("woocommerce_account_dashboard", [$this, "qrc_woo_accountdash", ]);
    }

    function qrc_user_profile_fields($user) {
    ?>
    <h3><?php esc_html_e("Profile QR Code", "qr-code-composer"); ?> <small><?php esc_html_e("(QR code composer)", "qr-code-composer"); ?></small></h3> 
    <?php
        wp_enqueue_script('qrccreateqr');
        static $i = 1;
        $i++;
        $user_id = $user->ID;
        $options = get_option("qrc_composer_settings");
        $size = isset($options["qr_code_picture_size_width"]) ? $options["qr_code_picture_size_width"] : 200;
        $user_info = get_userdata($user_id);
        $name = $user_info->first_name . " " . $user_info->last_name;
        $user_email = $user_info->user_email;
        $user_url = $user_info->user_url;
        $description = $user_info->description;
        $mastervcard = "BEGIN:VCARD\nVERSION:3.0\nN:" . $name . "\nEMAIL:" . $user_email . "\nNOTE:" . $description . "\nEND:VCARD";
        return printf('<div class="qrcswholewtapper"><div class="qrcprowrapper"><div class="qrc_canvass"  id="qrcwrausd_'.esc_attr(get_the_ID()).'" style="width:'.esc_attr($size).'px;display:inline-block" data-text="'. esc_attr($mastervcard). '"></div><div><a class="qrcdownloads" download="' . esc_attr($name) . '.png"><button type="button" class="button button-secondary is-button is-default is-large" style="width:' . esc_attr($size) . 'px;">' . esc_html__("Download QR", "qr-code-composer") . '</button></a></div></div></div>');
    }
    function qrc_woo_accountdash() {
    if (class_exists("WooCommerce")) {
    require QRC_COMPOSER_PATH . 'includes/data/data.php';

    static $i = 1;
    $i++; 
    $options3 = get_option('qrc_admin_integrate');
    $qrcvcardmyacdash = isset($options3['qrc_vcard_myacdash']) ? 'checked' : '';
    if($qrcvcardmyacdash != 'checked'){
     wp_enqueue_script('qrccreateqr');
            $user_meta = get_current_user_id();
            $user_info = get_userdata($user_meta);
            $name = $user_info->first_name . " " . $user_info->last_name;
            $user_email = $user_info->user_email;
            $user_url = $user_info->user_url;
            $description = $user_info->description;
        if ($qr_download_hide == "no") {
                $qr_download_ = '<div><a download="' .$name . '.png" class="qrcdownloads">
           <button type="button" style="min-width:' . $qrc_size. "px;background:" . $qr_dwnbtnbg_color . ";color:" . $qr_dwnbtn_color . ';font-weight: 600;border: 1px solid '.$qr_download_brclr.';border-radius:'.$qrc_dwnbtn_brdius.'px;font-size:'.$qr_download_fntsz.'px;padding: 6px 0;" class="uqr_code_btn">' . esc_html($download_qr) . '</button>
           </a></div>';
            } else {
                $qr_download_ = "";
            }
        $mastervcard3 = "BEGIN:VCARD\nVERSION:3.0\nN:" . $name . "\nEMAIL:" . $user_email . "\nNOTE:" . $description . "\nEND:VCARD";

        echo '<div class="qrcswholewtapper"><div class="qrcprowrapper"  id="qrcmastervcard'.esc_attr($i).'leds"><div class="qrc_canvass" id="qrcmastervcard3'.esc_attr($i).'" style="display:inline-block" data-text="'.esc_attr($mastervcard3).'"></div>'.wp_kses_post($qr_download_).'</div></div>';

        }
        }

    }
    
}
if (class_exists("QRC_Shortcode_lite")) {
    new QRC_Shortcode_lite();
}
