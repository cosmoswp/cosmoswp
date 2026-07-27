<?php
/**
 * WooCommerce main content options.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/*Woo Single Sidebar*/
$wp_customize->add_setting(
	'cwp-woo-single-sidebar',
	array(
		'default'           => $defaults['cwp-woo-single-sidebar'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwp-woo-single-sidebar',
	array(
		'label'    => esc_html__( 'Content/Sidebar', 'cosmoswp' ),
		'choices'  => cosmoswp_sidebar_options(),
		'section'  => $this->section,
		'settings' => 'cwp-woo-single-sidebar',
		'type'     => 'select',
	)
);

/*Elements*/
$wp_customize->add_setting(
	'cwc-single-elements-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'cwc-single-elements-msg',
		array(
			'label'   => esc_html__( 'Grid Elements', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

/*Woo single elements*/
$wp_customize->add_setting(
	'cwc-single-elements',
	array(
		'default'           => $defaults['cwc-single-elements'],
		'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_woo_single_elements();
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Sortable(
		$wp_customize,
		'cwc-single-elements',
		array(
			'choices'  => $choices,
			'section'  => $this->section,
			'settings' => 'cwc-single-elements',
		)
	)
);

/*Media size*/
$wp_customize->add_setting(
	'cwc-single-media-width',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_slider_field',
		'default'           => $defaults['cwc-single-media-width'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Slider(
		$wp_customize,
		'cwc-single-media-width',
		array(
			'label'       => esc_html__( 'Image/Media Width (%)', 'cosmoswp' ),
			'section'     => $this->section,
			'settings'    => 'cwc-single-media-width',
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
			),
		)
	)
);

/*Product Tabs*/
$wp_customize->add_setting(
	'cwc-single-product-tab-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'cwc-single-product-tab-msg',
		array(
			'label'   => esc_html__( 'Tab Setting', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

/*Tab Design*/
$wp_customize->add_setting(
	'cwc-single-tab-design',
	array(
		'default'           => $defaults['cwc-single-tab-design'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_woo_single_tab_design();
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Buttonset(
		$wp_customize,
		'cwc-single-tab-design',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Tab Design', 'cosmoswp' ),
			'section'  => $this->section,
			'settings' => 'cwc-single-tab-design',
		)
	)
);

/*Sort Desc Heading*/
$wp_customize->add_setting(
	'cwc-single-tab-show-content-heading',
	array(
		'default'           => $defaults['cwc-single-tab-show-content-heading'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-single-tab-show-content-heading',
	array(
		'label'    => esc_html__( 'Show Tab Content Heading', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'cwc-single-tab-show-content-heading',
		'type'     => 'checkbox',
	)
);

/*Upsell Product*/
$wp_customize->add_setting(
	'cwc-single-product-upsell-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'cwc-single-product-upsell-msg',
		array(
			'label'   => esc_html__( 'Upsell Setting', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

/*Upsell Number*/
$wp_customize->add_setting(
	'cwc-single-upsell-number',
	array(
		'default'           => $defaults['cwc-single-upsell-number'],
		'sanitize_callback' => 'cosmoswp_sanitize_number',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-single-upsell-number',
	array(
		'label'       => esc_html__( 'Number', 'cosmoswp' ),
		'section'     => $this->section,
		'settings'    => 'cwc-single-upsell-number',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	)
);

/*Upsell Column*/
$wp_customize->add_setting(
	'cwc-single-upsell-col',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_number',
		'default'           => $defaults['cwc-single-upsell-col'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-single-upsell-col',
	array(
		'label'       => esc_html__( 'Upsell Column', 'cosmoswp' ),
		'section'     => $this->section,
		'settings'    => 'cwc-single-upsell-col',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1,
		),
	)
);

/*Related Product*/
$wp_customize->add_setting(
	'cwc-single-product-related-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'cwc-single-product-related-msg',
		array(
			'label'   => esc_html__( 'Related Setting', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);
/*Related Number*/
$wp_customize->add_setting(
	'cwc-single-related-number',
	array(
		'default'           => $defaults['cwc-single-related-number'],
		'sanitize_callback' => 'cosmoswp_sanitize_number',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-single-related-number',
	array(
		'label'       => esc_html__( 'Number', 'cosmoswp' ),
		'section'     => $this->section,
		'settings'    => 'cwc-single-related-number',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	)
);
/*Related column*/
$wp_customize->add_setting(
	'cwc-single-related-col',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_number',
		'default'           => $defaults['cwc-single-related-col'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-single-related-col',
	array(
		'label'       => esc_html__( 'Related Column', 'cosmoswp' ),
		'section'     => $this->section,
		'settings'    => 'cwc-single-related-col',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1,
		),
	)
);

$partial_controls = array(
	'cwp-woo-single-sidebar',
	'cwc-single-elements',
	'cwc-single-media-width',
	'cwc-single-tab-design',
	'cwc-single-tab-show-content-heading',
	'cwc-single-upsell-number',
	'cwc-single-upsell-col',
	'cwc-single-related-number',
	'cwc-single-related-col',
);

foreach ( $partial_controls as $control_id ) {
	$this->add_selective_refresh( $wp_customize, $control_id );
}
