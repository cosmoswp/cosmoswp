<?php
/**
 * CosmosWP Theme Customizer.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require cosmoswp_file_directory( 'inc/customizer/custom-controls/back-compact/section/section.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/back-compact/callback.php' );
/*Register Section*/
$wp_customize->register_section_type( 'CosmosWP_WP_Customize_Section_H3' );
$wp_customize->register_section_type( 'CosmosWP_WP_Customize_Section_P' );
