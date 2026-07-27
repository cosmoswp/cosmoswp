<?php
/**
 * Comment Options.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $cosmoswp_customize_control;

/* Comment section */
$wp_customize->add_section(
	'cosmoswp-comment-setting',
	array(
		'title'    => esc_html__( 'Comment Setting', 'cosmoswp' ),
		'panel'    => $this->panel,
		'priority' => 30,
	)
);

$wp_customize->add_setting(
	'cosmoswp-comment-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$cosmoswp_customize_control->add(
	new CosmosWP_Custom_Control_Message(
		$wp_customize,
		'cosmoswp-comment-setting-msg',
		array(
			'description' => sprintf(
				// translators: %1$s and %2$s are the opening and closing anchor tags linking to the Discussion Settings page.
				esc_html__( '%1$s More setting%2$s also while editing post/page', 'cosmoswp' ),
				"<a href='" . admin_url( 'options-discussion.php' ) . "' target='_blank'>",
				'</a>'
			),
			'section'     => 'cosmoswp-comment-setting',
		)
	)
);

/*Hide Comment*/
$wp_customize->add_setting(
	'cosmoswp-hide-comment',
	array(
		'default'           => $theme_option_defaults['cosmoswp-hide-comment'],
		'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
	)
);
$cosmoswp_customize_control->add(
	'cosmoswp-hide-comment',
	array(
		'label'    => esc_html__( 'Hide Comment', 'cosmoswp' ),
		'section'  => 'cosmoswp-comment-setting',
		'settings' => 'cosmoswp-hide-comment',
		'type'     => 'checkbox',
	)
);

/*Comment Title*/
$wp_customize->add_setting(
	'cosmoswp-comment-title',
	array(
		'default'           => $theme_option_defaults['cosmoswp-comment-title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$cosmoswp_customize_control->add(
	'cosmoswp-comment-title',
	array(
		'label'    => esc_html__( 'Comment Title', 'cosmoswp' ),
		'section'  => 'cosmoswp-comment-setting',
		'settings' => 'cosmoswp-comment-title',
		'type'     => 'text',
	)
);

/*Comment Button Text*/
$wp_customize->add_setting(
	'cosmoswp-comment-button-text',
	array(
		'default'           => $theme_option_defaults['cosmoswp-comment-button-text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$cosmoswp_customize_control->add(
	'cosmoswp-comment-button-text',
	array(
		'label'    => esc_html__( 'Comment Button Text', 'cosmoswp' ),
		'section'  => 'cosmoswp-comment-setting',
		'settings' => 'cosmoswp-comment-button-text',
		'type'     => 'text',
	)
);

/*Comment Notes After*/
$wp_customize->add_setting(
	'cosmoswp-comment-notes-after',
	array(
		'default'           => $theme_option_defaults['cosmoswp-comment-notes-after'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$cosmoswp_customize_control->add(
	'cosmoswp-comment-notes-after',
	array(
		'label'    => esc_html__( 'Comment Note After', 'cosmoswp' ),
		'section'  => 'cosmoswp-comment-setting',
		'settings' => 'cosmoswp-comment-notes-after',
		'type'     => 'text',
	)
);
