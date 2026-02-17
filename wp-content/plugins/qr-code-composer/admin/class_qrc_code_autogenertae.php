<?php
/**
 * The file that defines the bulk qrc_download admin area
 *
 * -facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com
 *
 * @package    qr-code-composer
 * @subpackage qr-code-composer/admin
 */
class QRC_Autogenertae_lite
{
        public function __construct()
        {
    add_action('admin_init', array($this ,'qcr_settings_page'));

    }



function qcr_settings_page()
{

    
    register_setting("qrc_autogenerate", "qrc_autogenerate", array(
        $this,
        'qrc_autogenerate_sanitize'
    ));

    add_settings_section("qrc_download_section", " ", array($this ,'settting_sec_func'), 'qrc_admin_sec');

    add_settings_field("qr_alignment", esc_html__("Alignment", "qr-code-composer") , array($this ,"qr_alignment"), 'qrc_admin_sec', "qrc_download_section",array(
            'class'  =>  'alignme', 
        'label_for' => 'qr_alignment',

    ));

    add_settings_field("removeautodisplay", esc_html__("Disable Auto Display", "qr-code-composer").'<sup class="qrcnewfrtis">NEW</sup>' , array($this ,"removeautodisplay"), 'qrc_admin_sec', "qrc_download_section",array(
            'class'  =>  'removeautodisplay',

    ));
    add_settings_field("removemetabox", esc_html__("Remove QR Code From Meta Box", "qr-code-composer").'<sup class="qrcnewfrtis">NEW</sup>' , array($this ,"removemetabox"), 'qrc_admin_sec', "qrc_download_section",array(
            'class'  =>  'removemetabox',

    ));

    if (class_exists('WooCommerce'))
    {

        add_settings_field("wc_qr_alignment", esc_html__("QR location on product page", "qr-code-composer") , array($this ,"wc_qr_alignment"), 'qrc_admin_sec', "qrc_download_section",array(
            'class'  =>  'wcalignme', 
        'label_for' => 'qrcppagelocation',

    ));

        add_settings_field("qrc_wc_ptab_name", esc_html__("Change Text of Product Tab", "qr-code-composer") ,array($this , "qrc_wc_ptab_name"), 'qrc_admin_sec', "qrc_download_section",array(
            'class'  =>  'ptab_name qrcchangeprodtab', 
        'label_for' => 'qrc_wc_ptab_name',

    ));

    }

    add_settings_field("qr_checkbox", esc_html__("Hide QR code according to post type", "qr-code-composer") ,array($this , "qr_checkbox"), 'qrc_admin_sec', "qrc_download_section" ,array(
            'class'  =>  'qr_checkbox',

    ));


    add_settings_field("qr_checkbox_page", esc_html__("Hide QR code according to Page", "qr-code-composer") , array(
        $this,
        "qr_checkbox_page"
    ) , 'qrc_admin_sec', "qrc_download_section" ,array(
            'class'  =>  'qr_checkbox_page',

    ));


    add_settings_field("qr_stcode_management", esc_html__("Shortcode for Current Page URL", "qr-code-composer") ,array($this , "qr_stcode_management"), 'qrc_admin_sec', "qrc_download_section",array(
            'class'  =>  'qr_stcode_management',

    ));

}
    
    function settting_sec_func()
    {   
       ?>
<div class="qrc-box-header" >
            <h3 class="sui-box-title"><?php echo esc_html__('Auto Generate QR', 'qr-code-composer') ?></h3>
<p><?php echo esc_html__('These QR codes are automatically displayed after the content of the web page. current page url will be used as content of QR code.', 'qr-code-composer') ?><a class="qrcdownsize" id="qrcauto" video-url="https://www.youtube.com/watch?v=LyQGEShmhn8"><span title="Video Documentation" id="qrcdocsides" class="dashicons dashicons-video-alt3"></span></a></p>

        </div>

       <?php

    }



function qr_checkbox_page(){


        $qrc_type_pages = get_posts(array(
            'post_type' => 'page',
            'posts_per_page' => - 1,
        ));
        if ($qrc_type_pages)
        {
            foreach ($qrc_type_pages as $qrc_type_page){

        $options = get_option('qrc_autogenerate');

        $checked = isset($options[$qrc_type_page->ID]) ? 'checked' : '';

            printf('<div style="margin-top:10px"><label class="qrccheckboxwrap" for ="%s">%s
  <input type="checkbox" id="%s"  value="%s" name="qrc_autogenerate[%s]" %s>
  <span class="qrccheckmark"></span>
</label></br></div>', $qrc_type_page->ID,$qrc_type_page->post_title, $qrc_type_page->ID, $qrc_type_page->ID,$qrc_type_page->ID,$checked);


        }


    
        }
    }

function qrc_wc_ptab_name()
{

    $options = get_option('qrc_autogenerate');
    $qrc_wc_ptab_name = isset($options['qrc_wc_ptab_name']) ? $options['qrc_wc_ptab_name'] : 'QR Code';

    printf('<input type="text" name="qrc_autogenerate[qrc_wc_ptab_name]" value="%s" placeholder="e:g: QR Code" id="qrc_wc_ptab_name">', $qrc_wc_ptab_name); 

}

function qr_checkbox()
{

    $args = array(
        'public' => true,
    );

        $excluded_posttypes = array('attachment','revision','nav_menu_item','custom_css','customize_changeset','oembed_cache','user_request','wp_block','scheduled-action','product_variation','shop_order','shop_order_refund','shop_coupon','elementor_library','e-landing-page','wp_template','wp_template_part','wp_navigation','wp_global_styles','shop_order_placehold');

    $types = get_post_types( $args);
    $post_types = array_diff($types, $excluded_posttypes);

    foreach ($post_types as $post_type)
    {
        $post_type_title = get_post_type_object($post_type);

        $options = get_option('qrc_autogenerate');

        $checked = isset($options[$post_type]) ? 'checked' : '';

        printf('<div><label class="qrccheckboxwrap"  for ="%s" id="qrc_label_wrap">%s
  <input  type="checkbox" id="%s" value="%s" name="qrc_autogenerate[%s]" %s>
  <span class="qrccheckmark"></span>
</label></br></div>', $post_type, $post_type, $post_type,$post_type, $post_type, $checked);




    }


}
    function removeautodisplay()
    {

        $options = get_option('qrc_autogenerate');

        $checked = isset($options['removeautodisplay']) ? 'checked' : '';

        printf('<p><input type="checkbox" id="removeautodisplay" class="qrc-apple-switch" value="removeautodisplay" name="qrc_autogenerate[removeautodisplay]" %s></p>',$checked);

    }
    function removemetabox()
    {

        $options = get_option('qrc_autogenerate');

        $checked = isset($options['removemetabox']) ? 'checked' : '';

        printf('<p><input type="checkbox" class="qrc-apple-switch" value="removemetabox" name="qrc_autogenerate[removemetabox]" %s></p>',$checked);

    }

function qr_alignment()
{

    $options = get_option('qrc_autogenerate');
    $qrc_alignment = isset($options['qrc_select_alignment']) ? $options['qrc_select_alignment'] : '';

    ?>
    <select class="select"  name="qrc_autogenerate[qrc_select_alignment]" id="qr_alignment">
        
    <option value="left" <?php echo esc_attr($qrc_alignment) == 'left' ? 'selected' : '' ?>><?php echo esc_html__('Left', 'qr-code-composer'); ?></option>
    <option value="right" <?php echo esc_attr($qrc_alignment) == 'right' ? 'selected' : '' ?>><?php echo esc_html__('Right', 'qr-code-composer'); ?></option>   
    <option value="center" <?php echo esc_attr($qrc_alignment) == 'center' ? 'selected' : '' ?>><?php echo esc_html__('Center', 'qr-code-composer'); ?></option>

    </select>

    <?php
}



/**
 * This function is a callback function of  add seeting field
 */

function wc_qr_alignment()
{

    $options = get_option('qrc_autogenerate');
    $qrc_wc_alignment = isset($options['qrcppagelocation']) ? $options['qrcppagelocation'] : 'inatab';

    ?>
    <select class="select"  name="qrc_autogenerate[qrcppagelocation]" id="qrcppagelocation">
        
    <option value="inatab" <?php echo esc_attr($qrc_wc_alignment) == 'inatab' ? 'selected' : '' ?>><?php echo esc_html__('In a tab', 'qr-code-composer'); ?></option>
    <option value="endofpmeta" <?php echo esc_attr($qrc_wc_alignment) == 'endofpmeta' ? 'selected' : '' ?>><?php echo esc_html__('End of Product Meta', 'qr-code-composer'); ?></option>    

    <option value="bellowofcart" <?php echo esc_attr($qrc_wc_alignment) == 'bellowofcart' ? 'selected' : '' ?>><?php echo esc_html__('Below the cart button', 'qr-code-composer'); ?></option>

     <option value="abvofcart" <?php echo esc_attr($qrc_wc_alignment) == 'abvofcart' ? 'selected' : '' ?>><?php echo esc_html__('Above of cart Button', 'qr-code-composer'); ?></option>   

    </select>

    <?php
}


/**
 * Qr background Color field
 */
function qr_bgcolor_management()
{

    $options = get_option('qrc_autogenerate');

    $placeholder = esc_html('Use light color for better QR scanning control', 'qr-code-composer');

    $bg_value = (isset($options['background'])) ? $options['background'] : 'transparent';
    printf('<input type="text" name="qrc_autogenerate[background]" value="%s"  id="qr_bg" class="qrc-color-picker" data-alpha-enabled="true"><p style="color:#0707ff"><em>%s</em></p>', $bg_value, $placeholder);

}

/**
 *  Qr Color field
 */

function qr_color_management()
{

    $options = get_option('qrc_autogenerate');

    $value = (isset($options['qr_color'])) ? $options['qr_color'] : '#07009b';
    
    printf('<input type="text" name="qrc_autogenerate[qr_color]" value="%s" class="qrc-color-picker" id="fill">', $value);

}

function qr_stcode_management()
{

    printf('<p class="qrcshortvar">
            <input id="qr_stcode_management" type="text" class="shortcodereadoly" value="[qrc_code_composer]" readonly >
            <button type="button" class="qrcclipbtns" data-clipboard-demo data-clipboard-target="#qr_stcode_management" title="copy shortcode"><span class="dashicons dashicons-admin-page"></span></button>
            </p>');

    printf('<div style="width:%s; padding:10px 0px"><em>'.esc_html__('For developer: ','qr-code-composer').'<span style="color:#673ab7"><em ><</em>?php echo do_shortcode["qrc_code_composer"];<em>?</em>></<em></span></div>', '90%');

}

function qrc_autogenerate_sanitize($input)
{
    $sanitary_values  = array();
    if (isset($input['qrcppagelocation']))
    {
        $sanitary_values ['qrcppagelocation'] = sanitize_text_field($input['qrcppagelocation']);
    }

    if (isset($input['qrc_select_alignment']))
    {
        $sanitary_values['qrc_select_alignment'] = sanitize_text_field($input['qrc_select_alignment']);
    }

    if (isset($input['qrc_wc_select_alignment']))
    {
        $sanitary_values['qrc_wc_select_alignment'] = sanitize_text_field($input['qrc_wc_select_alignment']);
    }  
    if (isset($input['removemetabox']))
    {
        $sanitary_values['removemetabox'] = sanitize_text_field($input['removemetabox']);
    }    

 
    if (isset($input['removeautodisplay']))
    {
        $sanitary_values['removeautodisplay'] = sanitize_text_field($input['removeautodisplay']);
    }    



    if (isset($input['qrc_wc_ptab_name']))
    {
        $sanitary_values['qrc_wc_ptab_name'] = sanitize_text_field($input['qrc_wc_ptab_name']);
    }
            
    $post_types = get_post_types();

    foreach ($post_types as $post_type)
    {

        if (isset($input[$post_type]))
        {
            $sanitary_values[$post_type] = $input[$post_type];
        }
    }
        $qrc_type_pages = get_posts(array(
            'post_type' => 'page',
            'posts_per_page' => - 1,
        ));

            foreach ($qrc_type_pages as $qrc_type_page){

            if (isset($input[$qrc_type_page->ID]))
            {
                $sanitary_values[$qrc_type_page->ID] = $input[$qrc_type_page->ID];
            }
        }
    return $sanitary_values;
}
}
if(class_exists("QRC_Autogenertae_lite")){
    new QRC_Autogenertae_lite();
}

