<?php

class Ekommart_Merlin_Config {

	private $config = [];
	private $wizard;

	public function __construct() {
		$this->init();
		add_action( 'merlin_import_files', [ $this, 'import_files' ] );
		add_action( 'merlin_after_all_import', [ $this, 'after_import_setup' ], 10, 1 );
		add_filter( 'merlin_generate_child_functions_php', [ $this, 'render_child_functions_php' ] );

        add_action( 'admin_post_custom_setup_data', [$this, 'custom_setup_data' ]);
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'), 10);
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
	}

    public function admin_scripts() {
        global $ekommart_version;
        wp_enqueue_script('ekommart-admin-script', get_template_directory_uri() . '/assets/js/admin/admin.js', array('jquery'), $ekommart_version, true);
    }

	public function import_files(){
            return array(
                array(
					'import_file_name'           => 'home 1',
					'home'                       => 'home-1',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-1/slideshow1.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_1.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-1',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#EF3636"},{"_id":"secondary","title":"Secondary","color":"#EF3636"},{"_id":"text","title":"Text","color":"#626262"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 10',
					'home'                       => 'home-10',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-10/slideshow10-1.zip",
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-10/slideshow10.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_10.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-10',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#60AD56"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 11',
					'home'                       => 'home-11',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-11/slideshow11.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_11.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-11',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#7dbc90"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_background_image":{"url":"https://demo2wpopal.b-cdn.net/ekommart/wp-content/uploads/2020/10/h11_bg-scaled.jpg"},"body_background_position":"top center","body_background_repeat":"no-repeat","body_background_size":"cover"}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","boxed":"true","boxed_width":"1290","show_header_sticky":false}',
				),

                array(
					'import_file_name'           => 'home 12',
					'home'                       => 'home-12',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-12/slideshow12.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_12.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-12',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#eb8092"},{"_id":"secondary","title":"Secondary","color":"#eb8092"},{"_id":"text","title":"Text","color":"#626262"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_background_color":"#F6F6F6","body_background_image":{"url":"https://demo2wpopal.b-cdn.net/ekommart/wp-content/uploads/2020/10/bg-body-home12.png"},"body_background_position":"top center","body_background_repeat":"no-repeat","body_background_size":"100% auto"}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","boxed":"true","boxed_width":"1480","show_header_sticky":false}',
				),

                array(
					'import_file_name'           => 'home 13',
					'home'                       => 'home-13',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-13/slideshow13.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_13.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-13',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#7bbddd"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 14',
					'home'                       => 'home-14',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_14.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-14',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#84e2c7"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"5"}',
				),

                array(
					'import_file_name'           => 'home 15',
					'home'                       => 'home-15',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-15/slideshow15.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_15.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-15',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#c09578"},{"_id":"secondary","title":"Secondary","color":"#c09578"},{"_id":"text","title":"Text","color":"#626262"},{"_id":"accent","title":"Accent","color":"#ffffff"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#3b3b3b"},{"_id":"3c9b883a","title":"Background","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_background_color":"#252525"}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","show_header_sticky":false}',
				),

                array(
					'import_file_name'           => 'home 16',
					'home'                       => 'home-16',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-16/slideshow16.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_16.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-16',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#000"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"5"}',
				),

                array(
					'import_file_name'           => 'home 17',
					'home'                       => 'home-17',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-17/slideshow17.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_17.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-17',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#fcb600"},{"_id":"secondary","title":"Secondary","color":"#fcb600"},{"_id":"text","title":"Text","color":"#626262"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"5"}',
				),

                array(
					'import_file_name'           => 'home 18',
					'home'                       => 'home-18',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_18.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-18',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#fcb600"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_background_color":"#F8F8F8"}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 19',
					'home'                       => 'home-19',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-19/slider-home19.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_19.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-19',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#ffcd00"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 2',
					'home'                       => 'home-2',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-2/slideshow2.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_2.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-2',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#fed700"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"2"}',
				),

                array(
					'import_file_name'           => 'home 20',
					'home'                       => 'home-20',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-20/slider-home20.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_20.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-20',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#dc1919"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 21',
					'home'                       => 'home-21',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_21.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-21',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#e2b791"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"6"}',
				),

                array(
					'import_file_name'           => 'home 22',
					'home'                       => 'home-22',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-22/slideshow-22.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_22.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-22',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#03ada4"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"5"}',
				),

                array(
					'import_file_name'           => 'home 23',
					'home'                       => 'home-23',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-23/slideshow23.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_23.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-23',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#EF3636"},{"_id":"secondary","title":"Secondary","color":"#EF3636"},{"_id":"text","title":"Text","color":"#626262"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"5","show_header_sticky":false}',
				),

                array(
					'import_file_name'           => 'home 3',
					'home'                       => 'home-3',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-3/slideshow3.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_3.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-3',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#ef3636"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_background_color":"#F6F6F6"}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 4',
					'home'                       => 'home-4',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-4/slideshow4.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_4.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-4',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"##FFDB30"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 5',
					'home'                       => 'home-5',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-5/slideshow5.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_5.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-5',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#40c1c7"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1"}',
				),

                array(
					'import_file_name'           => 'home 6',
					'home'                       => 'home-6',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-6/slideshow6.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_6.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-6',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#f25529"},{"_id":"secondary","title":"Secondary","color":"#f25529"},{"_id":"text","title":"Text","color":"#626262"},{"_id":"accent","title":"Accent","color":"#000000"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"3"}',
				),

                array(
					'import_file_name'           => 'home 7',
					'home'                       => 'home-7',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-7/slideshow7.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_7.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-7',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#fe6e44"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"2"}',
				),

                array(
					'import_file_name'           => 'home 8',
					'home'                       => 'home-8',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-8/slideshow8.zip",
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-8/slideshow81.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_8.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-8',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#67ce29"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"4"}',
				),

                array(
					'import_file_name'           => 'home 9',
					'home'                       => 'home-9',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/home-9/slideshow9.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_9.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/home-9',
					'elementor'                  => '{"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":"1290","sizes":[]},"stretched_section_container":"body","viewport_md":"","viewport_lg":"","system_colors":[{"_id":"primary","title":"Primary","color":"#e68b0c"}],"custom_colors":[{"_id":"5b8716ea","title":"Light","color":"#888888"},{"_id":"2446596b","title":"Border","color":"#EBEBEB"},{"_id":"3c9b883a","title":"Dark","color":"#252525"},{"_id":"9e72934","title":"Saved Color #8","color":"#FFF"}],"system_typography":[{"_id":"primary","title":"Primary Headline","typography_typography":"custom"},{"_id":"secondary","title":"Secondary Headline","typography_typography":"custom"},{"_id":"text","title":"Body Text","typography_typography":"custom"},{"_id":"accent","title":"Accent Text","typography_typography":"custom"}],"custom_typography":[],"site_name":"Ekommart","site_description":"Just another WordPress site","page_title_selector":"h1.entry-title","activeItemIndex":1,"body_background_image":{"url":"https://demo2wpopal.b-cdn.net/ekommart/wp-content/uploads/2020/10/h9_bg-scaled.jpg"},"body_background_position":"center center","body_background_repeat":"no-repeat","body_background_size":"cover"}',
					'themeoptions'               => '{"ekommart_options_social_share":"1","ekommart_options_social_share_facebook":"1","ekommart_options_social_share_twitter":"1","ekommart_options_social_share_linkedin":"1","ekommart_options_social_share_pinterest":"1","ekommart_options_show_header_sticky":"1","ekommart_options_wocommerce_product_deal_ids":["5082","5078","5076","5073","4440"],"ekommart_options_discount_type":"percentage_product_discount","ekommart_options_wocommerce_product_deal_discount_rate":"10","ekommart_options_wocommerce_product_deal_time_form":"2020-10-15","ekommart_options_wocommerce_product_deal_time_to":"2020-12-03","ekommart_options_wocommerce_product_deal_discount_sold":"99","ekommart_options_woocommerce_archive_layout":"default","ekommart_options_single_product_gallery_layout":"horizontal","ekommart_options_wocommerce_block_style":"1","wocommerce_block_style":"2","boxed":"true","boxed_width":"1480","show_header_sticky":false}',
				),
            );
        }

	public function after_import_setup( $selected_import ) {
		$selected_import = ( $this->import_files() )[ $selected_import ];
		$check_oneclick  = get_option( 'ekommart_check_oneclick', [] );

		$this->set_demo_menus();
		wp_delete_post( 1, true );

		if ( ! isset( $check_oneclick[ $selected_import['home'] ] ) ) {
			$this->wizard->importer->import( get_parent_theme_file_path( 'dummy-data/homepage/' . $selected_import['home'] . '.xml' ) );
			$this->fixelementorhome( $selected_import['home'] );
			$check_oneclick[ $selected_import['home'] ] = true;
		}

		// setup Home page
		$home = get_page_by_path( $selected_import['home'] );
		if ( $home ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home->ID );
		}

		// Setup Breadcrumb
		if(!isset($check_oneclick['breadcrumb'])){
			$this->enable_breadcrumb();
			$check_oneclick['breadcrumb'] = true;
		}


		// Elementor
		$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
		update_post_meta( $active_kit_id, '_elementor_page_settings', json_decode( $selected_import['elementor'], true ) );

		// Setup Options
		if ( isset( $selected_import['themeoptions'] ) ) {
			$options = json_decode( $selected_import['themeoptions'], true );
			foreach ( $options as $key => $option ) {
				if ( count( $options ) > 0 ) {
					foreach ( $option as $k => $v ) {
						update_option( $k, $v );
					}
				}
			}
		}

		if ( ! isset( $check_oneclick['elementor'] ) ) {
			$this->fixelementor();
			$check_oneclick['elementor'] = true;
		}

		$this->setup_header_footer( $selected_import['home'] );
		\Elementor\Plugin::$instance->files_manager->clear_cache();

		$revsliders = $selected_import['rev_sliders'];
		if ( count( $revsliders ) > 0 ) {
			if ( file_exists( trailingslashit( ABSPATH ) . 'wp-content/plugins/revslider/revslider.php' ) ) {
				require_once( RS_PLUGIN_PATH . 'admin/includes/license.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/addons.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/template.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/functions-admin.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/folder.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/import.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/export.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/export-html.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/includes/newsletter.class.php' );
				require_once( RS_PLUGIN_PATH . 'admin/revslider-admin.class.php' );
				require_once( RS_PLUGIN_PATH . 'includes/update.class.php' );

				foreach ( $revsliders as $revslider ) {
					if ( ! isset( $check_oneclick[ basename( $revslider ) ] ) ) {
						$this->import_revslider( $revslider );
						$check_oneclick[ basename( $revslider ) ] = 1;
					}
				}
			}
		}

		$this->license_elementor_pro();

		if ( ! isset( $check_oneclick['logo'] ) ) {
			set_theme_mod( 'custom_logo', 251 );
			$check_oneclick['logo'] = true;
		}

		if (!isset($check_oneclick['woocommerce'])) {
            $this->update_woocommerce_page();
            $check_oneclick['woocommerce'] = true;
        }

		if(!isset($check_oneclick['menu-item'])){
            $this->update_nav_menu_item();
            $check_oneclick['menu-item'] = true;
        }

		update_option( 'ekommart_check_oneclick', $check_oneclick );
	}

	private function update_woocommerce_page() {
        $pages = array(
            array(
                "ID"           => wc_get_page_id('cart'),
                "post_content" => "<!-- wp:shortcode -->[woocommerce_cart]<!-- /wp:shortcode -->"
            ),
            array(
                "ID"           => wc_get_page_id('checkout'),
                "post_content" => "<!-- wp:shortcode -->[woocommerce_checkout]<!-- /wp:shortcode -->"
            ),
            array(
                "ID"           => wc_get_page_id('my-account'),
                "post_content" => "<!-- wp:shortcode -->[woocommerce_my_account]<!-- /wp:shortcode -->"
            )
        );
        foreach ($pages as $page) {
            if ($page['ID']) {
                wp_update_post($page);
            }
        }
    }

    private function update_nav_menu_item() {
        $params = array(
            'posts_per_page' => -1,
            'post_type'      => [
                'nav_menu_item',
            ],
        );
        $query  = new WP_Query($params);
        while ($query->have_posts()): $query->the_post();
            wp_update_post(array(
                // Update the `nav_menu_item` Post Title
                'ID'         => get_the_ID(),
                'post_title' => get_the_title()
            ));
        endwhile;

    }

	private function init() {
		$this->wizard = new Merlin(
			$config = array(
				// Location / directory where Merlin WP is placed in your theme.
				'merlin_url'         => 'merlin',
				// The wp-admin page slug where Merlin WP loads.
				'parent_slug'        => 'themes.php',
				// The wp-admin parent page slug for the admin menu item.
				'capability'         => 'manage_options',
				// The capability required for this menu to be displayed to the user.
				'dev_mode'           => true,
				// Enable development mode for testing.
				'license_step'       => false,
				// EDD license activation step.
				'license_required'   => false,
				// Require the license activation step.
				'license_help_url'   => '',
				'directory'          => '/inc/merlin',
				// URL for the 'license-tooltip'.
				'edd_remote_api_url' => '',
				// EDD_Theme_Updater_Admin remote_api_url.
				'edd_item_name'      => '',
				// EDD_Theme_Updater_Admin item_name.
				'edd_theme_slug'     => '',
				// EDD_Theme_Updater_Admin item_slug.
			),
			$strings = array(
				'admin-menu'          => esc_html__( 'Theme Setup', 'ekommart' ),

				/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
				'title%s%s%s%s'       => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'ekommart' ),
				'return-to-dashboard' => esc_html__( 'Return to the dashboard', 'ekommart' ),
				'ignore'              => esc_html__( 'Disable this wizard', 'ekommart' ),

				'btn-skip'                 => esc_html__( 'Skip', 'ekommart' ),
				'btn-next'                 => esc_html__( 'Next', 'ekommart' ),
				'btn-start'                => esc_html__( 'Start', 'ekommart' ),
				'btn-no'                   => esc_html__( 'Cancel', 'ekommart' ),
				'btn-plugins-install'      => esc_html__( 'Install', 'ekommart' ),
				'btn-child-install'        => esc_html__( 'Install', 'ekommart' ),
				'btn-content-install'      => esc_html__( 'Install', 'ekommart' ),
				'btn-import'               => esc_html__( 'Import', 'ekommart' ),
				'btn-license-activate'     => esc_html__( 'Activate', 'ekommart' ),
				'btn-license-skip'         => esc_html__( 'Later', 'ekommart' ),

				/* translators: Theme Name */
				'license-header%s'         => esc_html__( 'Activate %s', 'ekommart' ),
				/* translators: Theme Name */
				'license-header-success%s' => esc_html__( '%s is Activated', 'ekommart' ),
				/* translators: Theme Name */
				'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'ekommart' ),
				'license-label'            => esc_html__( 'License key', 'ekommart' ),
				'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'ekommart' ),
				'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'ekommart' ),
				'license-tooltip'          => esc_html__( 'Need help?', 'ekommart' ),

				/* translators: Theme Name */
				'welcome-header%s'         => esc_html__( 'Welcome to %s', 'ekommart' ),
				'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'ekommart' ),
				'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'ekommart' ),
				'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'ekommart' ),

				'child-header'         => esc_html__( 'Install Child Theme', 'ekommart' ),
				'child-header-success' => esc_html__( 'You\'re good to go!', 'ekommart' ),
				'child'                => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'ekommart' ),
				'child-success%s'      => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'ekommart' ),
				'child-action-link'    => esc_html__( 'Learn about child themes', 'ekommart' ),
				'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'ekommart' ),
				'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'ekommart' ),

				'plugins-header'         => esc_html__( 'Install Plugins', 'ekommart' ),
				'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'ekommart' ),
				'plugins'                => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'ekommart' ),
				'plugins-success%s'      => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'ekommart' ),
				'plugins-action-link'    => esc_html__( 'Advanced', 'ekommart' ),

				'import-header'      => esc_html__( 'Import Content', 'ekommart' ),
				'import'             => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'ekommart' ),
				'import-action-link' => esc_html__( 'Advanced', 'ekommart' ),

				'ready-header'      => esc_html__( 'All done. Have fun!', 'ekommart' ),

				/* translators: Theme Author */
				'ready%s'           => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'ekommart' ),
				'ready-action-link' => esc_html__( 'Extras', 'ekommart' ),
				'ready-big-button'  => esc_html__( 'View your website', 'ekommart' ),
				'ready-link-1'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'ekommart' ) ),
				'ready-link-2'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__( 'Get Theme Support', 'ekommart' ) ),
				'ready-link-3'      => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'ekommart' ) ),
			)
		);

		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
	}

	public function render_child_functions_php() {
		$output
			= "<?php
/**
 * Theme functions and definitions.
 */
		 ";

		return $output;
	}

	public function widgets_init() {
		require_once get_parent_theme_file_path( '/inc/merlin/includes/recent-post.php' );
		register_widget( 'Ekommart_WP_Widget_Recent_Posts' );
		if ( ekommart_is_woocommerce_activated() ) {
			require_once get_parent_theme_file_path( '/inc/merlin/includes/class-wc-widget-layered-nav.php' );
			register_widget( 'Ekommart_Widget_Layered_Nav' );
		}
	}

	private function setup_header_footer( $id ) {
		$this->delete_duplicate_hf();
		$this->reset_header_footer();
		$options = ( $this->get_all_header_footer() )[ $id ];

		foreach ( $options['header'] as $header_options ) {
			$header = get_page_by_path( $header_options['slug'], OBJECT, 'elementor_library' );
			if ( $header ) {
				update_post_meta( $header->ID, '_elementor_conditions', $header_options['conditions'] );
			}
		}

		foreach ( $options['footer'] as $footer_options ) {
			update_option( 'test', $footer_options['slug'] );
			$footer = get_page_by_path( $footer_options['slug'], OBJECT, 'elementor_library' );
			if ( $footer ) {
				update_post_meta( $footer->ID, '_elementor_conditions', $footer_options['conditions'] );
				$this->fixelementorhome( $footer->post_name, $footer->post_type );
			}
		}

		$cache = new ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Cache();
		$cache->regenerate();
	}

	private function get_all_header_footer() {
		return [
			'home-1'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-2'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-3'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-4'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-5'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-5',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-6'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-6',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-7'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-6',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-8'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-3',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-7',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-9'  => [
				'header' => [
					[
						'slug'       => 'headerbuilder-10',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-7',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-10' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-7',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-8',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-11' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-2',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-12' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-1',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-7',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-13' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-8',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-4',
						'conditions' => [ 'include/general' ],
					]
				]
			],
			'home-14' => [
				'header' => [
					[
						'slug'       => 'headerbuilder-9',
						'conditions' => [ 'include/general' ],
					]
				],
				'footer' => [
					[
						'slug'       => 'footerbuilder-9',
						'conditions' => [ 'include/general' ],
					]
				]
			],
		];
	}

	private function reset_header_footer() {
		$args = array(
			'post_type'  => 'elementor_library',
			'meta_query' => array(
				array(
					'key'     => '_elementor_template_type',
					'compare' => 'IN',
					'value'   => [ 'footer', 'header' ]
				),
			)
		);

		$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post();
			update_post_meta( get_the_ID(), '_elementor_conditions', [] );
		endwhile;
		wp_reset_postdata();
	}

	private function delete_duplicate_hf() {
		global $wpdb, $table_prefix;
		$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
		$kit           = ekommart_get_page_by_title( 'Default Kit', OBJECT, 'elementor_library' );
		if ( $kit ) {
			if ( absint( $active_kit_id ) !== $kit->ID ) {
				wp_delete_post( $kit->ID, true );
			}
		}

		$sql = "DELETE bad_rows.* from " . $table_prefix . "posts as bad_rows inner join ( select post_title, MIN(id) as min_id from " . $table_prefix . "posts where post_type = 'elementor_library' group by post_title having count(*) > 1 ) as good_rows on good_rows.post_title = bad_rows.post_title and good_rows.min_id <> bad_rows.id";

		return $wpdb->get_results( $sql );
	}

	private function fixelementorhome( $slug, $post_type = 'page' ) {
		$datas = json_decode( file_get_contents( get_parent_theme_file_path( 'dummy-data/ejson.json' ) ), true );
		$home  = get_page_by_path( $slug, OBJECT, $post_type );
		update_post_meta( $home->ID, '_elementor_data', wp_slash( wp_json_encode( $datas[ $slug ] ) ) );
	}

	private function fixelementor() {
		$datas = json_decode( file_get_contents( get_parent_theme_file_path( 'dummy-data/ejson.json' ) ), true );
		$query = new WP_Query( array(
			'post_type'      => [
				'page',
				'elementor_library',
			],
			'posts_per_page' => - 1
		) );
		while ( $query->have_posts() ): $query->the_post();
			global $post;
			$postid = get_the_ID();
			if ( get_post_meta( $post->ID, '_elementor_edit_mode', true ) === 'builder' ) {
				$data = json_decode( get_post_meta( $postid, '_elementor_data', true ) );
				if ( ! boolval( $data ) ) {
					if ( isset( $datas[ $post->post_name ] ) ) {
						update_post_meta( $postid, '_elementor_data', wp_slash( wp_json_encode( $datas[ $post->post_name ] ) ) );
					}
				}
			}
		endwhile;
		wp_reset_postdata();
	}

	private function license_elementor_pro() {
		if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			$data = [
				'success'          => true,
				'license'          => 'valid',
				'item_id'          => false,
				'item_name'        => 'Elementor Pro',
				'is_local'         => false,
				'license_limit'    => '1000',
				'site_count'       => '1000',
				'activations_left' => 1,
				'expires'          => 'lifetime',
				'customer_email'   => 'info@wpopal.com',
				'features'         => array()
			];
			update_option( 'elementor_pro_license_key', 'Licence Hacked' );
			ElementorPro\License\API::set_license_data( $data, '+2 years' );
		}
	}

	private function import_revslider( $slider ) {
		$revslider                         = new RevSlider();
		$temp_name                         = download_url( $slider );
		$_FILES['import_file']['error']    = UPLOAD_ERR_OK;
		$_FILES['import_file']['tmp_name'] = $temp_name;
		$revslider->importSliderFromPost( true, 'none' );
	}

	/**
	 * @param $filesystem WP_Filesystem_Direct
	 *
	 * @return bool
	 */
	private function download_revslider( $filesystem, $slider, $pathSlider ) {
		return $filesystem->copy( $slider, $pathSlider, true );
	}

	private function enable_breadcrumb() {
		$options  = get_option( 'wpseo_titles', [] );
		$settings = [
			'breadcrumbs-enable' => true,
			'breadcrumbs-home'   => 'Home',
			'breadcrumbs-sep'    => '<i class="ekommart-icon-angle-right"></i>',
		];
		$settings = wp_parse_args($settings, $options);
		update_option('wpseo_titles', $settings);
	}

	public function set_demo_menus() {
		$main_menu = get_term_by( 'name', 'Ekommart Main Menu', 'nav_menu' );
		$vertical  = get_term_by( 'name', 'All Departments', 'nav_menu' );

		set_theme_mod(
			'nav_menu_locations',
			array(
				'primary'  => $main_menu->term_id,
				'handheld' => $main_menu->term_id,
				'vertical' => $vertical->term_id
			)
		);
	}

	/**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
            add_options_page(
            'Custom Setup Theme',
            'Custom Setup Theme',
            'manage_options',
            'custom-setup-settings',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property

        $header_data = $this->get_data_elementor_template('header');
        $footer_data = $this->get_data_elementor_template('footer');

        $profile = $this->get_all_header_footer();

        $homepage = [];
        foreach ($profile as $key=>$value){
            $homepage[$key] = ucfirst( str_replace('-', ' ', $key) );
        }
        ?>
        <div class="wrap">
        <h1><?php esc_html_e('Custom Setup Themes', 'ekommart') ?></h1>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <table class="form-table">
                <tr>
                    <th>
                        <label><?php esc_html_e('Setup Themes', 'ekommart') ?></label>
                    </th>
                    <td>
                        <fieldset>
                            <ul>
                                <li>
                                    <label><?php esc_html_e('Setup Theme', 'ekommart') ?>:
                                        <select name="setup-theme">
                                            <option value="profile" selected>Select Profile</option>
                                             <option value="custom_theme">Custom Header and Footer</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="profile setup-theme">
                                    <label><?php esc_html_e('Profile', 'ekommart') ?>:
                                        <select name="opal-data-home">
                                            <option value="" selected>Select Profile</option>
                                            <?php foreach ($homepage as $id => $home) { ?>
                                                <option value="<?php echo esc_attr($id); ?>">
                                                    <?php echo esc_attr($home); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </li>
                                <li class="custom_theme setup-theme">
                                    <label><?php esc_html_e('Header', 'ekommart') ?>:
                                        <select name="header">
                                            <option value="" selected>Select Header</option>
                                            <?php foreach ($header_data as $id => $header) { ?>
                                                <option value="<?php echo esc_attr($id); ?>">
                                                    <?php echo esc_attr($header); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </li>
                                <li class="custom_theme setup-theme">
                                    <label><?php esc_html_e('Footer', 'ekommart') ?>:
                                        <select name="footer">
                                            <option value="" selected >Select Footer</option>
                                            <?php foreach ($footer_data as $id => $footer) { ?>
                                                <option value="<?php echo esc_attr($id); ?>">
                                                    <?php echo esc_attr($footer); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="update_elementor" name="opal-setup-data-elementor" value="1">
                                    <label><?php esc_html_e('Update Elementor Content', 'ekommart') ?></label>
                                </li>
                                <li>
                                    <input type="checkbox" id="update_elementor" name="opal-setup-data-elementor-options" value="1">
                                    <label><?php esc_html_e('Update Elementor Options', 'ekommart') ?></label>
                                </li>
                            </ul>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="action" value="custom_setup_data">
            <?php submit_button(esc_html('Setup Now!')); ?>
        </form>
        <?php  if (isset($_GET['saved'])) { ?>
            <div class="updated">
                <p><?php esc_html_e('Success! Have been setup for your website', 'ekommart'); ?></p>
            </div>
        <?php }
    }

    private function get_data_elementor_template($type){
        $args = array(
            'post_type'      => 'elementor_library',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => '_elementor_template_type',
                    'compare' => '=',
                    'value'   => $type
                ),
            )
        );
        $data = new WP_Query($args);
        $select_data = [];
        while ($data->have_posts()): $data->the_post();
            $select_data[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        return $select_data;
    }

    private function reset_elementor_conditions($type) {
		$args = array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => '_elementor_template_type',
					'compare' => '=',
					'value'   => $type
				),
			)
		);
		$query = new WP_Query($args);
		while ($query->have_posts()) : $query->the_post();
			update_post_meta(get_the_ID(), '_elementor_conditions', []);
		endwhile;
		wp_reset_postdata();
	}

    public function custom_setup_data(){
        if(isset($_POST)){
            $this->delete_duplicate_hf();

            if(isset($_POST['setup-theme'])){
                if( $_POST['setup-theme'] == 'profile'){
                    if (isset($_POST['opal-data-home']) && !empty($_POST['opal-data-home'])) {
                        $home = (isset($_POST['opal-data-home']) && $_POST['opal-data-home']) ? $_POST['opal-data-home'] : 'home-1';
                        $this->reset_elementor_conditions('header');
                        $this->reset_elementor_conditions('footer');
                        $this->setup_header_footer($home);
                    }
                }else{

                     if(isset($_POST['header']) && !empty($_POST['header'])){
                        $header = $_POST['header'];
                        $this->reset_elementor_conditions('header');
                        update_post_meta($header, '_elementor_conditions', ['include/general']);

                    }

                    if(isset($_POST['footer']) && !empty($_POST['footer'])){
                        $footer= $_POST['footer'];
                        $this->reset_elementor_conditions('footer');
                        update_post_meta($footer, '_elementor_conditions', ['include/general']);
                    }

                }

            }


            if (isset($_POST['opal-setup-data-elementor'])) {
                $this->fixelementor();
            }

            if (isset($_POST['opal-setup-data-elementor-options'])) {
                if(isset($_POST['setup-theme']) && $_POST['setup-theme'] == 'profile' && isset($_POST['opal-data-home']) && !empty($_POST['opal-data-home'])){

                    $options_homepage = $this->get_options_homepage($_POST['opal-data-home']);

                    // Elementor
                    $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
                    update_post_meta( $active_kit_id, '_elementor_page_settings', json_decode( $options_homepage['elementor'], true ) );

                    // Setup Options
                    if (isset($options_homepage['themeoptions'])) {
                        $options = json_decode($options_homepage['themeoptions'], true);
                        if (is_array($options) && count($options) > 0) {
                            foreach ($options as $key => $option) {
                                update_option($key, $option);
                            }
                        }
                    }

                }
            }

            $cache = new ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Cache();
            $cache->regenerate();

            Elementor\Plugin::$instance->files_manager->clear_cache();

            wp_redirect(admin_url('options-general.php?page=custom-setup-settings&saved=1'));
            exit;
        }
    }

    private function get_options_homepage($homepage){
        $options_data = $this->import_files();
        $data_option = [];
        foreach ($options_data as $option){
            if($option['home'] == $homepage){
                $data_option['themeoptions'] = $option['themeoptions'];
                $data_option['elementor'] = $option['elementor'];
                return $data_option;
            }
        }
        return $data_option;
    }

}

return new Ekommart_Merlin_Config();
