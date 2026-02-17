<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Ekommart_Customize')) {

    class Ekommart_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */

            $this->init_ekommart_blog($wp_customize);

            $this->ekommart_layout($wp_customize);

            $this->ekommart_header_sticky($wp_customize);

            $this->init_ekommart_social($wp_customize);

            if (ekommart_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('ekommart_customize_register', $wp_customize);
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */

        public function ekommart_layout($wp_customize) {
            $wp_customize->add_section('ekommart_layout', array(
                'title'      => esc_html__('Layout', 'ekommart'),
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting('ekommart_options_boxed', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_boxed', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_layout',
                'label'   => esc_html__('Layout Boxed', 'ekommart'),
            ));

            $wp_customize->add_setting('ekommart_options_boxed_width', array(
                'type'              => 'option',
                'default'           => 1400,
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_boxed_width', array(
                'type'    => 'number',
                'section' => 'ekommart_layout',
                'label'   => esc_html__('Layout Boxed Max Width (px)', 'ekommart'),
            ));

        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function ekommart_header_sticky($wp_customize) {

            $wp_customize->add_section('ekommart_header_sticky', array(
                'title' => esc_html__('Header Sticky', 'ekommart'),
            ));

            $wp_customize->add_setting('ekommart_options_show_header_sticky', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_show_header_sticky', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_header_sticky',
                'label'   => esc_html__('Show Header Sticky', 'ekommart'),
            ));

            $wp_customize->add_setting('ekommart_options_color_header_sticky', array(
                'type'              => 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'ekommart_options_color_header_sticky',
                    array(
                        'label'   => __('Color Header Sticky', 'ekommart'),
                        'section' => 'ekommart_header_sticky',
                    ))
            );

            $wp_customize->add_setting('ekommart_options_background_header_sticky', array(
                'type'              => 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'ekommart_options_background_header_sticky',
                    array(
                        'label'   => __('Background Header Sticky', 'ekommart'),
                        'section' => 'ekommart_header_sticky',
                    ))
            );

        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_ekommart_blog($wp_customize) {

            $wp_customize->add_section('ekommart_blog_archive', array(
                'title' => esc_html__('Blog', 'ekommart'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('ekommart_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'blog-style-3',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_blog_style', array(
                'section' => 'ekommart_blog_archive',
                'label'   => esc_html__('Blog style', 'ekommart'),
                'type'    => 'select',
                'choices' => array(
                    'blog-style-1' => esc_html__('Blog Style 1', 'ekommart'),
                    'blog-style-2' => esc_html__('Blog Style 2', 'ekommart'),
                    'blog-style-3' => esc_html__('Blog Style 3', 'ekommart'),
                    'blog-style-4' => esc_html__('Blog Style 4', 'ekommart'),
                    'blog-style-5' => esc_html__('Blog Style 5', 'ekommart'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_ekommart_social($wp_customize) {

            $wp_customize->add_section('ekommart_social', array(
                'title' => esc_html__('Socials', 'ekommart'),
            ));
            $wp_customize->add_setting('ekommart_options_social_share', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Show Social Share', 'ekommart'),
            ));
            $wp_customize->add_setting('ekommart_options_social_share_facebook', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Share on Facebook', 'ekommart'),
            ));
            $wp_customize->add_setting('ekommart_options_social_share_twitter', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Share on Twitter', 'ekommart'),
            ));
            $wp_customize->add_setting('ekommart_options_social_share_linkedin', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Share on Linkedin', 'ekommart'),
            ));
            $wp_customize->add_setting('ekommart_options_social_share_google-plus', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Share on Google+', 'ekommart'),
            ));

            $wp_customize->add_setting('ekommart_options_social_share_pinterest', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Share on Pinterest', 'ekommart'),
            ));
            $wp_customize->add_setting('ekommart_options_social_share_email', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'ekommart_social',
                'label'   => esc_html__('Share on Email', 'ekommart'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'ekommart'),
            ));

            $wp_customize->add_section('ekommart_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'ekommart'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('ekommart_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_woocommerce_archive_layout', array(
                'section' => 'ekommart_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'ekommart'),
                'type'    => 'select',
                'choices' => array(
                    'default'      => esc_html__('Default', 'ekommart'),
                    'hide-sidebar' => esc_html__('Hide Sidebar', 'ekommart'),
                ),
            ));

            $wp_customize->add_setting('ekommart_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ekommart_options_woocommerce_archive_sidebar', array(
                'section' => 'ekommart_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'ekommart'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'ekommart'),
                    'right' => esc_html__('Right', 'ekommart'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('ekommart_woocommerce_single', array(
                'title'      => esc_html__('Single Product', 'ekommart'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('ekommart_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ekommart_options_single_product_gallery_layout', array(
                'section' => 'ekommart_woocommerce_single',
                'label'   => esc_html__('Style', 'ekommart'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'ekommart'),
                    'vertical'   => esc_html__('Vertical', 'ekommart'),
                    'gallery'    => esc_html__('Gallery', 'ekommart'),
                ),
            ));


            // =========================================
            // Product
            // =========================================

            $wp_customize->add_section('ekommart_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'ekommart'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('ekommart_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ekommart_options_wocommerce_block_style', array(
                'section' => 'ekommart_woocommerce_product',
                'label'   => esc_html__('Style', 'ekommart'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('Style 1', 'ekommart'),
                    '2' => esc_html__('Style 2', 'ekommart'),
                    '3' => esc_html__('Style 3', 'ekommart'),
                    '4' => esc_html__('Style 4', 'ekommart'),
                    '5' => esc_html__('Style 5', 'ekommart'),
                    '6' => esc_html__('Style 6', 'ekommart'),
                ),
            ));

            $wp_customize->add_setting('ekommart_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ekommart_options_woocommerce_product_hover', array(
                'section' => 'ekommart_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'ekommart'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__('None', 'ekommart'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'ekommart'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'ekommart'),
                    'right-to-left' => esc_html__('Right to Left', 'ekommart'),
                    'left-to-right' => esc_html__('Left to Right', 'ekommart'),
                    'swap'          => esc_html__('Swap', 'ekommart'),
                    'fade'          => esc_html__('Fade', 'ekommart'),
                    'zoom-in'       => esc_html__('Zoom In', 'ekommart'),
                    'zoom-out'      => esc_html__('Zoom Out', 'ekommart'),
                ),
            ));
        }
    }
}
return new Ekommart_Customize();
