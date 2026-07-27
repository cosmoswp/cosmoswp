<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cosmoswp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$breadcrumb_before_content = cosmoswp_get_theme_options( 'breadcrumb-before-content' );
get_header();
do_action( 'cosmoswp_action_before_edd_archive' );
if ( $breadcrumb_before_content ) {
	do_action( 'cosmoswp_action_breadcrumb' );
}
do_action( 'cosmoswp_action_edd_archive' );
do_action( 'cosmoswp_action_after_edd_archive' );
get_footer();
