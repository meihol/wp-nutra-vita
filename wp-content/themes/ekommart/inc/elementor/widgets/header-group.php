<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Header_Group extends Elementor\Widget_Base
{

    public function get_name() {
        return 'ekommart-header-group';
    }

    public function get_title() {
        return esc_html__('Ekommart Header Group', 'ekommart');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return array('ekommart-addons');
    }

    public function get_script_depends() {
        return ['ekommart-elementor-header-group', 'slick', 'ekommart-cart-canvas'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'header_group_config',
            [
                'label' => esc_html__('Config', 'ekommart'),
            ]
        );

        $this->add_control(
            'show_search',
            [
                'label' => esc_html__( 'Show search', 'ekommart' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_account',
            [
                'label' => esc_html__( 'Show account', 'ekommart' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label' => esc_html__( 'Show wishlist', 'ekommart' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label' => esc_html__( 'Show cart', 'ekommart' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this -> add_control(
            'cart_dropdown',
            [
                'condition'  => ['show_cart' => 'yes'],
                'label' => esc_html__('Cart Content', 'ekommart'),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    '1' => esc_html__('Cart Canvas', 'ekommart'),
                    '2' =>  esc_html__('Cart Dropdown', 'ekommart'),
                ],
                'default'   => '1',
            ]
        );


        $this->end_controls_section();

        $this -> start_controls_section(
            'header-group-style',
            [
                'label' => esc_html__('Icon','ekommart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action .site-header-cart .cart-contents .amount' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-header-group-wrapper' );
        ?>
        <div <?php echo ekommart_elementor_get_render_attribute_string('wrapper', $this);?>>
            <div class="header-group-action">
                <?php if ( $settings['show_search'] === 'yes' ){
                    ekommart_header_search_button();
                }?>

                <?php if ( $settings['show_account'] === 'yes' ){
                    ekommart_header_account();
                }?>

                <?php if ( $settings['show_wishlist'] === 'yes' &&  ekommart_is_woocommerce_activated()){
                    ekommart_header_wishlist();
                }?>

                <?php if ( $settings['show_cart'] === 'yes' ):{
                    if ( ekommart_is_woocommerce_activated() ) {
                        ?>
                        <div class="site-header-cart menu">
                            <?php ekommart_cart_link(); ?>
                            <?php
                            if ( ! apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() ) ) {
                                if ( $settings['cart_dropdown'] === '1' ) {
                                    add_action( 'wp_footer', 'ekommart_header_cart_side' );
                                } else {
                                    the_widget( 'WC_Widget_Cart', 'title=' );
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                endif; ?>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new OSF_Elementor_Header_Group());
