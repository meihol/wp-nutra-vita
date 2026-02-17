<?php
/**
*
* @link       https://sharabindu.com
* @since       3.0.4
*
* @package    Qrc_composer
* @subpackage Qrc_composer/includes/
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $options1 = get_option('qrc_composer_settings');

    $current_id = get_the_ID();
    $current_title = get_the_title($current_id);
    $current_id_link = get_the_permalink($current_id);
    $qrc_meta_display = get_post_meta($current_id, 'qrc_metabox', true) ? get_post_meta($current_id, 'qrc_metabox', true) : 1;

    $qrc_qr_image = '';
    $post_types = get_post_types();
    $qrchidefrontend = isset($options1['qrchidefrontend']) ? 'checked' : '';

    $qrc_size = isset($options1['qr_code_picture_size_width']) ? $options1['qr_code_picture_size_width'] : 200;
    $qrc_dwnbtn_brdius = isset($options1['qrc_dwnbtn_brdius']) ? $options1['qrc_dwnbtn_brdius'] : '4';
    $qr_download_fntsz = isset($options1['qr_download_fntsz']) ? $options1['qr_download_fntsz'] : '12';

    $qr_dwnbtnbg_color = (isset($options1['qr_dwnbtnbg_color'])) ? $options1['qr_dwnbtnbg_color'] : '#dddddd';
    $qr_dwnbtn_color = (isset($options1['qr_dwnbtn_color'])) ? $options1['qr_dwnbtn_color'] : '#000';
    $download_qr = isset($options1['qr_download_text']) ? $options1['qr_download_text'] : 'Download QR';

    $qr_download_hide = isset($options1['qr_download_hide']) ? $options1['qr_download_hide'] : 'no';
    $qr_download_brclr = isset($options1['qr_download_brclr']) ? $options1['qr_download_brclr'] : '#dddddd';
    $qrchidefrontend = isset($options1['qrchidefrontend']) ? 'checked' : '';    
    $popupcustomqr = isset($options1['popupcustomqr']) ? 'checked' : '';
    $popupcustomqr = isset($options1['popupcustomqr']) ? 'checked' : '';
    $popupvcardqr = isset($options1['popupvcardqr']) ? 'checked' : '';

    $qrcpopupenbl = isset($options1['qrcpopupenbl']) ? 'checked' : '';

    $qrcpopup_bg = (isset($options1['qrcpopup_bg'])) ? $options1['qrcpopup_bg'] : '#dddddd';
    $qrcpopup_color = (isset($options1['qrcpopup_color'])) ? $options1['qrcpopup_color'] : '#000';
    $qrcpopup_brclr = (isset($options1['qrcpopup_brclr'])) ? $options1['qrcpopup_brclr'] : '#32a518';
    $qrcpopup_brdius = (isset($options1['qrcpopup_brdius'])) ? $options1['qrcpopup_brdius'] : '20';
    $qrcpopup_fntsize = isset($options1['qrcpopup_fntsize']) ? $options1['qrcpopup_fntsize'] : '12';

    $qrcpopuptext = isset($options1['qrcpopuptext']) ? $options1['qrcpopuptext'] : 'View QR code';

    $qrc_design_type = isset($options1['qrc_design_type']) ? $options1['qrc_design_type'] : 'popup';
    $number = isset($options1['qr_code_phonenumber']) ? $options1['qr_code_phonenumber'] : '+98732382';

    $option34 = get_option('qrc_autogenerate');
    $qrc_alignment = isset($option34['qrc_select_alignment']) ? $option34['qrc_select_alignment'] : 'left';

    $options = get_option('qrc_custom_link_generator');

    $text = isset($options['qr_code_custom_text']) ? $options['qr_code_custom_text'] : '';
    $whatsapp = isset($options['qr_code_mail_text']) ? $options['qr_code_mail_text'] : '+1895767567';
    $number = isset($options['qr_code_phonenumber']) ? $options['qr_code_phonenumber'] : '+98732382';
    $options2 = get_option('qrc_vcard_generator');

    $name = isset($options2['qrcvcardsingle_name']) ? $options2['qrcvcardsingle_name'] : '';    
    $company = isset($options2['qrcvcardsingle_company']) ? $options2['qrcvcardsingle_company'] : '';
    $subtitle = isset($options2['qrcvcardsingle_subtitle']) ? $options2['qrcvcardsingle_subtitle'] : '';
    $mobile = isset($options2['qrcvcardsingle_mbunber']) ? $options2['qrcvcardsingle_mbunber'] : '';
    $phone = isset($options2['qrcvcardsingle_pbunber']) ? $options2['qrcvcardsingle_pbunber'] : '';
    $email = isset($options2['qrcvcardsingle_email']) ? $options2['qrcvcardsingle_email'] : '';
    $address = isset($options2['qrcvcardsingle_address']) ? $options2['qrcvcardsingle_address'] : '';
    $note = isset($options2['qrcvcardsingle_note']) ? $options2['qrcvcardsingle_note'] : '';
    $website = isset($options2['qrcvcardsingle_website']) ? $options2['qrcvcardsingle_website'] : '';


    if($qrchidefrontend == 'checked' && $qrcpopupenbl != 'checked'){
    $displayblock = 'none';
    }else{
    $displayblock = 'inline-block'; 
    }