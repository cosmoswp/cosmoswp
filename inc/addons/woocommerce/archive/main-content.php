<?php
/**
 * WooCommerce Archive Options.
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
	'woo-archive-url-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$description = sprintf(
/* translators: %1$s represents the opening anchor tag, %2$s represents the closing anchor tag.*/
	esc_html__( 'The options will work on %1$sWooCommerce Archive %2$s page', 'cosmoswp' ),
	"<a href='" . esc_url( get_post_type_archive_link( 'product' ) ) . "' target='_blank'>",
	'</a>'
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Message(
		$wp_customize,
		'woo-archive-url-msg',
		array(
			'description' => $description,
			'section'     => $this->section,
		)
	)
);

/*Woo Archive Sidebar*/
$wp_customize->add_setting(
	'cwp-woo-archive-sidebar',
	array(
		'default'           => $defaults['cwp-woo-archive-sidebar'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwp-woo-archive-sidebar',
	array(
		'label'    => esc_html__( 'Content/Sidebar', 'cosmoswp' ),
		'choices'  => cosmoswp_sidebar_options(),
		'section'  => $this->section,
		'settings' => 'cwp-woo-archive-sidebar',
		'type'     => 'select',
	)
);
/*Feature Layout*/
$wp_customize->add_setting(
	'cwc-archive-default-view',
	array(
		'default'           => $defaults['cwc-archive-default-view'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-default-view',
	array(
		'choices'  => array(
			'grid' => esc_html__( 'Grid', 'cosmoswp' ),
			'list' => esc_html__( 'List', 'cosmoswp' ),
		),
		'label'    => esc_html__( 'Default View', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'cwc-archive-default-view',
		'type'     => 'select',
	)
);

/*Woo Archive Sidebar Responsive Icon*/
$wp_customize->add_setting(
	'cwc-archive-psp-sm',
	array(
		'default'           => $defaults['cwc-archive-psp-sm'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-psp-sm',
	array(
		'label'    => esc_html__( 'Popup primary sidebar on Small Device', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'cwc-archive-psp-sm',
		'type'     => 'checkbox',
	)
);
$wp_customize->add_setting(
	'cwc-archive-psp-sm-open-text',
	array(
		'default'           => $defaults['cwc-archive-psp-sm-open-text'],
		'sanitize_callback' => 'cosmoswp_sanitize_allowed_html',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-psp-sm-open-text',
	array(
		'label'              => esc_html__( 'Popup open text/html', 'cosmoswp' ),
		'section'            => $this->section,
		'settings'           => 'cwc-archive-psp-sm-open-text',
		'type'               => 'text',
		'active_callback_js' => array(
			'setting' => 'cwc-archive-psp-sm',
			'value'   => true,
			'compare' => '==',
		),
	)
);
$wp_customize->add_setting(
	'cwc-archive-psp-sm-close-text',
	array(
		'default'           => $defaults['cwc-archive-psp-sm-close-text'],
		'sanitize_callback' => 'cosmoswp_sanitize_allowed_html',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-psp-sm-close-text',
	array(
		'label'              => esc_html__( 'Popup close text/html', 'cosmoswp' ),
		'section'            => $this->section,
		'settings'           => 'cwc-archive-psp-sm-close-text',
		'type'               => 'text',
		'active_callback_js' => array(
			'setting' => 'cwc-archive-psp-sm',
			'value'   => true,
			'compare' => '==',
		),
	)
);
/*Top Toolbar*/
$wp_customize->add_setting(
	'cwc-archive-general-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'cwc-archive-general-setting-msg',
		array(
			'label'   => esc_html__( 'General Setting', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

/*Grid List*/
$wp_customize->add_setting(
	'cwc-archive-show-grid-list',
	array(
		'default'           => $defaults['cwc-archive-show-grid-list'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-show-grid-list',
	array(
		'label'    => esc_html__( 'Show Grid List', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'cwc-archive-show-grid-list',
		'type'     => 'checkbox',
	)
);

/*Number of result Bar*/
$wp_customize->add_setting(
	'cwc-archive-show-result-number',
	array(
		'default'           => $defaults['cwc-archive-show-result-number'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-show-result-number',
	array(
		'label'    => esc_html__( 'Show Result Number', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'cwc-archive-show-result-number',
		'type'     => 'checkbox',
	)
);

/*Sort Bar*/
$wp_customize->add_setting(
	'cwc-archive-show-sort-bar',
	array(
		'default'           => $defaults['cwc-archive-show-sort-bar'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-show-sort-bar',
	array(
		'label'    => esc_html__( 'Show Sort Bar', 'cosmoswp' ),
		'section'  => $this->section,
		'settings' => 'cwc-archive-show-sort-bar',
		'type'     => 'checkbox',
	)
);

/*Elements*/
$wp_customize->add_setting(
	'cwc-archive-elements-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'cwc-archive-elements-msg',
		array(
			'label'   => esc_html__( 'Elements', 'cosmoswp' ),
			'section' => $this->section,
		)
	)
);

/*Woo Archive Elements*/
$wp_customize->add_setting(
	'cwc-archive-elements',
	array(
		'default'           => $defaults['cwc-archive-elements'],
		'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_woo_archive_elements_sorting();
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Sortable(
		$wp_customize,
		'cwc-archive-elements',
		array(
			'choices'  => $choices,
			'section'  => $this->section,
			'settings' => 'cwc-archive-elements',
		)
	)
);

/*Align*/
$wp_customize->add_setting(
	'cwc-archive-elements-align',
	array(
		'default'           => $defaults['cwc-archive-elements-align'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_text_align();
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Buttonset(
		$wp_customize,
		'cwc-archive-elements-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Elements Alignment', 'cosmoswp' ),
			'section'  => $this->section,
			'settings' => 'cwc-archive-elements-align',
		)
	)
);

/*Content Length*/
$wp_customize->add_setting(
	'cwc-archive-excerpt-length',
	array(
		'default'           => $defaults['cwc-archive-excerpt-length'],
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'cwc-archive-excerpt-length',
	array(
		'label'       => esc_html__( 'Excerpt length (count words)', 'cosmoswp' ),
		'description' => esc_html__( 'Please enter a number greater than 0.', 'cosmoswp' ),
		'section'     => $this->section,
		'settings'    => 'cwc-archive-excerpt-length',
		'type'        => 'number',
	)
);

/*Icon size*/
$wp_customize->add_setting(
	'cwc-archive-list-media-width',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_slider_field',
		'default'           => $defaults['cwc-archive-list-media-width'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Slider(
		$wp_customize,
		'cwc-archive-list-media-width',
		array(
			'label'       => esc_html__( 'List View Image/Media Width (%)', 'cosmoswp' ),
			'section'     => $this->section,
			'settings'    => 'cwc-archive-list-media-width',
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
			),
		)
	)
);

/*WooCommerce Archive Responsive Columns*/
$wp_customize->add_setting(
	'cwc-archive-responsive-col',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_field_tabs',
		'default'           => $defaults['cwc-archive-responsive-col'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Tabs(
		$wp_customize,
		'cwc-archive-responsive-col',
		array(
			'label'       => esc_html__( 'Archive Responsive Columns', 'cosmoswp' ),
			'description' => esc_html__( 'WooCommerce Archive Responsive Columns. Desktop Column is defined from above "Products per row" option.', 'cosmoswp' ),
			'section'     => 'woocommerce_product_catalog',
			'settings'    => 'cwc-archive-responsive-col',
		),
		array(
			'tabs'   => array(
				'tab'    => array(
					'label' => esc_html__( 'Tab', 'cosmoswp' ),
				),
				'mobile' => array(
					'label' => esc_html__( 'Mobile', 'cosmoswp' ),
				),
			),
			'fields' => array(
				'tab-col'    => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Tab Column', 'cosmoswp' ),
					'options' => array(
						'1' => esc_html__( '1', 'cosmoswp' ),
						'2' => esc_html__( '2', 'cosmoswp' ),
						'3' => esc_html__( '3', 'cosmoswp' ),
						'4' => esc_html__( '4', 'cosmoswp' ),
						'5' => esc_html__( '5', 'cosmoswp' ),
						'6' => esc_html__( '6', 'cosmoswp' ),
					),
					'tab'     => 'tab',
				),
				'mobile-col' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Mobile Column', 'cosmoswp' ),
					'options' => array(
						'1' => esc_html__( '1', 'cosmoswp' ),
						'2' => esc_html__( '2', 'cosmoswp' ),
						'3' => esc_html__( '3', 'cosmoswp' ),
						'4' => esc_html__( '4', 'cosmoswp' ),
						'5' => esc_html__( '5', 'cosmoswp' ),
						'6' => esc_html__( '6', 'cosmoswp' ),
					),
					'tab'     => 'mobile',
				),
			),
		)
	)
);
$partial_controls = array(
	'cwp-woo-archive-sidebar',
	'cwc-archive-default-view',
	'cwc-archive-psp-sm',
	'cwc-archive-psp-sm-open-text',
	'cwc-archive-psp-sm-close-text',
	'cwc-archive-show-grid-list',
	'cwc-archive-show-result-number',
	'cwc-archive-show-sort-bar',
	'cwc-archive-elements',
	'cwc-archive-elements-align',
	'cwc-archive-excerpt-length',
	'cwc-archive-list-media-width',
	'cwc-archive-responsive-col',
);

foreach ( $partial_controls as $control_id ) {
	$this->add_selective_refresh( $wp_customize, $control_id );
}
