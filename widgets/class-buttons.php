<?php 

class B2w_Buttons_Widget extends \Elementor\Widget_Base {

public function get_name() {
    return 'class-buttons';
}

public function get_title() {
    return __('Button','plugin-b2w');
}

public function get_icon() {
    return 'eicon-button';
}

public function get_custom_help_url() {}

public function get_categories() {
    return ['btwbuttons'];   
}

public function get_keywords() {
    return ['btw','botstrap'];
}


protected function register_controls() {
    $this->start_controls_section(
        'btw_button',
        [
            'label' => esc_html__( 'Button', 'plugin-b2w' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );
    $this->add_control(
        'button_text',
        [
            'label' =>__('Button Text','plugin-b2w'),
            'label_block' => true,
            'placeholder' =>__('Type sth here','plugin-b2w'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Learn more','plugin-b2w')
        ]
    );

    $this->add_control(
        'button_link',
        [
            'label' =>__('Button Link','plugin-b2w'),
            
            'type' => \Elementor\Controls_Manager::URL,
            'show_external' => true,
            'default' => ['#',
            'is_external' => true,
            'nofollow' =>false
        ],
        ]
    );

    $this->add_control(
        'button_style',
        ['label' =>__('Button Style', 'plugin-b2w'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'btn-primary',
        'options' =>[
            'btn-primary' =>__('Button Primary', 'plugin-b2w'),
            'btn-secondary' =>__('Button Secondary', 'plugin-b2w'),
            'btn-invert' =>__('Button Invert', 'plugin-b2w'),
        ]
        
        
        
        ]

    );  
    $this->add_control(

        'button_align', [
            'label ' => __('Alignment', 'plugin-b2w'),
            'type' =>\Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'text-start' => [
                    'title' => __('Left', 'plugin-b2w'),
                    'icon' => 'eicon-text-align-left'
                ],
                'text-center' => [
                    'title' => __('Center', 'plugin-b2w'),
                    'icon' => 'eicon-text-align-center'
                ],
                'text-end' => [ 
                    'title' => __('Right', 'plugin-b2w'),
                    'icon' => 'eicon-text-align-right'
                ],
            ],
            'defaul' =>'text-start',
            'toggle' => true
        ]
    
    
    );
    $this->end_controls_section();
}

protected function render() {
    $settings = $this->get_settings_for_display();
    $target = $settings['button_link']['is_external'] ? 'target = _blank' : '';
    $nofollow = $settings['button_link'] ['nofollow'] ? 'rel="nofollow"' : '';
    echo '<div class="link-box ' . $settings['button_align'] .'">';
    echo '<a href="' . $settings['button_link']['url'] .'" '. $target . $nofollow .' class="btn " '. $settings['button_style'] .'> ' . $settings['button_text'].'</a>';
    echo '</div>';
}



function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'btwbuttons',
		[
			'title' => esc_html__( 'First Category', 'plugin-b2w' ),
			'icon' => 'fa fa-plug',
		]
	);
	

}

}

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );  
