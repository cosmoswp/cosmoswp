<?php
/**
 * Default Theme Options
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'cosmoswp_get_default_theme_options' ) ) :
	/**
	 *  Default Theme layout options
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @return array $cosmoswp_theme_layout
	 */
	function cosmoswp_get_default_theme_options() {

		$default_theme_options = array(

			/*Header top options*/
			'header-top-options' => 'hide',
			'ajax-show-more'     => '',
			'ajax-no-more'       => '',
		);

		return apply_filters( 'cosmoswp_default_theme_options', $default_theme_options );
	}
endif;

if ( ! function_exists( 'cosmoswp_fresh_get_theme_options' ) ) :
	/**
	 * Get fresh theme option value without relying on cache.
	 *
	 * @since CosmosWP 2.0.0
	 *
	 * @param string $key Optional. Specific theme option key to retrieve.
	 * @return mixed|false Theme option value if key is provided, false otherwise.
	 */
	function cosmoswp_fresh_get_theme_options( $key = '' ) {
		if ( empty( $key ) ) {
			return false;
		}

		$default_options = cosmoswp_get_default_theme_options();
		$option_value    = get_theme_mod(
			$key,
			isset( $default_options[ $key ] ) ? $default_options[ $key ] : ''
		);

		return apply_filters( 'cosmoswp_' . $key, $option_value );
	}
endif;

if ( ! function_exists( 'cosmoswp_get_theme_options' ) ) :
	/**
	 * Get cached theme option or fresh during Customizer preview.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $key Optional. Specific theme option key to retrieve.
	 * @return mixed|false Theme option value if key is provided, false otherwise.
	 */
	function cosmoswp_get_theme_options( $key = '' ) {
		static $theme_mods_cache = null;

		if ( empty( $key ) ) {
			return false;
		}
		// Always use fresh values during Customizer preview.
		if ( is_customize_preview() ) {
			return cosmoswp_fresh_get_theme_options( $key );
		}

		// Load all theme mods once and cache.
		if ( null === $theme_mods_cache ) {
			$theme_mods_cache = get_theme_mods();
		}

		$defaults = cosmoswp_get_default_theme_options();

		$value = isset( $theme_mods_cache[ $key ] )
			? $theme_mods_cache[ $key ]
			: ( isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );

		return apply_filters( "cosmoswp_{$key}", $value );
	}
endif;
