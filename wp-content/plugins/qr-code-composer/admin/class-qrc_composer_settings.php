<?php
/**
 * The file that defines the bulk print admin area
 *
 * public-facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com
 * @since      1.0.9
 *
 * @package    qr-code-composer
 * @subpackage qr-code-composer/admin
 */

class QR_code_Admin_settings{

        public function __construct()
        {
        add_action('admin_init', array($this ,'qcr_settings_page'));

       // add_action( 'init', array( $this, 'save_default_settings' ) );

    }

    public function qcr_settings_page()
    {

    register_setting("qrc_composer_settings", "qrc_composer_settings", array()); 
    
    add_settings_section("qrc_design_section", " ", array($this ,'settting_sec_desfifn'), 'qrc_design_sec');




    add_settings_field("qr_color_management", esc_html__("QR Color", "qr-code-composer") ,array($this , "qr_color_management"), 'qrc_design_sec', "qrc_design_section");

    add_settings_field("qr_bgcolor_management", esc_html__("QR Background Color", "qr-code-composer") , array($this ,"qr_bgcolor_management"), 'qrc_design_sec', "qrc_design_section");

    add_settings_field("qr_code_shape", esc_html__("Choose Shape", "qr-code-composer").'<sup class="qrcnewfrtis">NEW</sup>' ,array($this , "qr_code_shape"), 'qrc_design_sec', "qrc_design_section");

    add_settings_field("qr_ecLevel", esc_html__("Error Correction Level:", "qr-code-composer") ,array($this , "ecLevel"), 'qrc_design_sec', "qrc_design_section"); 

    add_settings_field("qr_quiet", esc_html__("Margin", "qr-code-composer") ,array($this , "quiet"), 'qrc_design_sec', "qrc_design_section");

    add_settings_field("qr_code_size", esc_html__("QR Code Size", "qr-code-composer") ,array($this , "qr_input_size"), 'qrc_design_sec', "qrc_design_section");
    add_settings_field("qr_download_text", esc_html__("Download QR Button", "qr-code-composer") , array($this ,"qr_download_text"), 'qrc_design_sec', "qrc_design_section");

    add_settings_field("qr_visibity_options", esc_html__("QR Code Visibility", "qr-code-composer") , array($this ,"qr_visibity_options"), 'qrc_design_sec', "qrc_design_section",array('class' =>'qrcnewfeatures qrcodevsbity')); 

    add_settings_field("qr_popup_options", esc_html__("QR Code in Popup", "qr-code-composer") , array($this ,"qr_popup_options"), 'qrc_design_sec', "qrc_design_section" , array('class' =>'qrcnewfeatures'));

    add_settings_field("qr_popup_btndesign", esc_html__("Popup button design", "qr-code-composer") , array($this ,"qr_popup_btndesign"), 'qrc_design_sec', "qrc_design_section" , array('class' =>'qrcnewqr_popup_btndesign'));


    add_settings_field("qr_popup_enablefor", esc_html__("Popup Enable For", "qr-code-composer") , array($this ,"qr_popup_enablefor"), 'qrc_design_sec', "qrc_design_section" , array('class' =>'qrcnewqr_popup_btndesign'));



    }
   /**
     * This function is a callback function of  add seeting section
     */
    function settting_sec_desfifn()
    {   
        return true;
    }

   
    function qr_checkbox_page(){

    $qrc_type_pages = get_posts(array(
            'post_type' => 'page',
            'posts_per_page' => - 1,
        ));
        if ($qrc_type_pages)
        {
            foreach ($qrc_type_pages as $qrc_type_page){

        $options = get_option('qrc_composer_settings');

        $checked = isset($options[$qrc_type_page->ID]) ? 'checked' : '';

            printf('<div style="margin-top:10px"><label class="qrccheckboxwrap" for ="%s">%s
  <input type="checkbox" id="%s"  value="%s" name="qrc_composer_settings[%s]" %s>
  <span class="qrccheckmark"></span>
</label></br></div>', esc_attr($qrc_type_page->ID),esc_html($qrc_type_page->post_title),esc_attr($qrc_type_page->ID),esc_attr($qrc_type_page->ID),esc_attr($qrc_type_page->ID),esc_attr($checked));


        }


    
        }
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

        $options = get_option('qrc_composer_settings');

        $checked = isset($options[$post_type]) ? 'checked' : '';

        printf('<div><label class="qrccheckboxwrap"  for ="%s" id="qrc_label_wrap">%s
  <input  type="checkbox" id="%s" value="%s" name="qrc_composer_settings[%s]" %s>
  <span class="qrccheckmark"></span>
</label></br></div>', esc_attr($post_type), esc_html($post_type), esc_attr($post_type),esc_attr($post_type), esc_attr($post_type), esc_attr($checked));




    }


}


/**
 * This function is a callback function of  add seeting field
 */

function ecLevel()
{

    $options = get_option('qrc_composer_settings');
    $ecLevel = isset($options['ecLevel']) ? $options['ecLevel'] : 'L'; ?>


        <select class="select" name="qrc_composer_settings[ecLevel]" id="qrdotlevel">
         <option value="L" <?php echo esc_attr($ecLevel) == 'L' ? 'selected' : '' ?>>L - low (7%)</option>
         <option value="M" <?php echo esc_attr($ecLevel) == 'M' ? 'selected' : '' ?>>M - medium (15%)</option>
         <option value="Q" <?php echo esc_attr($ecLevel) == 'Q' ? 'selected' : '' ?>>Q - quartile (25%)</option>
         <option value="H" <?php echo esc_attr($ecLevel) == 'H' ? 'selected' : '' ?>>H - high (30%)</option>
           </select>
<?php
 }

/**
 * This function is a callback function of  add seeting field
 */

    function quiet()
    {

        $options = get_option('qrc_composer_settings');
        $quiet = isset($options['quiet']) ? $options['quiet'] : '0';

            printf('<input type="number" name="qrc_composer_settings[quiet]"  id="quiet" min="0" step="1" max="100" value="%s">', esc_attr($quiet));

     }
/**
 * This function is a callback function of  add seeting field
 */

function qr_code_shape()
{

    $options = get_option('qrc_composer_settings');
    $qrc_codeshape = isset($options['qrc_codeshape']) ? $options['qrc_codeshape'] : 'square'; ?>

        <select name="qrc_composer_settings[qrc_codeshape]" id="qrc_codeshape">
        <option value="square"  <?php echo esc_attr($qrc_codeshape) == 'square' ? 'selected' : '' ?>>Square</option>
        <option value="circle" <?php echo esc_attr($qrc_codeshape) == 'circle' ? 'selected' : '' ?>>Circle</option>

        </select>
<?php
 }
/**
 * This function is a callback function of  add seeting field
 */

function qr_input_size()
{

    $options = get_option('qrc_composer_settings');
    $qrc_size = isset($options['qr_code_picture_size_width']) ? $options['qr_code_picture_size_width'] : 200;

        printf('<input type="range" class="qrcranges"  name="qrc_composer_settings[qr_code_picture_size_width]"  id="qwe_sizw" min="50" step="1" max="600" value="%s" oninput="num7.value = this.value"><input type="number" id="num7" value="%s" min="50" step="1" max="600" oninput="qwe_sizw.value = this.value">', esc_attr($qrc_size), esc_attr($qrc_size));

 }
/**
 * This function is a callback function of  add seeting field
 */

    function qr_download_text()
    {

    $options = get_option('qrc_composer_settings');
    $options_value = isset($options['qr_download_text']) ? $options['qr_download_text'] : 'Download QR';
    $qr_download_iconclass = isset($options['qr_download_iconclass']) ? $options['qr_download_iconclass'] : '';

    $qr_download_hide = isset($options['qr_download_hide']) ? $options['qr_download_hide'] : 'no';
    $qr_download_brclr = isset($options['qr_download_brclr']) ? $options['qr_download_brclr'] : '#dddddd';
    $qrc_dwnbtn_brdius = isset($options['qrc_dwnbtn_brdius']) ? $options['qrc_dwnbtn_brdius'] : '4';
    $qr_download_fntsz = isset($options['qr_download_fntsz']) ? $options['qr_download_fntsz'] : '12';

    ?>
    <div class="qrdownlaodtext">
    <strong>
    <label class="qrc_dwnbtnlabel" for="qrc_dwnbtnlabel"><?php esc_html_e('Remove?', 'qr-code-composer'); ?></label></strong>
    <select name="qrc_composer_settings[qr_download_hide]" class="qrcremovedownlaod" id="qrc_dwnbtnlabel">
        
    <option value="yes" <?php echo esc_attr($qr_download_hide) == 'yes' ? 'selected' : '' ?>><?php esc_html_e('Remove Download Button', 'qr-code-composer'); ?></option>
    <option value="no" <?php echo esc_attr($qr_download_hide) == 'no' ? 'selected' : '' ?>><?php esc_html_e('Keep Download Button', 'qr-code-composer'); ?></option>    

    </select>
   <div class="removealsscolors">
    <?php
   printf('<p><strong>
    <label class="inputetxtas" for="inputetxtas">'.esc_html("Label", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qr_download_text]" value="%s" placeholder="Download Qr" id="inputetxtas"> </p>', esc_attr($options_value)); 

        printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qr_download_fntsz">'.esc_html("Font Size", "qr-code-composer").'</label></strong><input type="number" name="qrc_composer_settings[qr_download_fntsz]" value="%s"  id="qr_download_fntsz" min="10" max="30"></p>', esc_attr($qr_download_fntsz)); 

    $value = (isset($options['qr_dwnbtn_color'])) ? $options['qr_dwnbtn_color'] : '#000';
    printf('<p class="qrc_dwnbtn"><strong>
    <label class="qrc_dwnbtnlabel" for="qr_dwnbtn_color">'.esc_html("Text Color", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qr_dwnbtn_color]" value="%s" class="qrc-btn-color-picker" id="qr_dwnbtn_color"></p>', esc_attr($value));
    $valuebg = (isset($options['qr_dwnbtnbg_color'])) ? $options['qr_dwnbtnbg_color'] : '#dddddd';
    printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qr_dwnbtnbg_color">'.esc_html("Background", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qr_dwnbtnbg_color]" value="%s" class="qrc-btn-bg-picker" id="qr_dwnbtnbg_color"></p>', esc_attr($valuebg));


    printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qr_download_brclr">'.esc_html("Border Color", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qr_download_brclr]" value="%s"  id="qr_download_brclr"></p>', esc_attr($qr_download_brclr));

    printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qrc_dwnbtn_brdius">'.esc_html("Border Radius", "qr-code-composer").'</label></strong><input type="number" name="qrc_composer_settings[qrc_dwnbtn_brdius]" value="%s"  id="qrc_dwnbtn_brdius" min="0" max="50"></p></div></div>', esc_attr($qrc_dwnbtn_brdius)); 



    }
/**
 * This function is a callback function of  add seeting field
 */

    function qr_visibity_options()
    {

    $options = get_option('qrc_composer_settings');
    $qrchidefrontend = isset($options['qrchidefrontend']) ? 'checked' : '';

        printf('<div class="onoffswitch"><input type="checkbox" value="qrchidefrontend" class="onoffswitch-checkbox" id="qrchidefrontend"  name="qrc_composer_settings[qrchidefrontend]" %s tabindex="0"><label class="onoffswitch-label" for="qrchidefrontend">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span></label></div>',esc_attr($qrchidefrontend));

        ?>

    <p class="qrcvisisbolity"><?php esc_html_e('If the Switcher is on, the QR code from the frontend will be removed and only the download button will be visible. But Clicking the download button will download the QR code instantly.', 'qr-code-composer'); ?></p>
    <?php
    }
/**
 * This function is a callback function of  add seeting field
 */

    function qr_popup_enablefor()
    {

    $options = get_option('qrc_composer_settings');
    $popupcustomqr = isset($options['popupcustomqr']) ? 'checked' : '';
    $popupvcardqr = isset($options['popupvcardqr']) ? 'checked' : '';

        printf('<div class="popupqrdefine"><p><input type="checkbox"  checked  id="popupcuurent">
    <label class="qrc_dwnbtnlabel">'.esc_html("Auto Generate QR / Current Page QR", "qr-code-composer").'</label></p>');

        printf('<p><input type="checkbox" name="qrc_composer_settings[popupcustomqr]" %s  id="popupcustomqr">
    <label class="qrc_dwnbtnlabel" for="popupcustomqr">'.esc_html("Various Components QR", "qr-code-composer").'</label></p>', esc_attr($popupcustomqr)); 

        printf('<p><input type="checkbox" name="qrc_composer_settings[popupvcardqr]" %s  id="popupvcardqr">
    <label class="qrc_dwnbtnlabel" for="popupvcardqr">'.esc_html("vCard QR", "qr-code-composer").'</label></p>', esc_attr($popupvcardqr));

        printf('<p><input type="checkbox" id="popupintegrte">
    <label class="qrc_dwnbtnlabel" for="popupintegrte">'.esc_html("Integration QR (Pro)", "qr-code-composer").'</label></p><p class="htmyrmrtdf"><span>'.esc_html("When you Checked for popup, the associated shortcode will also enable the popup behavior", "qr-code-composer").'</span></p></div>'); 
    }
/**
 * This function is a callback function of  add seeting field
 */

    function qr_popup_btndesign()
    {

    $options = get_option('qrc_composer_settings');

    $qrcpopuptext = isset($options['qrcpopuptext']) ? $options['qrcpopuptext'] : 'View To Click';
    $qrcpopup_bg = (isset($options1['qrcpopup_bg'])) ? $options1['qrcpopup_bg'] : '#dddddd';
    $qrcpopup_color = (isset($options1['qrcpopup_color'])) ? $options1['qrcpopup_color'] : '#000';
    $qrcpopup_brclr = (isset($options1['qrcpopup_brclr'])) ? $options1['qrcpopup_brclr'] : '#32a518';
    $qrcpopup_brdius = (isset($options1['qrcpopup_brdius'])) ? $options1['qrcpopup_brdius'] : '20';
    $qrcpopup_fntsize = isset($options1['qrcpopup_fntsize']) ? $options1['qrcpopup_fntsize'] : '12';
    printf('<p><strong>
    <label class="inputetxtas" for="qrcpopuptext">'.esc_html("Label", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qrcpopuptext]" value="%s" placeholder="View QR code" id="qrcpopuptext"></p>', esc_attr($qrcpopuptext)); 

        printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qrcpopup_fntsize">'.esc_html("Font Size", "qr-code-composer").'</label></strong><input type="number" name="qrc_composer_settings[qrcpopup_fntsize]" value="%s"  id="qrcpopup_fntsize" min="10" max="30"></p>', esc_attr($qrcpopup_fntsize)); 



    printf('<p class="qrc_dwnbtn"><strong>
    <label class="qrc_dwnbtnlabel" for="qrcpopup_color">'.esc_html("Color", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qrcpopup_color]" value="%s" id="qrcpopup_color"></p>', esc_attr($qrcpopup_color));



    printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qrcpopup_bg">'.esc_html("Background", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qrcpopup_bg]" value="%s" id="qrcpopup_bg"></p></div></div>', esc_attr($qrcpopup_bg));

    printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qrcpopup_brclr">'.esc_html("Border Color", "qr-code-composer").'</label></strong><input type="text" name="qrc_composer_settings[qrcpopup_brclr]" value="%s"  id="qrcpopup_brclr"></p>', esc_attr($qrcpopup_brclr));

        printf('<p><strong>
    <label class="qrc_dwnbtnlabel" for="qrcpopup_brdius">'.esc_html("Border Radius", "qr-code-composer").'</label></strong><input type="number" name="qrc_composer_settings[qrcpopup_brdius]" value="%s"  id="qrcpopup_brdius"  min="0" max="50"></p>', esc_attr($qrcpopup_brdius)); 

    }

    function qr_popup_options()
    {

    $options = get_option('qrc_composer_settings');

    $qrcpopupenbl = isset($options['qrcpopupenbl']) ? 'checked' : '';

        printf('<div class="onoffswitch"><input type="checkbox" value="qrcpopupenbl" class="onoffswitch-checkbox" id="qrcpopupenbl"  name="qrc_composer_settings[qrcpopupenbl]" %s tabindex="0"><label class="onoffswitch-label" for="qrcpopupenbl">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span></label></div>',esc_attr($qrcpopupenbl));
    }


    /**
     * Qr background Color field
     */
    function qrc_logo_image()
    { ?>


        <div class="qrcpremiumserttings">
            
            <ul>
                <li>QR eye Design</li>
                <li>Gradient Color</li>
                <li>Logo Upload</li>
            </ul>
        </div>

   <?php }
    /**
     * Qr background Color field
     */
    function qr_bgcolor_management()
    {
        $options = get_option('qrc_composer_settings');

    $bg_value = (isset($options['background'])) ? $options['background'] : 'transparent';
    printf('<input type="text" name="qrc_composer_settings[background]" value="%s"  id="qr_bg" class="qrc-color-picker">',esc_attr($bg_value));

    }

    /**
     *  Qr Color field
     */

    function qr_color_management()
    {
      $options = get_option('qrc_composer_settings');

    $qr_color = (isset($options['qr_color'])) ? $options['qr_color'] : '#000';
    printf('<input type="text" name="qrc_composer_settings[qr_color]" value="%s" class="qrc-color-picker" id="fill">',esc_attr($qr_color));

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

    function qr_stcode_management()
    {
        printf('<p class="qrcshortvar">
            <input id="qr_stcode_management" type="text" class="shortcodereadoly" value="[qrc_code_composer]" readonly >
            <button type="button" class="qrcclipbtns" data-clipboard-demo data-clipboard-target="#qr_stcode_management" title="copy shortcode"><span class="dashicons dashicons-admin-page"></span></button>
            </p>');

    printf('<div style="width:%s; padding:10px 0px"><em>'.esc_html__('For developer: ','qr-code-composer').'<span style="color:#673ab7"><em ><</em>?php echo do_shortcode["qrc_code_composer"];<em>?</em>></<em></span></div>', '90%');

    }

}

