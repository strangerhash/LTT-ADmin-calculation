<?php

if ( !class_exists( 'Kirki' ) ) {
	return;
}
if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' ) {
	Kirki::add_section( 'universal_store_woo_demo_section', array(
		'title'		 => __( 'WooCommerce Homepage Demo', 'universal-store' ),
		'priority'	 => 10,
	) );
}

Kirki::add_field( 'universal_store_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'universal_store_demo_front_page',
	'label'			 => __( 'Enable Demo Homepage?', 'universal-store' ),
	'description'	 => esc_html__( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. You can create your own unique homepage.', 'universal-store' ),
	'section'		 => 'universal_store_woo_demo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'universal_store_settings', array(
	'type'				 => 'radio-buttonset',
	'settings'			 => 'universal_store_front_page_demo_style',
	'label'				 => esc_html__( 'Homepage Demo Styles', 'universal-store' ),
	'description'		 => esc_html__( 'The demo homepage is enabled. You can choose from some predefined layouts or make your own.', 'universal-store' ),
	'section'			 => 'universal_store_woo_demo_section',
	'default'			 => 'style-one',
	'priority'			 => 10,
	'choices'			 => array(
		'style-one'	 => __( 'Layout one', 'universal-store' ),
		'style-two'	 => __( 'Layout two', 'universal-store' ),
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'universal_store_demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'universal_store_settings', array(
	'type'				 => 'switch',
	'settings'			 => 'universal_store_front_page_demo_carousel',
	'label'				 => __( 'Homepage slider', 'universal-store' ),
	'description'		 => esc_html__( 'Enable or disable demo homepage slider.', 'universal-store' ),
	'section'			 => 'universal_store_woo_demo_section',
	'default'			 => 1,
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'universal_store_demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'universal_store_settings', array(
	'type'				 => 'repeater',
	'label'				 => __( 'Slider', 'universal-store' ),
	'section'			 => 'universal_store_woo_demo_section',
	'priority'			 => 10,
	'settings'			 => 'universal_store_front_page_demo_repeater',
	'default'			 => array(
		array(
			'slider_img' => get_stylesheet_directory_uri() . '/img/demo/slider1.jpg',
			'slider_url' => '',
		),
		array(
			'slider_img' => get_stylesheet_directory_uri() . '/img/demo/slider2.jpg',
			'slider_url' => '',
		),
	),
	'fields'			 => array(
		'slider_img' => array(
			'type'		 => 'image',
			'label'		 => __( 'Slide image', 'universal-store' ),
			'default'	 => '',
		),
		'slider_url' => array(
			'type'		 => 'text',
			'label'		 => __( 'Slide URL', 'universal-store' ),
			'default'	 => '',
		),
	),
	'row_label'			 => array(
		'type'	 => 'text',
		'value'	 => __( 'Slide', 'universal-store' ),
	),
	'choices'			 => array(
		'limit' => 2,
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'universal_store_demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
		array(
			'setting'	 => 'universal_store_front_page_demo_carousel',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );

Kirki::add_field( 'universal_store_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'universal_store_demo_page_intro',
	'label'				 => __( 'Products', 'universal-store' ),
	'section'			 => 'universal_store_woo_demo_section',
	'description'		 => esc_html__( 'If you dont see any products or categories on your homepage, you dont have any products probably. Create some products and categories first.', 'universal-store' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'universal_store_demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'universal_store_settings', array(
	'type'			 => 'custom',
	'settings'		 => 'universal_store_demo_dummy_content',
	'label'			 => __( 'Need Dummy Products?', 'universal-store' ),
	'section'		 => 'universal_store_woo_demo_section',
	'description'	 => sprintf( esc_html__( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks. Check %s tutorial.', 'universal-store' ), '<a href="' . esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ) . '" target="_blank"><strong>' . __( 'THIS', 'universal-store' ) . '</strong></a>' ),
	'priority'		 => 10,
) );
