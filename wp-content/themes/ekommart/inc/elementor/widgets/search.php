<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Search extends Elementor\Widget_Base
{
    public function get_name() {
        return 'ekommart-search';
    }

    public function get_title() {
        return esc_html__('Ekommart Search Form', 'ekommart');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories()
    {
        return array('ekommart-addons');
    }

    protected function register_controls()
    {
        $this -> start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style','ekommart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => __( 'Border width', 'ekommart' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__( 'Border Color', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__( 'Border Color Focus', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__( 'Background', 'ekommart' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        if(ekommart_is_woocommerce_activated()) {
            ekommart_product_search();
        }
    }
}

$widgets_manager->register(new OSF_Elementor_Search());