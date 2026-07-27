<?php
/**
 * General settings.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*active callback function for banner video in all page of the site */
if ( ! function_exists( 'cosmoswp_custom_video_header_pages' ) ) :
	/**
	 * Enable Banner video in every pages
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_custom_video_header_pages() {
		$banner_section_display = cosmoswp_get_theme_options( 'banner-section-display' );
		if ( 'video' === $banner_section_display ) {
			return true;
		}
		return false;
	}

endif;


/*active callback function for banner section when background image set in main content area */
if ( ! function_exists( 'cosmoswp_banner_section_display_image' ) ) :

	/**
	 * Enable Banner and set background image main content
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_banner_section_display_image() {
		$banner_section_display = cosmoswp_get_theme_options( 'banner-section-display' );
		$banner_condition       = array( 'normal-image', 'bg-image', 'video' );
		if ( in_array( $banner_section_display, $banner_condition, true ) ) {
			return true;
		}
		return false;
	}
endif;
