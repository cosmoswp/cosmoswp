<?php
/**
 * EDD main content options.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/*Message*/
$wp_customize->add_setting(
	'edd-archive-url-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$description = sprintf(
/* translators: %1$s represents the opening anchor tag, %2$s represents the closing anchor tag.*/
	esc_html__( 'The options will work on %1$sEDD Archive %2$s page', 'cosmoswp' ),
	"<a href='" . esc_url( get_post_type_archive_link( 'download' ) ) . "' target='_blank'>",
	'</a>'
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Message(
		$wp_customize,
		'edd-archive-url-msg',
		array(
			'description' => $description,
			'section'     => $this->section,
		)
	)
);

/*EDD Archive Sidebar*/
$wp_customize->add_setting(
	'cwp-edd-archive-sidebar',
	array(
		'default'           => $defaults['cwp-edd-archive-sidebar'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
	)
);
$cosmoswp_customize_control->add(
	'cwp-edd-archive-sidebar',
	array(
		'label'     => esc_html__( 'Content/Sidebar', 'cosmoswp' ),
		'choices'   => cosmoswp_sidebar_options(),
		'section'   => $this->section,
		'settings'  => 'cwp-edd-archive-sidebar',
		'type'      => 'select',
		'transport' => 'postMessage',
	)
);

/* Edd main title */
$wp_customize->add_setting(
	'edd-archive-main-title',
	array(
		'default'           => $defaults['edd-archive-main-title'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'edd-archive-main-title',
	array(
		'label'    => esc_html__( 'Main Title', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'edd-archive-main-title',
		'type'     => 'text',
	)
);

/*Feature Layout*/
$wp_customize->add_setting(
	'edd-archive-default-view',
	array(
		'default'           => $defaults['edd-archive-default-view'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'edd-archive-default-view',
	array(
		'choices'  => array(
			'cwp-grid' => esc_html__( 'Grid', 'cosmoswp' ),
			'cwp-list' => esc_html__( 'List', 'cosmoswp' ),
		),
		'label'    => esc_html__( 'Default View', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'edd-archive-default-view',
		'type'     => 'select',
	)
);

/*Top Toolbar*/
$wp_customize->add_setting(
	'edd-archive-general-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'edd-archive-general-setting-msg',
		array(
			'label'   => esc_html__( 'General Setting', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

/*Sort Bar*/
$wp_customize->add_setting(
	'edd-archive-show-sort-bar',
	array(
		'default'           => $defaults['edd-archive-show-sort-bar'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'edd-archive-show-sort-bar',
	array(
		'label'    => esc_html__( 'Show Sort Bar', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'edd-archive-show-sort-bar',
		'type'     => 'checkbox',
	)
);

/*Grid List*/
$wp_customize->add_setting(
	'edd-archive-show-grid-list',
	array(
		'default'           => $defaults['edd-archive-show-grid-list'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'edd-archive-show-grid-list',
	array(
		'label'    => esc_html__( 'Show Grid List', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'edd-archive-show-grid-list',
		'type'     => 'checkbox',
	)
);

/*Downloads Per Row*/
$wp_customize->add_setting(
	'edd-show-downloads-per-row',
	array(
		'default'           => $defaults['edd-show-downloads-per-row'],
		'sanitize_callback' => 'cosmoswp_sanitize_slider_field',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Slider(
		$wp_customize,
		'edd-show-downloads-per-row',
		array(
			'label'       => esc_html__( 'Downloads Per Row', 'cosmoswp' ),
			'section'     => $this->section,
			'settings'    => 'edd-show-downloads-per-row',
			'input_attrs' => array(
				'min'  => 1,
				'max'  => 12,
				'step' => 1,
			),
		)
	)
);
/*Grid Elements*/
$wp_customize->add_setting(
	'edd-archive-grid-elements-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'edd-archive-grid-elements-msg',
		array(
			'label'   => esc_html__( 'Elements', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

$wp_customize->add_setting(
	'edd-archive-grid-elements',
	array(
		'default'           => $defaults['edd-archive-grid-elements'],
		'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_edd_archive_elements_sorting();
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Sortable(
		$wp_customize,
		'edd-archive-grid-elements',
		array(
			'choices'  => $choices,
			'section'  => $this->section,
			'settings' => 'edd-archive-grid-elements',
		)
	)
);

/*Title align*/
$wp_customize->add_setting(
	'edd-archive-elements-align',
	array(
		'default'           => $defaults['edd-archive-elements-align'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_text_align();
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Buttonset(
		$wp_customize,
		'edd-archive-elements-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Elements Alignment', 'cosmoswp' ),
			'section'  => $this->section,
			'settings' => 'edd-archive-elements-align',
		)
	)
);

/*Content Length*/
$wp_customize->add_setting(
	'edd-archive-content-length',
	array(
		'default'           => $defaults['edd-archive-content-length'],
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'edd-archive-content-length',
	array(
		'label'       => esc_html__( 'Excerpt length (count words)', 'cosmoswp' ),
		'description' => esc_html__( 'Please enter a number greater than 0.', 'cosmoswp' ),
		'section'     => $this->section,
		'settings'    => 'edd-archive-content-length',
		'type'        => 'number',
	)
);

/*Icon size*/
$wp_customize->add_setting(
	'edd-archive-list-media-width',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_slider_field',
		'default'           => $defaults['edd-archive-list-media-width'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Slider(
		$wp_customize,
		'edd-archive-list-media-width',
		array(
			'label'       => esc_html__( 'Image/Media Width (%)', 'cosmoswp' ),
			'section'     => $this->section,
			'settings'    => 'edd-archive-list-media-width',
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
			),
		)
	)
);

/*Pagination Options*/
$wp_customize->add_setting(
	'edd-navigation-options',
	array(
		'default'           => $defaults['edd-navigation-options'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_pagination_options();
$cosmoswp_customize_control->add(
	'edd-navigation-options',
	array(
		'choices'  => $choices,
		'label'    => esc_html__( 'Pagination Options', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'edd-navigation-options',
		'type'     => 'select',
	)
);

$partial_controls = array(
	'cwp-edd-archive-sidebar',
	'edd-archive-default-view',
	'edd-archive-show-sort-bar',
	'edd-archive-show-grid-list',
	'edd-show-downloads-per-row',
	'edd-archive-grid-elements',
	'edd-archive-elements-align',
	'edd-archive-content-length',
	'edd-archive-list-media-width',
	'edd-navigation-options',
);

foreach ( $partial_controls as $control_id ) {
	$this->add_selective_refresh( $wp_customize, $control_id );
}
