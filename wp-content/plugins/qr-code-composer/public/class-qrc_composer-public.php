<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sharabindu.com
 * @since      3.0.4
 *
 * @package    Qrc_composer
 * @subpackage Qrc_composer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Qrc_composer
 * @subpackage Qrc_composer/public
 * @author     Sharabindu Bakshi <sharabindu86@gmail.com>
 */
class Qrc_composer_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    3.0.4
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    3.0.4
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;
    public $subdomain;
    /**
     * Initialize the class and set its properties.
     *
     * @since    3.0.4
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = plugin_basename(__FILE__);
        $this->version = $version;
    
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    3.0.4
     */
    public function enqueue_styles()
    {
         wp_register_style('qrc-css', QRC_COMPOSER_URL . 'public/css/qrc.css', array() ,time(), 'all');
        wp_enqueue_style('qrc-css');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    3.0.4
     */
    public function enqueue_scripts()
    {

         wp_register_script('qr-code-styling', QRC_COMPOSER_URL . 'admin/js/qr-code-styling.js', array(
            'jquery'
        ) , time(), true);

        wp_register_script('qrccreateqr', QRC_COMPOSER_URL . 'public/js/qrcode.js', array(
        'jquery','qr-code-styling'
        ) ,time(), true);

        $options1 = get_option('qrc_composer_settings');

        $qrc_size = isset($options1['qr_code_picture_size_width']) ? $options1['qr_code_picture_size_width'] : 200;

        $quiet = isset($options1['quiet']) ? $options1['quiet'] : '0';
        $ecLevel = isset($options1['ecLevel']) ? $options1['ecLevel'] : 'L';
        $cuttenttitlr = get_the_title();

        $background = (isset($options1['background'])) ? $options1['background'] : 'transparent';
        $qr_color = (isset($options1['qr_color'])) ? $options1['qr_color'] : '#000';
        $qrc_codeshape = isset($options1['qrc_codeshape']) ? $options1['qrc_codeshape'] : 'square'; 
        $qrcomspoer_options = array(
            'size' => $qrc_size,
            'shape' => $qrc_codeshape,
            'color' => $qr_color,
            'background' => $background,
            'quiet' => $quiet,
            'ecLevel' => $ecLevel,
        );
        wp_localize_script( 'qrccreateqr', 'datas', $qrcomspoer_options ); 
        add_filter('script_loader_tag', function ($tag, $handle) {

        if (in_array($handle, ['qr-code-styling', 'qrccreateqr'], true)) {
            $tag = str_replace([' defer', ' async'], '', $tag);
            $tag = str_replace(
                '<script ',
                '<script data-no-optimize="1" data-noptimize="1" ',
                $tag
            );
        }

        return $tag;

    }, 999, 2);




    }

    /**
     * This function is display Qr code on frontend.
     */

    public function qcr_code_element($content)
    {

        $options1 = get_option('qrc_autogenerate');
        if (!empty($options1)){
            $singlular_exclude = is_singular($options1);
            $single_exclude = is_page($options1);
        }else
        {
            $singlular_exclude = '';
            $single_exclude = '';
        }
        $qrc_meta_display = get_post_meta(get_the_id() , 'qrc_metabox', true);
        $checked = isset($options1['removeautodisplay']) ? 'checked' : '';
        if ( ($qrc_meta_display == '2') or ($singlular_exclude) or (is_singular('product')) or ($single_exclude) or $checked )  {
            $content .= '';
        }elseif(function_exists('bp_search_is_search') &&
            bp_search_is_search()){
            $content .= '';
        }else{ 
        $content .= do_shortcode('[qrc_code_composer]');

             }
            return $content; 



    }


    /**
     * This function is Provide for Createing Woocomerce custom product tab for Qr Code
     */

   public function woo_custom_product_tabs($tabs)
    {

        $options1 = get_option('qrc_autogenerate');
        $qrc_wc_ptab_name = isset($options1['qrc_wc_ptab_name']) ? $options1['qrc_wc_ptab_name'] : 'QR Code';

        $tabs['qty_pricing_tab'] = array(
            'title' => $qrc_wc_ptab_name ,
            'priority' => 100,
            'callback' => array(
                $this,
                'woo_qrc_tab_content'
            )
        );

        $qrc_meta_display = get_post_meta(get_the_id() , 'qrc_metabox', true);

        if (!empty($options1))
        {
            $singlular_wc_exclude = is_singular($options1);
        }
        else
        {
            $singlular_wc_exclude = '';
        }


        $checked = isset($options1['removeautodisplay']) ? 'checked' : '';

        if ( ( $qrc_meta_display == '2' ) or ( $singlular_wc_exclude ) or $checked )
        {

            if ( isset($tabs['qty_pricing_tab']) ) {
            unset($tabs['qty_pricing_tab']); // Remove only QR Code tab
        }
        }


    return $tabs;

    }

    public function woo_qrc_tab_content()
    {
       $content = do_shortcode('[qrc_code_composer]');
        return printf('%s', $content);

    }

}

