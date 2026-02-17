<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 10/13/2020
 * Time: 9:30 AM
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Plugin;

class Ekommart_Elementor_Deal_Topbar extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ekommart-deal-topbar';
    }

    public function get_title()
    {
        return esc_html__('Ekommart Deal Topbar', 'ekommart');
    }

    public function get_script_depends() {
        return [ 'ekommart-elementor-deal-topbar','ekommart-countdown' ];
    }

    public function get_categories()
    {
        return array('ekommart-addons');
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'deal_topbar_config',
            [
                'label' => esc_html__('Config', 'ekommart'),
            ]
        );

        $this->add_control(
            'deal-topbar-header',
            [
                'label' => esc_html__('Deal Title', 'ekommart'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Black Friday. Save up to 50%!', 'ekommart'),
            ]
        );

        $this->add_control(
            'deal-topbar-countdown-text',
            [
                'label' => esc_html__('Count Down Title', 'ekommart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Deal Ends:', 'ekommart'),
            ]
        );

        $this->add_control(
            'heading_title_name',
            [
                'label' => esc_html__('Count Down Date', 'ekommart'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'deal-topbar-countdown-time',
            [
                'label' => esc_html__('MONTH/DAY/YEAR', 'ekommart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('04/19/2021', 'ekommart'),
            ]
        );

        $this->add_control(
            'deal-topbar-button-text',
            [
                'label' => esc_html__('Button Text', 'ekommart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Learn More', 'ekommart'),
            ]
        );

        $this->add_control(
            'deal-topbar-button-link',
            [
                'label' => __('Button Link', 'ekommart'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ekommart'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-deal-topbar-wrapper');
        ?>
    <div <?php echo ekommart_elementor_get_render_attribute_string('wrapper', $this); ?>>
        <?php
        $cookie = isset($_COOKIE['deal-topbar-hide']) ? $_COOKIE['deal-topbar-hide'] : true;
        if(Plugin::$instance->editor->is_edit_mode() ) {
            $cookie = true;
        }
        if ($cookie !== 'false') {
            $deal_link = $settings['deal-topbar-button-link']['url'];
            $deal_link_text = $settings['deal-topbar-button-text'];
            $date = $settings['deal-topbar-countdown-time'];
            $data_date = 0;

            if ($date) {
                $data_date = strtotime($date);
            }

            if ($data_date != 0 && $data_date > current_time('timestamp')) {

                ?>
                <div class="ekommart-deal-topbar desktop-hide-down">
                    <div class="deal-topbar-wrap">
                        <div class="deal-topbar-text"><?php printf('%s',$settings['deal-topbar-header']); ?></div>
                        <div class="deal-topbar-time">
                            <div class="deal-time-label"><?php echo esc_html($settings['deal-topbar-countdown-text']); ?></div>
                            <div class="deal-time-count" data-countdown="true" data-date="<?php echo esc_html($data_date); ?>">
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-days">00</span>
                                    <span class="countdown-label"><?php echo esc_html__('D', 'ekommart') ?></span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-hours">00</span>
                                    <span class="countdown-label"><?php echo esc_html__('H', 'ekommart') ?></span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-minutes">00</span>
                                    <span class="countdown-label"><?php echo esc_html__('M', 'ekommart') ?></span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-seconds">00</span>
                                    <span class="countdown-label"><?php echo esc_html__('S', 'ekommart') ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if ($deal_link !== ''): ?>
                            <div class="deal-topbar-button">
                                <a class="deal-button" href="<?php echo esc_url($deal_link); ?>"><?php echo esc_html($deal_link_text); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a class="deal-topbar-close" title="close" href="#"><i class="ekommart-icon-times-circle"></i></a>
                </div>
                <?php
            }
            ?>
            </div>
            <?php
        }
    }

}

$widgets_manager->register(new Ekommart_Elementor_Deal_Topbar());