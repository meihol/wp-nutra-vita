<?php
/**

 *
 * -facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com
 *
 * @package    qr-code-composer
 * @subpackage qr-code-composer/admin
 */
class QRCoserpsgortcode{

    public $atts;

    /**
     * @return array
     */
    public function getAtts() {
        return $this->atts;
    }

    /**
     * @param $atts
     */
    public function setAtts( $atts ) {
        $this->atts = $atts;
    }

    public function __construct() {
        add_shortcode( 'qrc_code_composer', [ $this, 'currentoutput' ] );

        add_shortcode( 'qr_link_composer', [ $this, 'output' ] );

        add_shortcode( 'qrc_phonenumber', [ $this, 'phonenumber' ] );
        add_shortcode( 'qr_whatsapp_composer', [ $this, 'whatsapp' ] );   

        add_shortcode("qrc_vcard_single", [$this, "qrc_vcard_single_atts"]);

    }

    public function enqueueDelayScripts($atts) { 
        wp_enqueue_script('qrcode-composer');
        wp_enqueue_script('qrccreateqr');

    }


    /**
     * @param $atts
     * @return string
     * @throws Exception
     */
    public function phonenumber( $atts ) {
        static $i = 1;
        $i++;
        $this->enqueueDelayScripts($atts);
        $this->setAtts($atts);
        require QRC_COMPOSER_PATH . 'includes/data/data.php';

        if ($qr_download_hide == "no") {
                $qr_download_ = '<div><a download="' .$number . '.png" class="qrcdownloads">
           <button type="button" style="min-width:' . $qrc_size. "px;background:" . $qr_dwnbtnbg_color . ";color:" . $qr_dwnbtn_color . ';font-weight: 600;border: 1px solid '.$qr_download_brclr.';border-radius:'.$qrc_dwnbtn_brdius.'px;font-size:'.$qr_download_fntsz.'px;padding: 6px 0;" class="uqr_code_btn">' . esc_html($download_qr). '</button>
           </a></div>';
            } else {
                $qr_download_ = "";
            }


        $qrcelements =  '<div class="qrcswholewtapper"><div class="qrcprowrapper"  id="qrcwraa'.$i.'leds"><div class="qrc_canvass" id="qrc_phonenumer_'.$i.'" style="display:'.$displayblock.'" data-text="' . $number . '"></div>'.$qr_download_.'</div></div>';
        if($qrcpopupenbl == 'checked' && $popupcustomqr){
        $content = '<div class="qrcpromodalwrapper" style="margin: 20px 0;"><button type="button" class="qrc-modal-toggle" id="popModal_ex2" style="background:'.$qrcpopup_bg.';color:'. $qrcpopup_color.';border: 1px solid '.$qrcpopup_brclr.';border-radius:'.$qrcpopup_brdius.'px;padding: 6px 14px;font-size:'.$qrcpopup_fntsize.'px">'.esc_html($qrcpopuptext).'</button><div class="qrc_modal"><div class="qrc-overlay qrc-modal-toggle"></div><div class="qrc-modal-wrapper qrc-modal-transition"><span class="qrc-modal-toggle">&times;</span>'.$qrcelements.'</div></div></div>';

        }else{

        $content = '<div style="margin: 20px 0;">'.$qrcelements.'</div>';

        }

        return $content;
    }

   /**
     * @param $atts
     * @return string
     * @throws Exception
     */
    public function currentoutput( $atts ) {
        $this->setAtts($atts);
        $this->enqueueDelayScripts($atts);
        require QRC_COMPOSER_PATH . 'includes/data/data.php';
        static $i = 1;
        $i++;

        if ($qr_download_hide == "no") {
                $qr_download_ = '<div><a download="' .$current_title . '.png" class="qrcdownloads" id="worign">
           <button type="button" style="min-width:' . $qrc_size. "px;background:" . $qr_dwnbtnbg_color . ";color:" . $qr_dwnbtn_color . ';font-weight: 600;border: 1px solid '.$qr_download_brclr.';border-radius:'.$qrc_dwnbtn_brdius.'px;font-size:'.$qr_download_fntsz.'px;padding: 6px 0;" class="uqr_code_btn">' . esc_html($download_qr). '</button>
           </a></div>';
            } else {
                $qr_download_ = "";
            }


        $qrcelements =  '<div class="qrcswholewtapper" style="text-align:'.$qrc_alignment.';"><div class="qrcprowrapper"  id="qrcwraa'.$i.'leds"><div class="qrc_canvass" id="qrc_cuttenpages_'.$i.'" style="display:'.$displayblock.'" data-text="' . $current_id_link . '"></div>'.$qr_download_.'</div></div>';
        if($qrcpopupenbl == 'checked'){
        $content = '<div class="qrcpromodalwrapper" style="margin: 20px 0;"><button type="button" class="qrc-modal-toggle" id="popModal_ex2" style="background:'.$qrcpopup_bg.';color:'. $qrcpopup_color.';border: 1px solid '.$qrcpopup_brclr.';border-radius:'.$qrcpopup_brdius.'px;padding: 6px 14px;font-size:'.$qrcpopup_fntsize.'px">'.esc_html($qrcpopuptext).'</button><div class="qrc_modal"><div class="qrc-overlay qrc-modal-toggle"></div><div class="qrc-modal-wrapper qrc-modal-transition"><span class="qrc-modal-toggle">&times;</span>'.$qrcelements.'</div></div></div>';

        }else{

        $content = '<div style="margin: 20px 0;">'.$qrcelements.'</div>';

        }

        return $content;
   
    } 
    /**
     * @param $atts
     * @return string
     * @throws Exception
     */
    public function output( $atts ) {
        require QRC_COMPOSER_PATH . 'includes/data/data.php';
        static $i = 1;
        $i++;
        $this->enqueueDelayScripts($atts);
        $this->setAtts($atts);

        if ($qr_download_hide == "no") {
                $qr_download_ = '<div><a download="' .$text . '.png" class="qrcdownloads">
           <button type="button" style="min-width:' . $qrc_size. "px;background:" . $qr_dwnbtnbg_color . ";color:" . $qr_dwnbtn_color . ';font-weight: 600;border: 1px solid '.$qr_download_brclr.';border-radius:'.$qrc_dwnbtn_brdius.'px;font-size:'.$qr_download_fntsz.'px;padding: 6px 0;" class="uqr_code_btn">' . esc_html($download_qr). '</button>
           </a></div>';
            } else {
                $qr_download_ = "";
            }


        $qrcelements =  '<div class="qrcswholewtapper"><div class="qrcprowrapper"  id="qrcwraa'.$i.'leds"><div class="qrc_canvass" id="qrc_customtext_'.$i.'" style="display:'.$displayblock.'" data-text="' . $text . '"></div>'.$qr_download_.'</div></div>';
        if($qrcpopupenbl == 'checked' && $popupcustomqr){
        $content = '<div class="qrcpromodalwrapper" style="margin: 20px 0;"><button type="button" class="qrc-modal-toggle" id="popModal_ex2" style="background:'.$qrcpopup_bg.';color:'. $qrcpopup_color.';border: 1px solid '.$qrcpopup_brclr.';border-radius:'.$qrcpopup_brdius.'px;padding: 6px 14px;font-size:'.$qrcpopup_fntsize.'px">'.esc_html($qrcpopuptext).'</button><div class="qrc_modal"><div class="qrc-overlay qrc-modal-toggle"></div><div class="qrc-modal-wrapper qrc-modal-transition"><span class="qrc-modal-toggle">&times;</span>'.$qrcelements.'</div></div></div>';

        }else{

        $content = '<div style="margin: 20px 0;">'.$qrcelements.'</div>';

        }

        return $content;


    }    
    /**
     * @param $atts
     * @return string
     * @throws Exception
     */
    public function whatsapp( $atts ) {
        require QRC_COMPOSER_PATH . 'includes/data/data.php';
        static $i = 1;
        $i++;
        $this->enqueueDelayScripts($atts);
        $this->setAtts($atts);
        $whatsapps = 'https://wa.me/'.$whatsapp;

        if ($qr_download_hide == "no") {
                $qr_download_ = '<div><a download="' .$whatsapps . '.png" class="qrcdownloads">
           <button type="button" style="min-width:' . $qrc_size. "px;background:" . $qr_dwnbtnbg_color . ";color:" . $qr_dwnbtn_color . ';font-weight: 600;border: 1px solid '.$qr_download_brclr.';border-radius:'.$qrc_dwnbtn_brdius.'px;font-size:'.$qr_download_fntsz.'px;padding: 6px 0;" class="uqr_code_btn">' . esc_html($download_qr). '</button>
           </a></div>';
            } else {
                $qr_download_ = "";
            }


        $qrcelements =  '<div class="qrcswholewtapper"><div class="qrcprowrapper"  id="qrcwraa'.$i.'leds"><div class="qrc_canvass" id="qrc_whatapps_'.$i.'" style="display:'.$displayblock.'" data-text="' . $whatsapps . '"></div>'.$qr_download_.'</div></div>';
        if($qrcpopupenbl == 'checked' && $popupcustomqr){
        $content = '<div class="qrcpromodalwrapper" style="margin: 20px 0;"><button type="button" class="qrc-modal-toggle" id="popModal_ex2" style="background:'.$qrcpopup_bg.';color:'. $qrcpopup_color.';border: 1px solid '.$qrcpopup_brclr.';border-radius:'.$qrcpopup_brdius.'px;padding: 6px 14px;font-size:'.$qrcpopup_fntsize.'px">'.esc_html($qrcpopuptext).'</button><div class="qrc_modal"><div class="qrc-overlay qrc-modal-toggle"></div><div class="qrc-modal-wrapper qrc-modal-transition"><span class="qrc-modal-toggle">&times;</span>'.$qrcelements.'</div></div></div>';

        }else{

        $content = '<div style="margin: 20px 0;">'.$qrcelements.'</div>';

        }

        return $content;

    } /**
     * @param $atts
     * @return string
     * @throws Exception
     */
    public function qrc_vcard_single_atts( $atts ) {
        require QRC_COMPOSER_PATH . 'includes/data/data.php';
        static $i = 1;
        $i++;
        $this->enqueueDelayScripts($atts);
        $this->setAtts($atts);

        $mastervcard = "BEGIN:VCARD\nVERSION:3.0\nN:" . $name . "\nORG:" . $company . "\nTITLE:" . $subtitle . "\nTEL:" . $phone . "\nTEL:" . $mobile . "\nURL:" . $website . "\nEMAIL:" . $email . "\nADR:" . $address . "\nNOTE:" . $note . "\nEND:VCARD";

        if ($qr_download_hide == "no") {
                $qr_download_ = '<div><a download="' .$name . '.png" class="qrcdownloads">
           <button type="button" style="min-width:' . $qrc_size. "px;background:" . $qr_dwnbtnbg_color . ";color:" . $qr_dwnbtn_color . ';font-weight: 600;border: 1px solid '.$qr_download_brclr.';border-radius:'.$qrc_dwnbtn_brdius.'px;font-size:'.$qr_download_fntsz.'px;padding: 6px 0;" class="uqr_code_btn">' . esc_html($download_qr). '</button>
           </a></div>';
            } else {
                $qr_download_ = "";
            }


        $qrcelements =  '<div class="qrcswholewtapper"><div class="qrcprowrapper"  id="qrcwraa'.$i.'leds"><div class="qrc_canvass" id="qrc_vcards_'.$i.'" style="display:'.$displayblock.'" data-text="' . $mastervcard . '"></div>'.$qr_download_.'</div></div>';
        if($qrcpopupenbl == 'checked' && $popupvcardqr){
        $content = '<div class="qrcpromodalwrapper" style="margin: 20px 0;"><button type="button" class="qrc-modal-toggle" id="popModal_ex2" style="background:'.$qrcpopup_bg.';color:'. $qrcpopup_color.';border: 1px solid '.$qrcpopup_brclr.';border-radius:'.$qrcpopup_brdius.'px;padding: 6px 14px;font-size:'.$qrcpopup_fntsize.'px">'.esc_html($qrcpopuptext).'</button><div class="qrc_modal"><div class="qrc-overlay qrc-modal-toggle"></div><div class="qrc-modal-wrapper qrc-modal-transition"><span class="qrc-modal-toggle">&times;</span>'.$qrcelements.'</div></div></div>';

        }else{

        $content = '<div style="margin: 20px 0;">'.$qrcelements.'</div>';

        }

        return $content;

    }
     

}
new QRCoserpsgortcode();