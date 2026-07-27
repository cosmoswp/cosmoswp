<?php
/**
 * Starter Content
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get starter posts array for CosmosWP.
 *
 * @return array
 */
function cosmoswp_get_starter_posts() {
	$theme_directory = get_template_directory();
	$file_path       = $theme_directory . '/patterns/landing.php';

	ob_start();
	require $file_path;
	$file_contents = ob_get_clean();

	return apply_filters( 'cosmoswp_starter_posts',
		array(
			'home' => array(
				'post_title'   => esc_html__( 'Home', 'cosmoswp' ),
				'post_content' => $file_contents,
				'template'     => 'page-templates/template-full-width.php',
			),
			'blog' => array(
				'post_title'   => esc_html__( 'Blog', 'cosmoswp' ),
				'post_content' => '',
			),
		) );
}
