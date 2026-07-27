<?php
/**
 * Footer Sidebar 2.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/* Footer Sidebar 2*/
$footer_sidebar2 = $wp_customize->get_section( 'sidebar-widgets-footer-sidebar-2' );
if ( ! empty( $footer_sidebar2 ) ) {
	$footer_sidebar2->panel    = $this->panel;
	$footer_sidebar2->title    = esc_html__( 'Footer Sidebar 2', 'cosmoswp' );
	$footer_sidebar2->priority = 120;


	$wp_customize->add_setting(
		'footer-sidebar-2-widget-setting-msg',
		array(
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$cosmoswp_customize_control->add(
		new CosmosWP_Custom_Control_Heading(
			$wp_customize,
			'footer-sidebar-2-widget-setting-msg',
			array(
				'label'   => esc_html__( 'Widget Setting', 'cosmoswp' ),
				'section' => 'sidebar-widgets-footer-sidebar-2',
			)
		)
	);

	/*Footer Content Alignment*/
	$wp_customize->add_setting(
		'footer-sidebar-2-widget-setting-option',
		array(
			'default'           => $footer_defaults['footer-sidebar-2-widget-setting-option'],
			'sanitize_callback' => 'cosmoswp_sanitize_select',
			'transport'         => 'postMessage',
		)
	);
	$choices = cosmoswp_inherit_options();
	$cosmoswp_customize_control->add(
		'footer-sidebar-2-widget-setting-option',
		array(
			'label'    => esc_html__( 'Widget Setting Option', 'cosmoswp' ),
			'type'     => 'select',
			'section'  => 'sidebar-widgets-footer-sidebar-2',
			'settings' => 'footer-sidebar-2-widget-setting-option',
			'choices'  => $choices,
		)
	);

	/*Content align*/
	$wp_customize->add_setting(
		'footer-sidebar-2-content-align',
		array(
			'default'           => $footer_defaults['footer-sidebar-2-content-align'],
			'sanitize_callback' => 'cosmoswp_sanitize_select',
			'transport'         => 'postMessage',
		)
	);
	$choices = cosmoswp_text_align();
	$cosmoswp_customize_control->add(
		new CosmosWP_Custom_Control_Buttonset(
			$wp_customize,
			'footer-sidebar-2-content-align',
			array(
				'choices'         => $choices,
				'label'           => esc_html__( 'Content Alignment', 'cosmoswp' ),
				'section'         => 'sidebar-widgets-footer-sidebar-2',
				'settings'        => 'footer-sidebar-2-content-align',
				'active_callback' => 'cosmoswp_footer_sidebar_2_align',
			)
		)
	);

	/*Footer margin*/
	$wp_customize->add_setting(
		'footer-sidebar-2-margin',
		array(
			'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
			'default'           => $footer_defaults['footer-sidebar-2-margin'],
			'transport'         => 'postMessage',
		)
	);
	$cosmoswp_customize_control->add(
		new CosmosWP_Custom_Control_Cssbox(
			$wp_customize,
			'footer-sidebar-2-margin',
			array(
				'label'           => esc_html__( 'Margin (px)', 'cosmoswp' ),
				'section'         => 'sidebar-widgets-footer-sidebar-2',
				'settings'        => 'footer-sidebar-2-margin',
				'active_callback' => 'cosmoswp_footer_sidebar_2_align',
			),
			array(),
			array()
		)
	);

	/*Footer padding*/
	$wp_customize->add_setting(
		'footer-sidebar-2-padding',
		array(
			'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
			'default'           => $footer_defaults['footer-sidebar-2-padding'],
			'transport'         => 'postMessage',
		)
	);
	$cosmoswp_customize_control->add(
		new CosmosWP_Custom_Control_Cssbox(
			$wp_customize,
			'footer-sidebar-2-padding',
			array(
				'label'           => esc_html__( 'Padding (px)', 'cosmoswp' ),
				'section'         => 'sidebar-widgets-footer-sidebar-2',
				'settings'        => 'footer-sidebar-2-padding',
				'active_callback' => 'cosmoswp_footer_sidebar_2_align',
			),
			array(),
			array()
		)
	);
}
