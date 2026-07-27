<?php
/**
 * Custom Functions
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cosmoswp_get_settings_by_type' ) ) {
	/**
	 * Filters settings by type with configurable pattern matching
	 *
	 * @param array        $settings    Array of setting keys to filter.
	 * @param string       $type        The filter type ('css' or any partial type).
	 * @param array|string $patterns    Optional patterns for matching:
	 *                                 - Array of patterns for CSS type
	 *                                 - String 'inverse' to get non-CSS settings (default for partials)
	 *                                 - Array of patterns for partial type matching.
	 *
	 * @return array Filtered array of settings based on type
	 */
	function cosmoswp_get_settings_by_type( $settings, $type, $patterns = null ) {

		// Default CSS patterns.
		$default_css_patterns = array(
			'size',
			'margin',
			'padding',
			'styling',
			'color',
			'border',
			'background',
			'width',
		);

		$filtered    = array();
		$is_css_type = ( 'css' === $type );

		// Handle pattern configuration.
		if ( null === $patterns ) {
			$patterns = $is_css_type ? $default_css_patterns : 'inverse';
		}

		foreach ( $settings as $setting ) {
			$setting_lower = strtolower( $setting );
			$match_found   = false;

			if ( $is_css_type ) {
				// CSS type matching.
				foreach ( (array) $patterns as $pattern ) {
					if ( false !== strpos( $setting_lower, strtolower( $pattern ) ) ) {
						$match_found = true;
						break;
					}
				}
			} elseif ( is_array( $patterns ) ) {
				// Custom partial type matching.
				foreach ( $patterns as $pattern ) {
					if ( false !== strpos( $setting_lower, strtolower( $pattern ) ) ) {
						$match_found = true;
						break;
					}
				}
			} else {
				// Inverse matching (default for partials).
				foreach ( $default_css_patterns as $pattern ) {
					if ( false !== strpos( $setting_lower, $pattern ) ) {
						$match_found = true;
						break;
					}
				}
				$match_found = ! $match_found;
			}

			if ( $match_found ) {
				$filtered[] = $setting;
			}
		}

		return $filtered;
	}
}


if ( ! function_exists( 'cosmoswp_maybe_add_css' ) ) {
	/**
	 * Helper function to conditionally add CSS property.
	 *
	 * @param string $property CSS property name.
	 * @param string $value CSS property value.
	 * @return string CSS string if value is not empty, otherwise empty string.
	 */
	function cosmoswp_maybe_add_css( $property, $value ) {
		return ! empty( $value ) ? $property . ':' . $value . ';' : '';
	}
}


if ( ! function_exists( 'cosmoswp_generate_box_shadow_css' ) ) {
	/**
	 * Helper function to generate box-shadow CSS.
	 *
	 * @param string $shadow_values Box shadow values (e.g., '10px 5px 5px').
	 * @param string $color Shadow color.
	 * @return string Box shadow CSS string.
	 */
	function cosmoswp_generate_box_shadow_css( $shadow_values, $color ) {
		if ( $shadow_values ) {
			$shadow_string = $shadow_values . ( $color ? ' ' . $color : '' );
			return '-webkit-box-shadow:' . $shadow_string . ';-moz-box-shadow:' . $shadow_string . ';box-shadow:' . $shadow_string . ';';
		}
		return '';
	}
}

if ( ! function_exists( 'cosmoswp_string_concator' ) ) {

	/**
	 * Concat string
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $string1 String 1.
	 * @param string $string2 String 2.
	 * @param string $string3 String 3.
	 * @param string $string4 String 4.
	 * @param string $string5 String 5.
	 * @return string
	 */
	function cosmoswp_string_concator( $string1, $string2, $string3 = '', $string4 = '', $string5 = '' ) {
		$concated_string = '';
		if ( ! empty( $string1 ) && is_string( $string1 ) ) {
			$concated_string = $concated_string . ' ' . $string1;
		}
		if ( ! empty( $string2 ) && is_string( $string2 ) ) {
			$concated_string = $concated_string . ' ' . $string2;
		}
		if ( ! empty( $string3 ) && is_string( $string3 ) ) {
			$concated_string = $concated_string . ' ' . $string3;
		}
		if ( ! empty( $string4 ) && is_string( $string4 ) ) {
			$concated_string = $concated_string . ' ' . $string4;
		}
		if ( ! empty( $string5 ) && is_string( $string5 ) ) {
			$concated_string = $concated_string . ' ' . $string5;
		}
		return $concated_string;
	}
}

if ( ! function_exists( 'cosmoswp_responsive_button_value' ) ) {

	/**
	 * Responsive button value
	 *
	 * @param  array  $button_group Button group.
	 * @param  string $device Device type.
	 * @return string
	 */
	function cosmoswp_responsive_button_value( $button_group, $device ) {

		$button_val = '';
		if ( ! is_array( $button_group ) ) {
			return false;
		}
		foreach ( $button_group as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' === $device ) {
						if ( ! empty( $value ) ) {

							$button_val = $value . '-desktop';
						}
					}
					break;

				case 'tablet':
					if ( 'tablet' === $device ) {
						if ( ! empty( $value ) ) {
							$button_val = $value . '-tablet';
						}
					}
					break;

				case 'mobile':
					if ( 'mobile' === $device ) {
						if ( ! empty( $value ) ) {
							$button_val = $value . '-mobile';
						}
					}
					break;

				default:
					break;
			}
		}
		return $button_val;
	}
}

if ( ! function_exists( 'cosmoswp_cssbox_values_inline' ) ) {

	/**
	 * CSS box values inline
	 *
	 * @param  array  $position_collection Position collection.
	 * @param  string $device Device type.
	 * @return string
	 */
	function cosmoswp_cssbox_values_inline( $position_collection, $device ) {

		$inline_css = '';
		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' === $device ) {

						$top    = ( array_key_exists( 'top', $value ) && cosmoswp_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( array_key_exists( 'right', $value ) && cosmoswp_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( array_key_exists( 'bottom', $value ) && cosmoswp_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( array_key_exists( 'left', $value ) && cosmoswp_not_empty( $value['left'] ) ) ? $value['left'] : '';

						if ( cosmoswp_not_empty( $top ) || cosmoswp_not_empty( $right ) || cosmoswp_not_empty( $bottom ) || cosmoswp_not_empty( $left ) ) {
							$top    = ( cosmoswp_not_empty( $top ) ) ? $top . 'px' : 0;
							$right  = ( cosmoswp_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom = ( cosmoswp_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left   = ( cosmoswp_not_empty( $left ) ) ? $left . 'px' : 0;
							if ( '0px' === $top && '0px' === $right && '0px' === $bottom && '0px' === $left ) {
								$inline_css = '0px';
							} else {
								$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;

							}
						}
					}
					break;

				case 'tablet':
					if ( 'tablet' === $device ) {

						$top    = ( isset( $value['top'] ) && cosmoswp_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && cosmoswp_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && cosmoswp_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && cosmoswp_not_empty( $value['left'] ) ) ? $value['left'] : '';

						if ( cosmoswp_not_empty( $top ) || cosmoswp_not_empty( $right ) || cosmoswp_not_empty( $bottom ) || cosmoswp_not_empty( $left ) ) {
							$top        = ( cosmoswp_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( cosmoswp_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( cosmoswp_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( cosmoswp_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						}
					}
					break;

				case 'mobile':
					if ( 'mobile' === $device ) {

						$top    = ( isset( $value['top'] ) && cosmoswp_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && cosmoswp_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && cosmoswp_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && cosmoswp_not_empty( $value['left'] ) ) ? $value['left'] : '';

						if ( cosmoswp_not_empty( $top ) || cosmoswp_not_empty( $right ) || cosmoswp_not_empty( $bottom ) || cosmoswp_not_empty( $left ) ) {
							$top        = ( cosmoswp_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( cosmoswp_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( cosmoswp_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( cosmoswp_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						}
					}
					break;

				default:
					break;
			}
		}
		return $inline_css;
	}
}

if ( ! function_exists( 'cosmoswp_cssbox_responsive_value' ) ) {

	/**
	 * Cssbox responsive value
	 *
	 * @param  array  $position_collection Position collection.
	 * @param  string $device Device type.
	 * @param  string $direction Direction.
	 * @return string
	 */
	function cosmoswp_cssbox_responsive_value( $position_collection, $device, $direction ) {

		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' === $device ) {

						$top    = ( isset( $value['top'] ) && cosmoswp_not_empty( $value['top'] ) ) ? $value['top'] . 'px' : '';
						$right  = ( isset( $value['right'] ) && cosmoswp_not_empty( $value['right'] ) ) ? $value['right'] . 'px' : '';
						$bottom = ( isset( $value['bottom'] ) && cosmoswp_not_empty( $value['bottom'] ) ) ? $value['bottom'] . 'px' : '';
						$left   = ( isset( $value['left'] ) && cosmoswp_not_empty( $value['left'] ) ) ? $value['left'] . 'px' : '';

						if ( 'top' === $direction ) {
							return $top;
						} elseif ( 'right' === $direction ) {
							return $right;
						} elseif ( 'bottom' === $direction ) {
							return $bottom;
						} elseif ( 'left' === $direction ) {
							return $left;
						}
					}
					break;

				case 'tablet':
					if ( 'tablet' === $device ) {

						$top    = ( isset( $value['top'] ) && cosmoswp_not_empty( $value['top'] ) ) ? $value['top'] . 'px' : '';
						$right  = ( isset( $value['right'] ) && cosmoswp_not_empty( $value['right'] ) ) ? $value['right'] . 'px' : '';
						$bottom = ( isset( $value['bottom'] ) && cosmoswp_not_empty( $value['bottom'] ) ) ? $value['bottom'] . 'px' : '';
						$left   = ( isset( $value['left'] ) && cosmoswp_not_empty( $value['left'] ) ) ? $value['left'] . 'px' : '';

						if ( 'top' === $direction ) {
							return $top;
						} elseif ( 'right' === $direction ) {
							return $right;

						} elseif ( 'bottom' === $direction ) {
							return $bottom;

						} elseif ( 'left' === $direction ) {
							return $left;

						}
					}
					break;

				case 'mobile':
					if ( 'mobile' === $device ) {

						$top    = ( isset( $value['top'] ) && cosmoswp_not_empty( $value['top'] ) ) ? $value['top'] . 'px' : '';
						$right  = ( isset( $value['right'] ) && cosmoswp_not_empty( $value['right'] ) ) ? $value['right'] . 'px' : '';
						$bottom = ( isset( $value['bottom'] ) && cosmoswp_not_empty( $value['bottom'] ) ) ? $value['bottom'] . 'px' : '';
						$left   = ( isset( $value['left'] ) && cosmoswp_not_empty( $value['left'] ) ) ? $value['left'] . 'px' : '';

						if ( 'top' === $direction ) {
							return $top;
						} elseif ( 'right' === $direction ) {
							return $right;

						} elseif ( 'bottom' === $direction ) {
							return $bottom;

						} elseif ( 'left' === $direction ) {
							return $left;

						}
					}
					break;

				default:
					break;
			}
		}
	}
}

if ( ! function_exists( 'cosmoswp_boxshadow_values_inline' ) ) {

	/**
	 * Boxshadow values inline
	 *
	 * @param  array  $position_collection Position collection.
	 * @param  string $device Device type.
	 * @return string
	 */
	function cosmoswp_boxshadow_values_inline( $position_collection, $device ) {

		$inline_css = '';
		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' === $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				case 'tablet':
					if ( 'tablet' === $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				case 'mobile':
					if ( 'mobile' === $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				default:
					break;
			}
		}
		return $inline_css;
	}
}

if ( ! function_exists( 'cosmoswp_str_replace_assoc' ) ) {

	/**
	 * String replace associative array
	 *
	 * @param  array $replace Replace array.
	 * @param  array $subject Subject array.
	 * @return array
	 */
	function cosmoswp_str_replace_assoc( array $replace, $subject ) {
		return str_replace( array_keys( $replace ), array_values( $replace ), $subject );
	}
}

if ( ! function_exists( 'cosmoswp_get_icon_structure' ) ) {

	/**
	 * Get icon structure based on type and position.
	 *
	 * @since 1.0.0
	 *
	 * @param string $icon_type     Type of icon ('text', 'icon', or 'both').
	 * @param string $open_text     Text to display (if type is 'text' or 'both').
	 * @param string $open_icon     Icon class (if type is 'icon' or 'both').
	 * @param string $icon_position Position of the icon if type is 'both' ('before' or 'after').
	 *
	 * @return string HTML string of the icon structure.
	 */
	function cosmoswp_get_icon_structure( $icon_type, $open_text, $open_icon, $icon_position ) {

		$icon_content = '';
		$after_icon   = '';
		$before_icon  = '';

		if ( 'text' === $icon_type ) {
			if ( ! empty( $open_text ) ) {
				$icon_content = '<span>' . esc_html( $open_text ) . '</span>';
			}
		} elseif ( 'icon' === $icon_type ) {
			if ( ! empty( $open_icon ) ) {
				$icon_content = wp_kses_post( '<i class="' . esc_attr( cosmoswp_get_correct_fa_font( $open_icon ) ) . '"></i>' );
			}
		} elseif ( 'both' === $icon_type ) {
			$icon_html = '';
			if ( ! empty( $open_icon ) ) {
				$icon_html = '<i class="' . esc_attr( cosmoswp_get_correct_fa_font( $open_icon ) ) . '"></i>';
			}

			if ( 'after' === $icon_position ) {
				$after_icon = wp_kses_post( $icon_html );
			} else {
				$before_icon = wp_kses_post( $icon_html );
			}

			$icon_content = $before_icon . '<span>' . esc_html( $open_text ) . '</span>' . $after_icon;
		}

		return $icon_content;
	}
}

if ( ! function_exists( 'cosmoswp_get_button_structure' ) ) {

	/**
	 * Get the button structure with icon and text based on icon position.
	 *
	 * @since 1.0.0
	 *
	 * @param string $button_text   The button text.
	 * @param string $button_icon   The icon class.
	 * @param string $icon_position The position of the icon ('before' or 'after').
	 *
	 * @return string The generated HTML for the button.
	 */
	function cosmoswp_get_button_structure( $button_text, $button_icon, $icon_position ) {

		$before_icon = '';
		$after_icon  = '';

		$icon_html = ! empty( $button_icon ) ? '<i class="' . esc_attr( cosmoswp_get_correct_fa_font( $button_icon ) ) . '"></i>' : '';

		if ( ! empty( $icon_position ) ) {
			if ( 'after' === $icon_position ) {
				$after_icon = wp_kses_post( $icon_html );
			} else {
				$before_icon = wp_kses_post( $icon_html );
			}
		} else {
			$before_icon = wp_kses_post( $icon_html );
		}

		$icon_content = $before_icon . esc_html( $button_text ) . $after_icon;

		return $icon_content;
	}
}

if ( ! function_exists( 'cosmoswp_get_icon_position_class' ) ) {

	/**
	 * Get icon position class.
	 *
	 * @since 1.0.0
	 *
	 * @param string $icon_position Icon position, either 'before' or 'after'.
	 * @return string CSS class for icon position.
	 */
	function cosmoswp_get_icon_position_class( $icon_position ) {
		$icon_class = '';

		if ( ! empty( $icon_position ) ) {
			if ( 'after' === $icon_position ) {
				$icon_class = 'cwp-icon-after ';
			} else {
				$icon_class = 'cwp-icon-before ';
			}
		}

		return $icon_class;
	}
}

if ( ! function_exists( 'cosmoswp_get_icon_postion_class' ) ) {

	/**
	 * Deprecated cosmoswp_get_icon_postion_class (Deprecated)
	 *
	 * @deprecated 1.0.0 Use cosmoswp_get_icon_position_class() instead.
	 *
	 * @param string $icon_position Icon position, either 'before' or 'after'.
	 * @return string CSS class for icon position.
	 */
	function cosmoswp_get_icon_postion_class( $icon_position ) {
		_deprecated_function( __FUNCTION__, '1.0.0', 'cosmoswp_get_icon_position_class' );
		return cosmoswp_get_icon_position_class( $icon_position );
	}
}

if ( ! function_exists( 'cosmoswp_get_icon_four_position_class' ) ) {

	/**
	 * Get icon position class for four possible positions (before, after, top, bottom).
	 *
	 * @since 1.0.0
	 *
	 * @param string $icon_position The position of the icon ('before', 'after', 'top', 'bottom').
	 * @return string CSS class for the icon position.
	 */
	function cosmoswp_get_icon_four_position_class( $icon_position ) {
		$icon_class = '';

		if ( ! empty( $icon_position ) ) {
			if ( 'after' === $icon_position ) {
				$icon_class = 'cwp-icon-after ';
			} elseif ( 'before' === $icon_position ) {
				$icon_class = 'cwp-icon-before ';
			} elseif ( 'top' === $icon_position ) {
				$icon_class = 'cwp-icon-top ';
			} elseif ( 'bottom' === $icon_position ) {
				$icon_class = 'cwp-icon-bottom ';
			}
		}

		return $icon_class;
	}
}

if ( ! function_exists( 'cosmoswp_ifset' ) ) {

	/**
	 * Safely get a variable if it is set.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $input The variable to check.
	 * @return mixed The value of the variable if set, otherwise an empty string.
	 */
	function cosmoswp_ifset( &$input ) {
		if ( isset( $input ) ) {
			return $input;
		}
		return '';
	}
}

if ( ! function_exists( 'cosmoswp_contents_collection' ) ) {

	/**
	 * Output the content collection based on the given elements and layout settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $element_collection   The collection of elements to display.
	 * @param int    $excerpt_length      The length of the excerpt to display (0 for full).
	 * @param array  $primary_elements    The elements for the primary meta section.
	 * @param array  $secondary_elements  The elements for the secondary meta section.
	 * @param string $thumbnail_layout    The layout of the thumbnail (e.g., 'hide-image').
	 * @param string $thumbnail_size      The size of the thumbnail to display.
	 */
	function cosmoswp_contents_collection( $element_collection, $excerpt_length, $primary_elements, $secondary_elements, $thumbnail_layout, $thumbnail_size ) {
		// Ensure the collection is valid.
		if ( ! is_array( $element_collection ) || empty( $element_collection ) ) {
			return;
		}

		foreach ( $element_collection as $element ) {
			if ( 'title' === $element ) { ?>
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
				</header><!-- .entry-header -->
				<?php
			} elseif ( 'primary-meta' === $element ) {
				if ( is_array( $primary_elements ) && ! empty( $primary_elements ) ) {
					?>
					<div class="primary-meta entry-meta">
						<?php
						cosmoswp_meta_collection( $primary_elements );
						?>
					</div><!-- .entry-meta -->
					<?php
				}
			} elseif ( 'featured-section' === $element ) {
				if ( has_post_thumbnail() && 'hide-image' !== $thumbnail_layout ) {
					cosmoswp_post_thumbnail( $thumbnail_size );
				}
			} elseif ( 'content' === $element ) {
				?>
				<div class="entry-content clearfix">
					<?php
					the_content();
					?>
				</div><!-- .entry-content -->
				<?php
			} elseif ( 'excerpt' === $element && 0 !== (int) $excerpt_length ) {
				?>
				<div class="entry-content clearfix">
					<?php
					if ( $excerpt_length ) {
						echo wp_kses_post( wp_trim_words( strip_shortcodes( get_the_excerpt() ), $excerpt_length ) );
					} else {
						the_excerpt();
					}
					?>
				</div><!-- .entry-content -->
				<?php
			} elseif ( 'secondary-meta' === $element ) {
				if ( is_array( $secondary_elements ) && ! empty( $secondary_elements ) ) {
					?>
					<div class="secondary-meta entry-meta">
						<?php
						cosmoswp_meta_collection( $secondary_elements );
						?>
					</div><!-- .entry-meta -->
					<?php
				}
			}
		}
	}
}

if ( ! function_exists( 'cosmoswp_not_empty' ) ) {

	/**
	 * Check if a variable is not empty (excluding whitespace).
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $input The variable to check.
	 * @return bool True if the variable is not empty, false otherwise.
	 */
	function cosmoswp_not_empty( $input ) {
		// Check if the trimmed variable is empty.
		if ( is_string( $input ) && '' === trim( $input ) ) {
			return false;
		}
		return true;
	}
}

if ( ! function_exists( 'cosmoswp_cssbox_not_empty' ) ) {

	/**
	 * Check if a value is not empty or zero and return it with 'px' suffix.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $input The value to check and append 'px' if not empty or zero.
	 * @return string The value with 'px' suffix or an empty string if the value is empty.
	 */
	function cosmoswp_cssbox_not_empty( $input ) {
		// Check if the value is zero or not empty.
		if ( 0 === absint( $input ) || ! empty( $input ) ) {
			return $input . 'px';
		}
		return '';
	}
}

/* callback functions of banner video */
add_filter( 'is_header_video_active', 'cosmoswp_custom_video_header_pages' );

if ( ! function_exists( 'cosmoswp_banner_title' ) ) {

	/**
	 * Get the title for the banner section based on the current view.
	 *
	 * This function checks the context (home, singular, archive, search) and returns
	 * the appropriate banner title based on theme options or the current page title.
	 *
	 * @since 1.0.0
	 *
	 * @return string|false The banner title, or false if the title is disabled for singular pages.
	 */
	function cosmoswp_banner_title() {
		$banner_title = '';

		// Check if it's the home page.
		if ( is_home() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$banner_title   = get_the_title( $page_for_posts );

			// Check if it's a singular post or page.
		} elseif ( is_singular() ) {
			$single_title_options = cosmoswp_get_theme_options( 'single-banner-section-title' );

			// Return false if the title is disabled in options.
			if ( 'disable' === $single_title_options ) {
				return false;
			}

			// Custom title if option is set.
			if ( 'custom-title' === $single_title_options ) {
				$banner_title = esc_html( cosmoswp_get_theme_options( 'single-custom-banner-title' ) );
			} else {
				$banner_title = get_the_title();
			}

			// Check if it's an archive page.
		} elseif ( is_archive() ) {
			$banner_title = get_the_archive_title();

			// Check if it's a search page.
		} elseif ( is_search() ) {
			$banner_title = '' . __( 'Search Results for:', 'cosmoswp' ) . '<span>' . get_search_query() . '</span>';

		} else {
			$banner_title = get_the_title();
		}

		return $banner_title;
	}
}

if ( ! function_exists( 'cosmoswp_get_non_empty_categories' ) ) :

	/**
	 * Retrieve a list of non-empty categories.
	 *
	 * This function gets all categories that contain posts and returns them as an associative array
	 * with the category ID as the key and the category name as the value. If no categories are found,
	 * it returns an array with a default "No Category" entry.
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return array The list of non-empty categories, or a default message if none are found.
	 */
	function cosmoswp_get_non_empty_categories() {
		$categories_list = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		);

		$cat_list = array();

		// Check if categories were found.
		if ( ! empty( $categories_list ) && ! is_wp_error( $categories_list ) ) {
			foreach ( $categories_list as $key ) {
				$cat_list[ $key->term_id ] = esc_html( ucwords( $key->name ) );
			}
		} else {
			// If no categories are found, provide a default category.
			$cat_list[0] = esc_html__( 'No Category', 'cosmoswp' );
		}

		// Apply a filter before returning the categories.
		return apply_filters( 'cosmoswp_get_non_empty_categories', $cat_list );
	}

endif;

/**
 *  Display video in mobile
 */
add_filter(
	'header_video_settings',
	function ( $args ) {
		$args['minWidth'] = 0;
		return $args;
	}
);

if ( ! function_exists( 'cosmoswp_get_grid_class' ) ) :

	/**
	 * Get the appropriate grid class based on the column count.
	 *
	 * This function returns the corresponding grid class based on the number of columns passed to it.
	 * It maps column numbers to grid classes for responsive design.
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @param int $col The number of columns.
	 * @return string The grid class for the specified number of columns.
	 */
	function cosmoswp_get_grid_class( $col ) {

		// Return empty if no column value is provided.
		if ( empty( $col ) ) {
			return '';
		}
		$col = absint( $col );
		// Determine the grid class based on the column number.
		if ( 1 === $col ) {
			$grid = 'grid-md-12';
		} elseif ( 2 === $col ) {
			$grid = 'grid-md-6';
		} elseif ( 3 === $col ) {
			$grid = 'grid-md-4';
		} elseif ( 4 === $col ) {
			$grid = 'grid-md-3';
		} elseif ( 5 === $col ) {
			$grid = 'grid-md-2m3';
		} elseif ( 6 === $col ) {
			$grid = 'grid-md-2';
		} else {
			$grid = 'grid-md-3';
		}

		return $grid;
	}

endif;

if ( ! function_exists( 'cosmoswp_get_l_grid_class' ) ) :

	/**
	 * Get the appropriate large grid class based on the column count.
	 *
	 * This function returns the corresponding large grid class based on the number of columns passed to it.
	 * It maps column numbers to large grid classes for responsive design.
	 *
	 * @since cosmoswp 1.1.5
	 *
	 * @param int $col The number of columns.
	 * @return string|boolean The grid class for the specified number of columns, or an empty string if no columns are provided.
	 */
	function cosmoswp_get_l_grid_class( $col ) {

		// Return empty if no column value is provided.
		if ( empty( $col ) ) {
			return '';
		}
		$col = absint( $col );

		// Determine the large grid class based on the column number.
		if ( 1 === $col ) {
			$grid = 'grid-lg-12';
		} elseif ( 2 === $col ) {
			$grid = 'grid-lg-6';
		} elseif ( 3 === $col ) {
			$grid = 'grid-lg-4';
		} elseif ( 4 === $col ) {
			$grid = 'grid-lg-3';
		} elseif ( 5 === $col ) {
			$grid = 'grid-lg-2m3';
		} elseif ( 6 === $col ) {
			$grid = 'grid-lg-2';
		} else {
			$grid = 'grid-lg-3';
		}

		return $grid;
	}

endif;

if ( ! function_exists( 'cosmoswp_get_s_grid_class' ) ) :

	/**
	 * Get the appropriate small grid class based on the column count.
	 *
	 * This function returns the corresponding small grid class based on the number of columns passed to it.
	 * It maps column numbers to small grid classes for responsive design.
	 *
	 * @since cosmoswp 1.1.5
	 *
	 * @param int $col The number of columns.
	 * @return string|boolean The grid class for the specified number of columns, or an empty string if no columns are provided.
	 */
	function cosmoswp_get_s_grid_class( $col ) {

		// Return empty if no column value is provided.
		if ( empty( $col ) ) {
			return '';
		}

		$col = absint( $col );

		// Determine the small grid class based on the column number.
		if ( 1 === $col ) {
			$grid = 'grid-12';
		} elseif ( 2 === $col ) {
			$grid = 'grid-6';
		} elseif ( 3 === $col ) {
			$grid = 'grid-4';
		} elseif ( 4 === $col ) {
			$grid = 'grid-3';
		} elseif ( 5 === $col ) {
			$grid = 'grid-2m3';
		} elseif ( 6 === $col ) {
			$grid = 'grid-2';
		} else {
			$grid = 'grid-3';
		}

		return $grid;
	}

endif;


if ( ! function_exists( 'cosmoswp_is_edit_page' ) ) {
	/**
	 * Check if the current page is an edit page in the WordPress backend.
	 *
	 * This function checks if the user is on the backend of WordPress and whether
	 * they are editing an existing post or creating a new post.
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return bool True if on the post edit page or post create page, false otherwise.
	 */
	function cosmoswp_is_edit_page() {
		// Ensure we're in the WordPress admin area.
		if ( ! is_admin() ) {
			return false;
		}

		global $pagenow;

		// Check if the current page is either the post edit or post creation page.
		return in_array( $pagenow, array( 'post.php', 'post-new.php' ), true );
	}
}

if ( ! function_exists( 'cosmoswp_is_scrollbar_js' ) ) :

	/**
	 * Check if the scrollbar JS is needed based on footer display style.
	 *
	 * This function checks whether the footer display style requires the scrollbar JS.
	 * If the footer display style is not set to 'cwp-normal-footer', it returns true,
	 * indicating that the scrollbar JS is required.
	 *
	 * @since cosmoswp 1.1.0
	 *
	 * @return bool True if the scrollbar JS is needed, false otherwise.
	 */
	function cosmoswp_is_scrollbar_js() {
		$footer_display_style = cosmoswp_get_theme_options( 'footer-display-style' );
		$is_enable            = false;

		// Check if the footer display style is not 'cwp-normal-footer'.
		if ( ! empty( $footer_display_style ) && ( 'cwp-normal-footer' !== $footer_display_style ) ) {
			$is_enable = true;
		}

		// Allow filtering the result via a WordPress filter hook.
		return apply_filters( 'cosmoswp_is_scrollbar_js', $is_enable );
	}

endif;
