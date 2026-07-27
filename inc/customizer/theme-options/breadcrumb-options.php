<?php
/**
 * Breadcrumb Options.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $cosmoswp_customize_control;

/*Breadcrumb Options*/
$wp_customize->add_section(
	$this->breadcrumb_options,
	array(
		'title'    => esc_html__( 'Breadcrumb Options', 'cosmoswp' ),
		'panel'    => $this->panel,
		'priority' => 10,
	)
);

/*Breadcrumb Options*/
$wp_customize->add_setting(
	'cosmoswp-breadcrumb-options',
	array(
		'default'           => $theme_option_defaults['cosmoswp-breadcrumb-options'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
	)
);
$choices = cosmoswp_breadcrumb_options();
$cosmoswp_customize_control->add(
	'cosmoswp-breadcrumb-options',
	array(
		'choices'     => $choices,
		'label'       => esc_html__( 'Breadcrumb Options', 'cosmoswp' ),
		'description' => sprintf( 'Use any one of the plugin for Breadcrumb. %sBreadcrumb NavXT%s or %sYoast SEO%s or %sRank Math%s', '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">', '</a>', '<a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank">', '</a>', '<a href="https://wordpress.org/plugins/seo-by-rank-math/" target="_blank">', '</a>' ),
		'section'     => $this->breadcrumb_options,
		'settings'    => 'cosmoswp-breadcrumb-options',
		'type'        => 'select',
	)
);

/*Breadcrumb Display Location Msg*/
$wp_customize->add_setting(
	'breadcrumb-display-position-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'breadcrumb-display-position-msg',
		array(
			'label'           => esc_html__( 'Breadcrumb Display Location', 'cosmoswp' ),
			'description'     => esc_html__( 'Where to display breadcrumb ?', 'cosmoswp' ),
			'active_callback' => 'cosmoswp_breadcrumb_active_callback',
			'section'         => $this->breadcrumb_options,
		)
	)
);

/*Before Banner Title Breadcrumb */
$wp_customize->add_setting(
	'breadcrumb-before-banner-title',
	array(
		'default'           => $theme_option_defaults['breadcrumb-before-banner-title'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
	)
);
$cosmoswp_customize_control->add(
	'breadcrumb-before-banner-title',
	array(
		'label'           => esc_html__( 'Before Banner Title', 'cosmoswp' ),
		'section'         => $this->breadcrumb_options,
		'settings'        => 'breadcrumb-before-banner-title',
		'active_callback' => 'cosmoswp_breadcrumb_with_banner_active_callback',
		'type'            => 'checkbox',
	)
);

/*After Banner Title Breadcrumb */
$wp_customize->add_setting(
	'breadcrumb-after-banner-title',
	array(
		'default'           => $theme_option_defaults['breadcrumb-after-banner-title'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
	)
);
$cosmoswp_customize_control->add(
	'breadcrumb-after-banner-title',
	array(
		'label'           => esc_html__( 'After Banner Title', 'cosmoswp' ),
		'section'         => $this->breadcrumb_options,
		'settings'        => 'breadcrumb-after-banner-title',
		'active_callback' => 'cosmoswp_breadcrumb_with_banner_active_callback',
		'type'            => 'checkbox',
	)
);

/*Before Content Title Breadcrumb */
$wp_customize->add_setting(
	'breadcrumb-before-content',
	array(
		'default'           => $theme_option_defaults['breadcrumb-before-content'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
	)
);
$cosmoswp_customize_control->add(
	'breadcrumb-before-content',
	array(
		'label'           => esc_html__( 'Before Content', 'cosmoswp' ),
		'section'         => $this->breadcrumb_options,
		'settings'        => 'breadcrumb-before-content',
		'active_callback' => 'cosmoswp_breadcrumb_active_callback',
		'type'            => 'checkbox',
	)
);

/*Banner Breadcrumb Color Option Msg */
$wp_customize->add_setting(
	'breadcrumb-color-option-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'breadcrumb-color-option-msg',
		array(
			'label'           => esc_html__( 'Banner Breadcrumb Color Option', 'cosmoswp' ),
			'active_callback' => 'cosmoswp_breadcrumb_active_callback',
			'section'         => $this->breadcrumb_options,
		)
	)
);

/*Breadcrumb Color Options */
$wp_customize->add_setting(
	'breadcrumb-color-options',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_field_background',
		'default'           => $theme_option_defaults['breadcrumb-color-options'],
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Group(
		$wp_customize,
		'breadcrumb-color-options',
		array(
			'label'           => esc_html__( 'Color Options', 'cosmoswp' ),
			'section'         => $this->breadcrumb_options,
			'settings'        => 'breadcrumb-color-options',
			'active_callback' => 'cosmoswp_breadcrumb_active_callback',
		),
		array(
			'link-color'       => array(
				'type'  => 'color',
				'label' => esc_html__( 'Link Color', 'cosmoswp' ),
			),
			'link-hover-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Link Hover Color', 'cosmoswp' ),
			),
			'text-color'       => array(
				'type'  => 'color',
				'label' => esc_html__( 'Text Color', 'cosmoswp' ),
			),
		)
	)
);
