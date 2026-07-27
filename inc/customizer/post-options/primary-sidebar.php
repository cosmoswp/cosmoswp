<?php
/**
 * Primary Sidebar Options.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/*Post Elements Starts from here*/
$wp_customize->add_section(
	new CosmosWP_WP_Customize_Section(
		$wp_customize,
		'cosmoswp_post_elements_separator',
		array(
			'title'    => esc_html__( 'Post Elements', 'cosmoswp' ),
			'panel'    => $this->panel,
			'priority' => 200,
		)
	)
);

/*Primary Sidebar Section*/
$wp_customize->add_section(
	$this->primary_sidebar,
	array(
		'title'    => esc_html__( 'Primary Sidebar', 'cosmoswp' ),
		'priority' => 210,
		'panel'    => $this->panel,
	)
);

/*Primary Sidebar*/
$wp_customize->add_setting(
	$this->primary_sidebar,
	array(
		'sanitize_callback' => 'esc_attr',
		'capability'        => 'edit_theme_options',
	)
);
$description = sprintf(
	// translators: %1$s and %2$s are the opening and closing anchor tags for the customizer link.
	esc_html__( 'Add Primary Sidebar Widgets from %1$s here%2$s', 'cosmoswp' ),
	'<a class="cosmoswp-customizer button button-primary" data-section="sidebar-widgets-cwp-primary-sidebar">',
	'</a>'
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Message(
		$wp_customize,
		$this->primary_sidebar,
		array(
			'description' => $description,
			'section'     => $this->primary_sidebar,
		)
	)
);
