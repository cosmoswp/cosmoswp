<?php
/**
 * Post Options Main Content
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/*Post Sidebar*/
$wp_customize->add_setting(
	'post-sidebar',
	array(
		'default'           => $post_defaults['post-sidebar'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
	)
);
$cosmoswp_customize_control->add(
	'post-sidebar',
	array(
		'label'    => esc_html__( 'Content/Sidebar', 'cosmoswp' ),
		'choices'  => cosmoswp_sidebar_options(),
		'section'  => cosmoswp_post_builder()->section,
		'settings' => 'post-sidebar',
		'type'     => 'select',
		'priority' => 35,
	)
);

/*Post Styling*/
$wp_customize->add_setting(
	'post-elements-sorting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$post_elements_sorting_msg_controls_data = array(
	'label'    => esc_html__( 'Post Elements Sorting', 'cosmoswp' ),
	'section'  => cosmoswp_post_builder()->section,
	'priority' => 50,
);
if ( function_exists( 'run_cosmoswp_pro' ) ) {
	$post_elements_sorting_msg_controls_data['active_callback'] = 'cosmoswp_disable_post_element_sorting';
}
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-elements-sorting-msg',
		$post_elements_sorting_msg_controls_data
	)
);

/*Post Elements Enable and Sorting*/
$wp_customize->add_setting(
	'post-elements-sorting',
	array(
		'default'           => $post_defaults['post-elements-sorting'],
		'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_posttype_elements_sorting();

$post_element_sorting_controls_data = array(
	'choices'  => $choices,
	'section'  => cosmoswp_post_builder()->section,
	'priority' => 60,
	'settings' => 'post-elements-sorting',
);
if ( function_exists( 'run_cosmoswp_pro' ) ) {
	$post_element_sorting_controls_data['active_callback'] = 'cosmoswp_disable_post_element_sorting';
}
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Sortable(
		$wp_customize,
		'post-elements-sorting',
		$post_element_sorting_controls_data
	)
);
/*Primary Meta Sorting Msg*/
$wp_customize->add_setting(
	'post-primary-meta-sorting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$post_primary_meta_sorting_msg_controls_data = array(
	'label'    => esc_html__( 'Primary Meta Sorting', 'cosmoswp' ),
	'section'  => cosmoswp_post_builder()->section,
	'priority' => 70,
);
if ( function_exists( 'run_cosmoswp_pro' ) ) {
	$post_primary_meta_sorting_msg_controls_data['active_callback'] = 'cosmoswp_disable_post_primary_meta_sorting';
}
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-primary-meta-sorting-msg',
		$post_primary_meta_sorting_msg_controls_data
	)
);

/*Primary Meta Sorting*/
$wp_customize->add_setting(
	'post-primary-meta-sorting',
	array(
		'default'           => $post_defaults['post-primary-meta-sorting'],
		'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_meta_elements_sorting();

$post_primary_meta_sorting_controls_data = array(
	'choices'  => $choices,
	'section'  => cosmoswp_post_builder()->section,
	'settings' => 'post-primary-meta-sorting',
	'priority' => 80,
);
if ( function_exists( 'run_cosmoswp_pro' ) ) {
	$post_primary_meta_sorting_controls_data['active_callback'] = 'cosmoswp_disable_post_primary_meta_sorting';
}
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Sortable(
		$wp_customize,
		'post-primary-meta-sorting',
		$post_primary_meta_sorting_controls_data
	)
);

/*Secondary Meta Sorting*/
$wp_customize->add_setting(
	'post-secondary-meta-sorting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$post_secondary_meta_sorting_msg_controls_data = array(
	'label'    => esc_html__( 'Secondary Meta Sorting', 'cosmoswp' ),
	'section'  => cosmoswp_post_builder()->section,
	'priority' => 90,
);
if ( function_exists( 'run_cosmoswp_pro' ) ) {
	$post_secondary_meta_sorting_msg_controls_data['active_callback'] = 'cosmoswp_disable_post_secondary_meta_sorting';
}
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-secondary-meta-sorting-msg',
		$post_secondary_meta_sorting_msg_controls_data
	)
);

/*Secondary Meta Sorting*/
$wp_customize->add_setting(
	'post-secondary-meta-sorting',
	array(
		'default'           => $post_defaults['post-secondary-meta-sorting'],
		'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
		'transport'         => 'postMessage',
	)
);
$choices                                   = cosmoswp_meta_elements_sorting();
$post_secondary_meta_sorting_controls_data = array(
	'choices'  => $choices,
	'section'  => cosmoswp_post_builder()->section,
	'settings' => 'post-secondary-meta-sorting',
	'priority' => 100,
);
if ( function_exists( 'run_cosmoswp_pro' ) ) {
	$post_secondary_meta_sorting_controls_data['active_callback'] = 'cosmoswp_disable_post_secondary_meta_sorting';
}

$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Sortable(
		$wp_customize,
		'post-secondary-meta-sorting',
		$post_secondary_meta_sorting_controls_data
	)
);

/*Post excerpt Setting Msg*/
$wp_customize->add_setting(
	'post-excerpt-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-excerpt-setting-msg',
		array(
			'label'    => esc_html__( 'Excerpt Setting', 'cosmoswp' ),
			'section'  => cosmoswp_post_builder()->section,
			'priority' => 110,
		)
	)
);

/*Post excerpt Length*/
$wp_customize->add_setting(
	'post-excerpt-length',
	array(
		'default'           => $post_defaults['post-excerpt-length'],
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	'post-excerpt-length',
	array(
		'label'       => esc_html__( 'Excerpt length (count words)', 'cosmoswp' ),
		'description' => esc_html__( 'Please enter a number greater than 0.', 'cosmoswp' ),
		'section'     => cosmoswp_post_builder()->section,
		'settings'    => 'post-excerpt-length',
		'priority'    => 120,
		'type'        => 'number',
	)
);

$wp_customize->add_setting(
	'post-excerpt-note-msg',
	array(
		'sanitize_callback' => 'esc_attr',
		'capability'        => 'edit_theme_options',
	)
);
$description = esc_html__( 'Note: Excerpt Options only works when excerpts is enable in "POST ELEMENTS SORTING".', 'cosmoswp' );
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Message(
		$wp_customize,
		'post-excerpt-note-msg',
		array(
			'description' => $description,
			'section'     => cosmoswp_post_builder()->section,
			'priority'    => 120,
		)
	)
);

/*Featured Image Setting*/
$wp_customize->add_setting(
	'post-featured-image-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-featured-image-setting-msg',
		array(
			'label'    => esc_html__( 'Featured Image Setting', 'cosmoswp' ),
			'section'  => cosmoswp_post_builder()->section,
			'priority' => 130,
		)
	)
);

/*Feature Layout*/
$wp_customize->add_setting(
	'post-feature-section-layout',
	array(
		'default'           => $post_defaults['post-feature-section-layout'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_feature_section_layout();
$cosmoswp_customize_control->add(
	'post-feature-section-layout',
	array(
		'choices'  => $choices,
		'label'    => esc_html__( 'Feature Section Layout', 'cosmoswp' ),
		'section'  => cosmoswp_post_builder()->section,
		'settings' => 'post-feature-section-layout',
		'type'     => 'select',
		'priority' => 140,
	)
);

/*Image Size*/
$wp_customize->add_setting(
	'post-img-size',
	array(
		'default'           => $post_defaults['post-img-size'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_get_image_sizes_options();
$cosmoswp_customize_control->add(
	'post-img-size',
	array(
		'choices'  => $choices,
		'label'    => esc_html__( 'Feature Image Size', 'cosmoswp' ),
		'section'  => cosmoswp_post_builder()->section,
		'settings' => 'post-img-size',
		'priority' => 150,
		'type'     => 'select',
	)
);


/*Additional Setting*/
$wp_customize->add_setting(
	'post-additional-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-additional-setting-msg',
		array(
			'label'    => esc_html__( 'Additional Setting', 'cosmoswp' ),
			'section'  => cosmoswp_post_builder()->section,
			'priority' => 160,
		)
	)
);

/*Pagination Options*/
$wp_customize->add_setting(
	'post-navigation-options',
	array(
		'default'           => $post_defaults['post-navigation-options'],
		'sanitize_callback' => 'cosmoswp_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = cosmoswp_single_pagination_options();
$cosmoswp_customize_control->add(
	'post-navigation-options',
	array(
		'choices'     => $choices,
		'label'       => esc_html__( 'Pagination Options', 'cosmoswp' ),
		'description' => esc_html__( 'Blog and Archive Pages Pagination', 'cosmoswp' ),
		'section'     => cosmoswp_post_builder()->section,
		'settings'    => 'post-navigation-options',
		'priority'    => 170,
		'type'        => 'select',
	)
);

$partial_controls = array(
	'post-elements-sorting',
	'post-primary-meta-sorting',
	'post-secondary-meta-sorting',
	'post-excerpt-length',
	'post-feature-section-layout',
	'post-img-size',
	'post-navigation-options',
);

foreach ( $partial_controls as $control_id ) {
	$this->add_selective_refresh( $wp_customize, $control_id );
}

/*Color Options*/
$wp_customize->add_setting(
	'post-pagination-color-options',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_field_background',
		'default'           => $post_defaults['post-pagination-color-options'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Group(
		$wp_customize,
		'post-pagination-color-options',
		array(
			'label'           => esc_html__( 'Color Options', 'cosmoswp' ),
			'section'         => cosmoswp_post_builder()->section,
			'settings'        => 'post-pagination-color-options',
			'priority'        => 180,
			'active_callback' => 'cosmoswp_post_pagination_activecallback',
		),
		array(
			'next-prev-color'       => array(
				'type'  => 'color',
				'label' => esc_html__( 'Next/Prev Color', 'cosmoswp' ),
			),
			'next-prev-hover-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Next/Prev Hover Color', 'cosmoswp' ),
			),
			'text-color'            => array(
				'type'  => 'color',
				'label' => esc_html__( 'Title Color', 'cosmoswp' ),
			),
			'text-hover-color'      => array(
				'type'  => 'color',
				'label' => esc_html__( 'Title Hover Color', 'cosmoswp' ),
			),
		)
	)
);

/*Post General Styling*/
$wp_customize->add_setting(
	'post-main-content-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Heading(
		$wp_customize,
		'post-main-content-styling-msg',
		array(
			'label'    => esc_html__( 'Main Content Styling', 'cosmoswp' ),
			'section'  => cosmoswp_post_builder()->section,
			'priority' => 200,
		)
	)
);
/*Margin*/
$wp_customize->add_setting(
	'post-main-content-margin',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
		'default'           => $post_defaults['post-main-content-margin'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Cssbox(
		$wp_customize,
		'post-main-content-margin',
		array(
			'label'    => esc_html__( 'Margin (px)', 'cosmoswp' ),
			'section'  => cosmoswp_post_builder()->section,
			'settings' => 'post-main-content-margin',
			'priority' => 200,
		),
		array(),
		array()
	)
);
/*Padding*/
$wp_customize->add_setting(
	'post-main-content-padding',
	array(
		'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
		'default'           => $post_defaults['post-main-content-padding'],
		'transport'         => 'postMessage',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Cssbox(
		$wp_customize,
		'post-main-content-padding',
		array(
			'label'    => esc_html__( 'Padding (px)', 'cosmoswp' ),
			'section'  => cosmoswp_post_builder()->section,
			'settings' => 'post-main-content-padding',
			'priority' => 200,
		),
		array(),
		array()
	)
);
