<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cosmoswp_header_layout_if_horizontal' ) ) :

	/**
	 * Check if header layout normal
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_header_layout_if_horizontal() {
		$option_list    = array( 'normal', 'cwp-overlay-fixed' );
		$choosed_option = cosmoswp_get_theme_options( 'header-position-options' );
		if ( in_array( $choosed_option, $option_list, true ) ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_indicator_if_text_or_both' ) ) :

	/**
	 * Check if off Canvas Indicator Text or both
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_indicator_if_text_or_both() {
		$option_list    = array( 'text', 'both' );
		$choosed_option = get_theme_mod( 'off-canvas-open-icon-options' );
		if ( in_array( $choosed_option, $option_list, true ) ) {

			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_close_indicator_if_text_or_both' ) ) :

	/**
	 * Check if off Canvas Indicator Text or both
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_close_indicator_if_text_or_both() {
		$option_list    = array( 'text', 'both' );
		$choosed_option = get_theme_mod( 'off-canvas-close-icon-options' );
		if ( in_array( $choosed_option, $option_list, true ) ) {

			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_indicator_if_icon_or_both' ) ) :

	/**
	 * Check if off Canvas Indicator Icon
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_indicator_if_icon_or_both() {
		$option_list    = array( 'icon', 'both' );
		$choosed_option = cosmoswp_get_theme_options( 'off-canvas-open-icon-options' );
		if ( in_array( $choosed_option, $option_list, true ) ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_close_indicator_if_icon_or_both' ) ) :

	/**
	 * Check if off Canvas Indicator Icon
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_close_indicator_if_icon_or_both() {
		$option_list    = array( 'icon', 'both' );
		$choosed_option = cosmoswp_get_theme_options( 'off-canvas-close-icon-options' );
		if ( in_array( $choosed_option, $option_list, true ) ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_indicator_if_both' ) ) :

	/**
	 * Check if off Canvas Indicator Both
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_indicator_if_both() {

		if ( 'both' === cosmoswp_get_theme_options( 'off-canvas-open-icon-options' ) ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_icon_typography_if_custom' ) ) :

	/**
	 * Check if menu typography custom
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_icon_typography_if_custom() {

		if ( ( 'custom' === cosmoswp_get_theme_options( 'off-canvas-open-text-typography-options' ) ) && ( 'icon' !== cosmoswp_get_theme_options( 'off-canvas-open-icon-options' ) ) ) {

			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_off_canvas_close_icon_typography_if_custom' ) ) :

	/**
	 * Check if menu typography custom
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_off_canvas_close_icon_typography_if_custom() {

		if ( ( 'custom' === cosmoswp_get_theme_options( 'off-canvas-close-text-typography-options' ) ) && ( 'icon' !== cosmoswp_get_theme_options( 'off-canvas-close-icon-options' ) ) ) {

			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'cosmoswp_responsive_menu_style_if_off_canvas' ) ) :

	/**
	 * Check if responsive menu style off canvas
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return boolean
	 */
	function cosmoswp_responsive_menu_style_if_off_canvas() {
		$cosmoswp_customizer_all_values = cosmoswp_get_theme_options();
		if ( 'off-canvas' === $cosmoswp_customizer_all_values['responsive-menu-style'] ) {
			return true;
		}
		return false;
	}
endif;


if ( ! function_exists( 'cosmoswp_validate_category_not_empty' ) ) {

	/**
	 * Validate Category is not empty
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @param $validity object validity.
	 * @param $value string value.
	 * @return mixed
	 */
	function cosmoswp_validate_category_not_empty( $validity, $value ) {
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		);
		if ( ( $value === 'from-category' ) && ( empty( $terms ) || is_wp_error( $terms ) ) ) {
			$validity->add( 'required', esc_html__( 'Category is empty', 'cosmoswp' ) );
		}
		return $validity;
	}
}
