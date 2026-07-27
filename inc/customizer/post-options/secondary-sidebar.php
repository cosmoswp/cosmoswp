<?php
/**
 * Secondary Sidebar Options.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/*Secondary Sidebar Section*/
$wp_customize->add_section(
	$this->secondary_sidebar,
	array(
		'title'    => esc_html__( 'Secondary Sidebar', 'cosmoswp' ),
		'priority' => 210,
		'panel'    => $this->panel,
	)
);

/*Secondary Sidebar*/
$wp_customize->add_setting(
	$this->secondary_sidebar,
	array(
		'sanitize_callback' => 'esc_attr',
		'capability'        => 'edit_theme_options',
	)
);
$description = sprintf(
	// translators: %1$s and %2$s are the opening and closing anchor tags for the customizer link.
	esc_html__( 'Add Secondary Sidebar Widgets from %1$s here%2$s', 'cosmoswp' ),
	'<a class="cosmoswp-customizer button button-primary" data-section="sidebar-widgets-cwp-secondary-sidebar">',
	'</a>'
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Message(
		$wp_customize,
		$this->secondary_sidebar,
		array(
			'description' => $description,
			'section'     => $this->secondary_sidebar,
		)
	)
);
