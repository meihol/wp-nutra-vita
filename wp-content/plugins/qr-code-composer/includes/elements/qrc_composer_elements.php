<?php
 use \Elementor\Controls_Manager;
 use \Elementor\Widget_Base;  
 use \Elementor\Group_Control_Typography;  
 use \Elementor\Group_Control_Box_Shadow;  
 use \Elementor\Group_Control_Border;  
 use \Elementor\Group_Control_Background;  

   class Qrc_Elements_Widget extends Widget_Base {

       public function get_name() {
           return 'qrcode_elemntsa';
       }
   
       public function get_title() {
           return __( 'QR Code Composer', 'qr-code-composer' );
       }
   
   
       public function get_icon() {
           return 'eicon-table-of-contents';
       }
       public function get_script_depends() {
         return ['qrc_elementor'];
       }
       public function get_categories() {
           return [ 'qrccategory' ];
       }
   
        /**
         * Retrieve Widget Support URL.
         *
         * @access public
         *
         * @return string support URL.
         */
        public function get_custom_help_url() {
          return 'https://wordpress.org/support/plugin/qr-code-composer/';
        }

       protected function register_controls() {
   
        
                $this->start_controls_section(
                'content_section',
                [
                'label' => __( 'QR Elements', 'qr-code-composer' ),
                'label_block' => true,
                'tab' => Controls_Manager::TAB_CONTENT,
                ]
                );
            $this->add_control(
                'qr-code-composer_elmnts',
                [
                    'label' => __( 'Elements', 'qr-code-composer' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'current_url',
                    'options' => [
                     'current_url'=>  __( 'Current Url', 'qr-code-composer' ),
                    ],
                ]
            ); 

            $this->add_control(
                'qr_width',
                [
                 'label' => esc_html__( 'QR code display size', 'qr-code-composer' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                  'min' => 50,
                  'max' => 500,
                  'step' => 10,
                  'default' => 300,

                ]
            );

            $this->add_control(
             'qrc_text_align',
             [
               'label' => __( 'Alignment', 'qr-code-composer' ),
               'type' => Controls_Manager::CHOOSE,
               'options' => [
                 'left' => [
                   'title' => __( 'Left', 'qr-code-composer' ),
                   'icon' => 'eicon-text-align-left',
                 ],
                 'center' => [
                   'title' => __( 'Center', 'qr-code-composer' ),
                   'icon' => 'eicon-text-align-center',
                 ],
                 'right' => [
                   'title' => __( 'Right', 'qr-code-composer' ),
                   'icon' => 'eicon-text-align-right',
                 ],
               ],
               'default' => 'left',
               'toggle' => true,
               'selectors' => [
                 '{{WRAPPER}} .qrc_elementr_wrapeer' => 'text-align: {{VALUE}};',
               ],
             ]
            );

    
    $this->add_control(
        'qr_color',
        [
            'label' => __( 'QR Color', 'qr-code-composer' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#000',

        ]
    );
        $this->add_control(
            'qr_bg_color',
            [
                'label' => __( 'Background Color', 'qr-code-composer' ),
                'description' => __( 'Use light color for better QR code scanning, white color recommended', 'qr-code-composer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',

            ]
        );

  $this->add_control(
      'qrc_premiumdemos',
      [
        'label' => __( 'Premium QR Demo <i class="icon-element eicon-upgrade-crown"></i>', 'qr-code-composer' ),
        'type' => \Elementor\Controls_Manager::RAW_HTML,
        'raw' => __( '<p>Check out the Premium Version QR Code on the Elementor Editor page <a href="https://qrcode.woocommercebarcode.com/wp-admin/post.php?post=2984&action=elementor" traget="_blank">View Demo</a> | <a href="https://sharabindu.com/plugins/wordpress-qr-code-generator/" traget="_blank">Upgrade to PRO</a></p>', 'qr-code-composer' ),
        'content_classes' => 'qrc_premkumverd',
      ]
    );

     $this->end_controls_section(); 

      $this->start_controls_section(
        'qrclogobuttonssection',
        [
        'label' => __( 'Button', 'qr-code-composer' ),
        'label_block' => true,
        'tab' => Controls_Manager::TAB_CONTENT,
        ]
        );

        $this->add_control(
        'qrcdownbttn',
        [
        'label' => __( 'Download Button', 'qr-code-composer' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        ]
        );
          $this->add_control(
             'enable_downbtn',
             [
               'label' => esc_html__( 'Enable Download Button?', 'qr-code-composer' ),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => esc_html__( 'Show', 'qr-code-composer' ),
               'label_off' => esc_html__( 'Hide', 'qr-code-composer' ),
               'return_value' => 'yes',
               'default' => 'yes',
             ]
            );
            $this->add_control(
             'btn_text',
             [
               'label' => esc_html__( 'Button Label', 'qr-code-composer' ),
               'type' => Controls_Manager::TEXT,
               'default' => esc_html__( 'Download QR', 'qr-code-composer' ),
               'placeholder' => esc_html__( 'Type Button Label here', 'qr-code-composer' ),

               'condition' =>[
                 'enable_downbtn' => 'yes'
               ]
             ]
            );
    $this->add_control(
      'qrc_premiumdemosg',
      [
        'label' => __( 'Premium QR Demo <i class="icon-element eicon-upgrade-crown"></i>', 'qr-code-composer' ),
        'type' => \Elementor\Controls_Manager::RAW_HTML,
        'raw' => __( '<p>Check out the Premium Version QR Code on the Elementor Editor page <a href="https://qrcode.woocommercebarcode.com/wp-admin/post.php?post=2984&action=elementor" traget="_blank">View Demo</a> | <a href="https://sharabindu.com/plugins/wordpress-qr-code-generator/" traget="_blank">Upgrade to PRO</a></p>', 'qr-code-composer' ),
        'content_classes' => 'qrc_premkumverd',
      ]
    );


          $this->end_controls_section();
         $this->start_controls_section(
         'style_section',
         [
         'label' => __( 'Download Button', 'qr-code-composer' ),
         'tab' => Controls_Manager::TAB_STYLE,
         ]
         );
            $this->add_responsive_control(
             'btn_padding',
             [
               'label' => __( 'Padding', 'qr-code-composer' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
              'selectors' => [
                '{{WRAPPER}} .qrc_btn_canvas' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
              ],
               'condition' =>[
                 'enable_downbtn' => 'yes'
               ]
             ]
            );
            $this->add_responsive_control(
             'btn_margin',
             [
               'label' => __( 'Button margin from top', 'qr-code-composer' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px'],
               'range' => [
                 'px' => [
                   'min' => 0,
                   'max' => 100,
                   'step' => 10,
                 ],
               ],
               'default' => [
                 'unit' => 'px',
                 'size' => 20,
               ],
               'selectors' => [
                 '{{WRAPPER}} .qrc_btn_canvas' => 'margin: {{SIZE}}{{UNIT}} 0;',
               ],
               'condition' =>[
                 'enable_downbtn' => 'yes'
               ]
             ]
            );
        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Text color', 'qr-code-composer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                  '{{WRAPPER}} .qrc_btn_canvas' => 'color:{{UNIT}};',
                ],
                'condition' =>[
                  'enable_downbtn' => 'yes'
                ]
            ]
        );

       $this->add_control(
        'btn_bg_color',
        [
          'name' => 'btn_bg_color',
          'type' => Controls_Manager::COLOR,
          'label' => __( 'Background', 'qr-code-composer' ),
                'default' => '#000',
                'selectors' => [
                  '{{WRAPPER}} .qrc_btn_canvas' => 'background:{{UNIT}};',
                ],
                'condition' =>[
                  'enable_downbtn' => 'yes'
                ]
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'qrcbtn_typography',
          'label' => __( ' Typography', 'qr-code-composer' ),
          'selector' => '{{WRAPPER}} .qrc_btn_canvas',
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'qrc_btnborder',
          'label' => __( 'Border', 'qr-code-composer' ),
          'selector' => '{{WRAPPER}} .qrc_btn_canvas',
        ]
      );

    $this->add_control(
      'qrc_border_radius',
      [
        'label' => esc_html__( 'Border Radius', 'qr-code-composer' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
        'selectors' => [
          '{{WRAPPER}} .qrc_btn_canvas' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
          'name' => 'qrcbtnbox_shadow',
          'label' => __( 'Box Shadow', 'qr-code-composer' ),
          'selector' => '{{WRAPPER}} .qrc_btn_canvas',
        ]
      );
  $this->add_control(
      'qrc_premiumdemosd',
      [
        'label' => __( 'Premium QR Demo <i class="icon-element eicon-upgrade-crown"></i>', 'qr-code-composer' ),
        'type' => \Elementor\Controls_Manager::RAW_HTML,
        'raw' => __( '<p>Check out the Premium Version QR Code on the Elementor Editor page <a href="https://qrcode.woocommercebarcode.com/wp-admin/post.php?post=2984&action=elementor" traget="_blank">View Demo</a> | <a href="https://sharabindu.com/plugins/wordpress-qr-code-generator/" traget="_blank">Upgrade to PRO</a></p>', 'qr-code-composer' ),
        'content_classes' => 'qrc_premkumverd',
      ]
    );


    $this->end_controls_section();      
        }
   
       /**
        * Render oEmbed widget output on the frontend.
        *
        * Written in PHP and used to generate the final HTML.
        *
        * @since 5.9.0
        * @access protected
        */
       protected function render() {
              $settings = $this->get_settings_for_display();
          global $wp;
          $current_link = home_url(add_query_arg(array() , $wp->request));
          $current_title = get_the_title(get_the_id());
          $qrc_size = $settings['qr_width'];

          $qrc_bgcolor = $settings['qr_bg_color'];
          $random_id = $this->get_id();

        $color1 = isset( $settings['qr_color']) ?  $settings['qr_color'] : "#000";          
 $this->add_render_attribute(
        'qr-code-composer_attributes',
        [
        'class'                 => 'qrc_elecanvas',
        'id'                    => 'qrceleoutput-'.esc_attr($random_id ),
        'data-qrwidth'    => $qrc_size,
        'data-qrcontent'  => $current_link,
        'data-qrbgcolor'    => $qrc_bgcolor,
        'data-qrcolor'    => $color1,



        ]
        );  
          $this->add_render_attribute(
              'qrcComo_btn',
              [
                  'class'                 => 'qrc_btn_canvas',
                  'id'                    => 'downloadbuton-'.esc_attr($random_id ),
                  'download' => $current_title . '.png',

              ]
          ); 


          ?>
            <div class="qrc_elementr_wrapeer" >

<div class="qrcswholewtapper"><div <?php echo wp_kses_data($this->get_render_attribute_string('qr-code-composer_attributes'))?>> </div><?php
if($settings['enable_downbtn']== 'yes'){ 

echo '<div style="cursor:pointer"><a '.wp_kses_data($this->get_render_attribute_string('qrcComo_btn')).' style="display: inline-block;
  text-align: center;width:'.esc_attr($qrc_size).'px;text-decoration:none">'.esc_html($settings['btn_text']).'</a></div>';
  }
 ?></div>
      
  </div>


   <?php



  }


}