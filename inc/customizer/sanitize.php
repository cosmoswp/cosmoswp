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

if ( ! function_exists( 'cosmoswp_sanitize_number' ) ) :

	/**
	 * Function to sanitize number
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $cosmoswp_input The input value.
	 * @param object $cosmoswp_setting The setting object.
	 * @return int || float || numeric value
	 */
	function cosmoswp_sanitize_number( $cosmoswp_input, $cosmoswp_setting ) {
		$cosmoswp_sanitize_text = sanitize_text_field( $cosmoswp_input );

		// If the input is an number, return it; otherwise, return the default.
		return ( is_numeric( $cosmoswp_sanitize_text ) ? $cosmoswp_sanitize_text : $cosmoswp_setting->default );
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_checkbox' ) ) :

	/**
	 * Sanitizing the checkbox
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param mixed $checked is checkbox value.
	 * @return Boolean
	 */
	function cosmoswp_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && $checked ) ? true : false );
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_page' ) ) :

	/**
	 * Sanitizing the page/post
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param integer $input user input value.
	 * @return sanitized output as $input
	 */
	function cosmoswp_sanitize_page( $input ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $input );
		// If $page_id is an ID of a published page, return it; otherwise, return false.
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : false );
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_select' ) ) :

	/**
	 * Sanitizing the select callback example
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @see sanitize_key() https://developer.wordpress.org/reference/functions/sanitize_key/
	 *
	 * @param string               $input The input value.
	 * @param WP_Customize_Setting $setting The setting object.
	 * @return sanitized output
	 */
	function cosmoswp_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Try to get choices from the control first.
		$control = $setting->manager->get_control( $setting->id );
		if ( $control && isset( $control->choices ) && is_array( $control->choices ) ) {
			$choices = $control->choices;
		} elseif ( isset( $setting->choices ) && is_array( $setting->choices ) ) {
			$choices = $setting->choices;
		} else {
			return $input;
		}

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_allowed_html' ) ) :

	/**
	 * Function allowed HTML
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input The input value.
	 * @return string
	 */
	function cosmoswp_sanitize_allowed_html( $input ) {
		$output = wp_kses_post( $input );
		return $output;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_textarea' ) ) :

	/**
	 * Function Text Area
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input The input value.
	 * @return string
	 */
	function cosmoswp_sanitize_textarea( $input ) {
		if ( current_user_can( 'unfiltered_html' ) ) {
			$output = $input;
		} else {
			$output = cosmoswp_sanitize_allowed_html( $input );
		}
		return $output;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_color' ) ) :
	/**
	 * Color sanitization callback
	 * https://wordpress.stackexchange.com/questions/257581/escape-hexadecimals-rgba-values
	 *
	 * @param string $color The input value.
	 * @since 1.0.0
	 */
	function cosmoswp_sanitize_color( $color ) {
		if ( empty( $color ) || is_array( $color ) ) {
			return '';
		}

		// If string does not start with 'rgba', then treat as hex.
		if ( false === strpos( $color, 'rgba' ) ) {
			// Sanitize the hex color.
			// Check for 8-digit hex (e.g., #RRGGBBAA).
			if ( preg_match( '/^#([A-Fa-f0-9]{2}){4}$/', $color ) ) {
				// Extract components.
				$red   = hexdec( substr( $color, 1, 2 ) );
				$green = hexdec( substr( $color, 3, 2 ) );
				$blue  = hexdec( substr( $color, 5, 2 ) );
				$alpha = round( hexdec( substr( $color, 7, 2 ) ) / 255, 2 ); // Alpha from 0-255 to 0-1.

				return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
			}

			// For 3-digit (#RGB) or 6-digit (#RRGGBB) hex, use the standard WordPress function.
			return sanitize_hex_color( $color );
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_multi_choices' ) ) :

	/**
	 * Multi choices sanitization
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param array                $input   The array of choices.
	 * @param WP_Customize_Setting $setting The setting object.
	 * @return array Sanitized array of choices.
	 */
	function cosmoswp_sanitize_multi_choices( $input, $setting ) {

		$sanitized_input = array();
		// Try to get choices from the control first.
		$control = $setting->manager->get_control( $setting->id );
		if ( $control && isset( $control->choices ) && is_array( $control->choices ) ) {
			$choices = $control->choices;
		} elseif ( isset( $setting->choices ) && is_array( $setting->choices ) ) {
			$choices = $setting->choices;
		}

		if ( is_array( $input ) && ! empty( $choices ) ) {
			foreach ( $input as $value ) {
				if ( array_key_exists( $value, $choices ) ) {
					$sanitized_input[] = sanitize_text_field( $value );
				}
			}
			return $sanitized_input;

		} elseif ( is_array( $input ) ) {
			foreach ( $input as $value ) {
				$sanitized_input[] = sanitize_text_field( $value );
			}
			return $sanitized_input;
		}
		return array();
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_multicheck' ) ) :

	/**
	 * Multicheck sanitization
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param array|string $values The input value.
	 * @return array
	 */
	function cosmoswp_sanitize_multicheck( $values ) {
		$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
		return ! empty( $multi_values ) ? array_map( 'wp_kses_post', $multi_values ) : array();
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_field_typography' ) ) :

	/**
	 * Sanitize Typography
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input The input value.
	 * @return string $input
	 */
	function cosmoswp_sanitize_field_typography( $input ) {
		$input_decoded = json_decode( $input, true );
		$output        = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'font-type':
					case 'system-font':
					case 'google-font':
					case 'custom-font':
					case 'font-weight':
					case 'font-style':
					case 'text-decoration':
					case 'text-transform':
						$output[ $key ] = sanitize_text_field( $value );
						break;

					case 'font-size':
					case 'line-height':
					case 'letter-spacing':
						$devices_values = array();
						foreach ( $value as $device => $device_value ) {
							$devices_values[ $device ] = sanitize_text_field( $device_value );
						}
						$output[ $key ] = $devices_values;
						break;

					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return wp_json_encode( $output );
		}

		return $input;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_field_default_css_box' ) ) :

	/**
	 * Sanitize Default Css Box
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input The input value.
	 * @return string $input
	 */
	function cosmoswp_sanitize_field_default_css_box( $input ) {

		$input_decoded = json_decode( $input, true );
		$output        = array();
		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $device_id => $device_details ) {
				foreach ( $device_details as $key => $value ) {
					if ( 'cssbox_link' === $key ) {
						$output[ $device_id ][ $key ] = cosmoswp_sanitize_checkbox( $value );
					} else {
						$output[ $device_id ][ $key ] = cosmoswp_not_empty( $value ) ? intval( $value ) : '';
					}
				}
			}
			return wp_json_encode( $output );
		}
		return $input;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_field_border' ) ) :

	/**
	 * Sanitize Field Border
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input The input value.
	 * @return string $input
	 */
	function cosmoswp_sanitize_field_border( $input ) {
		$input_decoded = json_decode( $input, true );

		$output = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'border-style':
						$output[ $key ] = sanitize_key( $value );
						break;

					case 'border-width':
					case 'box-shadow-css':
					case 'border-radius':
						$devices_values = array();
						foreach ( $value as $device => $device_details ) {
							foreach ( $device_details as $device_key => $device_value ) {
								if ( $device_key === 'cssbox_link' ) {
									$devices_values[ $device ][ $device_key ] = cosmoswp_sanitize_checkbox( $device_value );
								} elseif ( cosmoswp_not_empty( $device_value ) ) {
									$devices_values[ $device ][ $device_key ] = absint( $device_value );
								} else {
									$devices_values[ $device ][ $device_key ] = '';
								}
							}
						}
						$output[ $key ] = $devices_values;
						break;

					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return wp_json_encode( $output );
		}

		return $input;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_field_background' ) ) :

	/**
	 * Sanitize Field Background
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input The input value.
	 * @return string $input
	 */
	function cosmoswp_sanitize_field_background( $input ) {

		$input_decoded = json_decode( $input, true );
		$output        = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'background-size':
					case 'background-position':
					case 'background-repeat':
					case 'background-attachment':
						$output[ $key ] = sanitize_key( $value );
						break;

					case 'background-image':
						$output[ $key ] = esc_url_raw( $value );
						break;
					case 'background-color':
					case 'background-hover-color':
					case 'background-color-title':
					case 'title-font-color':
					case 'background-color-post':
					case 'site-title-color':
					case 'site-tagline-color':
					case 'post-font-color':
					case 'text-color':
					case 'text-hover-color':
					case 'title-color':
					case 'link-color':
					case 'link-hover-color':
					case 'on-sale-bg':
					case 'on-sale-color':
					case 'out-of-stock-bg':
					case 'out-of-stock-color':
					case 'rating-color':
					case 'grid-list-color':
					case 'grid-list-hover-color':
					case 'categories-color':
					case 'categories-hover-color':
					case 'deleted-price-color':
					case 'deleted-price-hover-color':
					case 'price-color':
					case 'price-hover-color':
					case 'content-color':
					case 'content-hover-color':
					case 'tab-list-color':
					case 'tab-content-color':
					case 'tab-list-border-color':
					case 'tab-content-border-color':
					case 'background-stripped-color':
					case 'button-color':
					case 'button-hover-color':
					case 'icon-color':
					case 'icon-hover-color':
					case 'meta-color':
					case 'next-prev-color':
					case 'next-prev-hover-color':
					case 'button-bg-color':
					case 'button-bg-hover-color':
						$output[ $key ] = cosmoswp_sanitize_color( $value );
						break;
					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return wp_json_encode( $output );
		}

		return $input;
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_image' ) ) :

	/**
	 * Image sanitization callback
	 *
	 * @param string $image The input value.
	 * @param object $setting The setting object.
	 * @return string $input
	 * @since 1.2.1
	 */
	function cosmoswp_sanitize_image( $image, $setting ) {
		/*
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types()
		 */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);
		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );
		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_social_data' ) ) :

	/**
	 * Sanitization Social Data
	 *
	 * @since 1.2.1
	 * @param string $input The input value.
	 * @return string $input json encoded string
	 */
	function cosmoswp_sanitize_social_data( $input ) {
		$input_decoded = json_decode( $input, true );
		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $boxes => $box ) {
				foreach ( $box as $key => $value ) {
					if ( 'link' === $key ) {
						$input_decoded[ $boxes ][ $key ] = esc_url_raw( $value );
					} elseif ( 'checkbox' === $key ) {
						$input_decoded[ $boxes ][ $key ] = cosmoswp_sanitize_checkbox( $value );
					} elseif ( 'color' === $key ) {
						$input_decoded[ $boxes ][ $key ] = cosmoswp_sanitize_color( $value );
					} else {
						$input_decoded[ $boxes ][ $key ] = esc_attr( $value );
					}
				}
			}
			return wp_json_encode( $input_decoded );
		}
		return $input;
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_field_tabs' ) ) :

	/**
	 * Sanitization Tab Field Data
	 *
	 * @since 1.2.1
	 * @param  string $input The input value.
	 * @return string json encoded string
	 */
	function cosmoswp_sanitize_field_tabs( $input ) {

		$input_decoded = json_decode( $input, true );
		$output        = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'normal-border-style':
					case 'hover-border-style':
					case 'active-border-style':
						$output[ $key ] = sanitize_key( $value );
						break;

					case 'normal-text-color':
					case 'normal-bg-color':
					case 'normal-border-color':
					case 'normal-box-shadow':
					case 'hover-bg-color':
					case 'hover-border-color':
					case 'hover-box-shadow':
					case 'active-text-color':
					case 'active-bg-color':
					case 'active-border-color':
					case 'site-title-color':
					case 'site-tagline-color':
					case 'hover-site-title-color':
					case 'hover-site-tagline-color':
						$output[ $key ] = cosmoswp_sanitize_color( $value );
						break;

					case 'border-radius':
					case 'normal-border-width':
					case 'normal-border-radius':
					case 'normal-box-shadow-css':
					case 'hover-border-width':
					case 'hover-border-radius':
					case 'hover-box-shadow-css':
					case 'active-border-width':
					case 'active-border-radius':
						$devices_values = array();
						foreach ( $value as $device => $device_details ) {
							foreach ( $device_details as $device_key => $device_value ) {
								if ( $device_key === 'cssbox_link' ) {
									$devices_values[ $device ][ $device_key ] = cosmoswp_sanitize_checkbox( $device_value );
								} elseif ( cosmoswp_not_empty( $device_value ) ) {
									$devices_values[ $device ][ $device_key ] = absint( $device_value );
								} else {
									$devices_values[ $device ][ $device_key ] = '';
								}
							}
						}
						$output[ $key ] = $devices_values;
						break;

					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return wp_json_encode( $output );
		}

		return $input;
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_slider_field' ) ) :

	/**
	 * Sanitization Slider Field Data
	 *
	 * @since 1.2.1
	 * @param  string $input The input value.
	 * @return string json encoded string
	 */
	function cosmoswp_sanitize_slider_field( $input ) {
		$input_decoded = json_decode( $input, true );
		$output        = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $device => $value ) {
				if ( cosmoswp_not_empty( $value ) ) {
					$output[ $device ] = absint( $value );
				} else {
					$output[ $device ] = '';
				}
			}
			return wp_json_encode( $output );
		}

		return $input;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_slider_width_field' ) ) :

	/**
	 * Sanitization Slider Field Data
	 *
	 * @since 1.2.1
	 * @param  string $input The input value.
	 * @return string json encoded string
	 */
	function cosmoswp_sanitize_slider_width_field( $input ) {
		$input_decoded = json_decode( $input, true );
		$output        = array();

		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $device => $value ) {
				if ( ! empty( $value ) ) {
					$output[ $device ] = absint( $value );
				} elseif ( in_array( $value, array( '0', 0 ), true ) ) {
					$output[ $device ] = absint( $value );
				} else {
					$output[ $device ] = '';
				}
			}
			return wp_json_encode( $output );
		}

		return $input;
	}
endif;

if ( ! function_exists( 'cosmoswp_sanitize_radio' ) ) :
	/**
	 * Sanitization Radio Field Data
	 *
	 * @since 1.2.1
	 * @param  string $input The input value.
	 * @param  object $setting The setting object.
	 * @return string $input
	 */
	function cosmoswp_sanitize_radio( $input, $setting ) {

		// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only.
		$input = sanitize_key( $input );

		// Try to get choices from the control first.
		$control = $setting->manager->get_control( $setting->id );
		if ( $control && isset( $control->choices ) && is_array( $control->choices ) ) {
			$choices = $control->choices;
		} elseif ( isset( $setting->choices ) && is_array( $setting->choices ) ) {
			$choices = $setting->choices;
		} else {
			return $input;
		}

		if ( array_key_exists( $input, $choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
endif;

if ( ! function_exists( 'cosmoswp_is_json' ) ) :
	/**
	 * Check if Json
	 *
	 * @since 1.0.0
	 * @param  string $input The input value.
	 * @return boolean
	 */
	function cosmoswp_is_json( $input ) {
		return is_string( $input ) && is_array( json_decode( $input, true ) );
	}

endif;

if ( ! function_exists( 'cosmoswp_sanitize_responsive_range' ) ) :
	/**
	 * Sanitize responsive range input.
	 *
	 * @since 1.0.0
	 * @param  string $input The input value.
	 * @return string|float
	 */
	function cosmoswp_sanitize_responsive_range( $input ) {
		if ( ! cosmoswp_is_json( $input ) ) {
			return floatval( $input );
		}

		$range_value = json_decode( $input, true );

		$range_value['desktop'] = ( ! empty( $range_value['desktop'] ) || '0' === $range_value['desktop'] || 0 === $range_value['desktop'] ) ? floatval( $range_value['desktop'] ) : '';
		$range_value['tablet']  = ( ! empty( $range_value['tablet'] ) || '0' === $range_value['tablet'] || 0 === $range_value['tablet'] ) ? floatval( $range_value['tablet'] ) : '';
		$range_value['mobile']  = ( ! empty( $range_value['mobile'] ) || '0' === $range_value['mobile'] || 0 === $range_value['mobile'] ) ? floatval( $range_value['mobile'] ) : '';

		return wp_json_encode( $range_value );
	}
endif;


if ( ! function_exists( 'cosmoswp_sanitize_field_responsive_buttonset' ) ) :
	/**
	 * Sanitize responsive buttonset input.
	 *
	 * @since 1.0.0
	 * @param  string $input The input value.
	 * @return string json encoded string
	 */
	function cosmoswp_sanitize_field_responsive_buttonset( $input ) {

		$range_value = json_decode( $input, true );

		if ( ! is_array( $range_value ) ) {
			return wp_json_encode( array( 'desktop' => '', 'tablet' => '', 'mobile' => '' ) );
		}

		$range_value['desktop'] = ! empty( $range_value['desktop'] ) ? sanitize_text_field( $range_value['desktop'] ) : '';
		$range_value['tablet']  = ! empty( $range_value['tablet'] ) ? sanitize_text_field( $range_value['tablet'] ) : '';
		$range_value['mobile']  = ! empty( $range_value['mobile'] ) ? sanitize_text_field( $range_value['mobile'] ) : '';

		return wp_json_encode( $range_value );
	}

endif;
