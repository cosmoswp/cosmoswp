<?php
/**
 * Template functions.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Don't confuse prefix does not needed for this*/
if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since CosmosWP 1.0.6
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since CosmosWP 1.0.6
		 */
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'cosmoswp_get_template_part' ) ) {

	/**
	 * Retrieve and load a template part.
	 *
	 * This function attempts to locate a template part file by checking the provided
	 * slug and optional name. It allows 3rd party plugins to filter the template.
	 *
	 * @param string      $id      The ID of the template part.
	 * @param string      $slug    The base name of the template.
	 * @param string|null $name The optional name of the template part.
	 * @return void
	 */
	function cosmoswp_get_template_part( $id, $slug, $name = null ) {

		$templates = array();

		// If the name is not empty, add the template part with the name.
		if ( ! empty( $name ) ) {
			$templates[] = "{$slug}-{$name}.php";
		}

		// Always add the default template file to the array.
		$templates[] = "{$slug}.php";

		$template = locate_template( $templates );

		// Allow 3rd party plugins to filter the template file from their plugin.
		$template = apply_filters( 'cosmoswp_get_template_part', $template, $id, $slug, $name );

		// If a template is found, load it.
		if ( $template ) {
			load_template( $template, false );
		}
	}
}

if ( ! function_exists( 'cosmoswp_get_schema_markup' ) ) {

	/**
	 * Get the appropriate schema markup based on location.
	 *
	 * This function returns the schema markup for different areas of the page,
	 * such as the header, footer, sidebar, etc. The markup is returned as
	 * a string to be used within HTML elements.
	 *
	 * @param string $location The location to get the schema for.
	 *                         Accepted values include 'html', 'header', 'logo',
	 *                         'site_navigation', 'main', 'breadcrumb', 'sidebar',
	 *                         'footer', 'headline', 'entry_content', 'publish_date',
	 *                         'author_name', 'author_link', 'item', 'url', 'position',
	 *                         'image'.
	 *
	 * @return string The schema markup to be used in the HTML element.
	 */
	function cosmoswp_get_schema_markup( $location ) {

		// Default schema variables.
		$schema   = '';
		$itemprop = '';
		$itemtype = '';

		// Check for HTML schema markup.
		if ( 'html' === $location ) {
			// If the page is singular, use WebPage schema. Otherwise, use Article schema.
			if ( is_singular() ) {
				$schema = 'itemscope itemtype="http://schema.org/WebPage"';
			} else {
				$schema = 'itemscope itemtype="http://schema.org/Article"';
			}
		} elseif ( 'header' === $location ) {// Check for Header schema.
			$schema = 'itemscope="itemscope" itemtype="http://schema.org/WPHeader"';
		} elseif ( 'logo' === $location ) {// Check for Logo schema.
			$schema = 'itemscope itemtype="http://schema.org/Brand"';
		} elseif ( 'site_navigation' === $location ) {// Check for Site Navigation schema.
			$schema = 'itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"';
		} elseif ( 'main' === $location ) {// Check for Main Content schema.
			$itemtype = 'http://schema.org/WebPageElement';
			$itemprop = 'mainContentOfPage';
			if ( is_singular( 'post' ) ) {
				$itemprop = '';
				$itemtype = 'http://schema.org/Blog';
			}
		} elseif ( 'breadcrumb' === $location ) {// Check for Breadcrumb schema.
			$schema = 'itemscope itemtype="http://schema.org/BreadcrumbList"';
		} elseif ( 'breadcrumb_list' === $location ) {// Check for Breadcrumb list schema.
			$schema = 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"';
		} elseif ( 'breadcrumb_itemprop' === $location ) {// Check for Breadcrumb itemprop schema.
			$schema = 'itemprop="breadcrumb"';
		} elseif ( 'sidebar' === $location ) {// Check for Sidebar schema.
			$schema = 'itemscope="itemscope" itemtype="http://schema.org/WPSideBar"';
		} elseif ( 'footer' === $location ) {// Check for Footer schema.
			$schema = 'itemscope="itemscope" itemtype="http://schema.org/WPFooter"';
		} elseif ( 'headline' === $location ) {// Check for Headline schema.
			$schema = 'itemprop="headline"';
		} elseif ( 'entry_content' === $location ) {// Check for Post content schema.
			$schema = 'itemprop="text"';
		} elseif ( 'publish_date' === $location ) {// Check for Publish date schema.
			$schema = 'itemprop="datePublished"';
		} elseif ( 'author_name' === $location ) {// Check for Author name schema.
			$schema = 'itemprop="name"';
		} elseif ( 'author_link' === $location ) {// Check for Author link schema.
			$schema = 'itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"';
		} elseif ( 'item' === $location ) {// Check for Item schema.
			$schema = 'itemprop="item"';
		} elseif ( 'url' === $location ) {// Check for URL schema.
			$schema = 'itemprop="url"';
		} elseif ( 'position' === $location ) {// Check for Position schema.
			$schema = 'itemprop="position"';
		} elseif ( 'image' === $location ) { // Check for Image schema.
			$schema = 'itemprop="image"';
		}

		// Return the final schema markup with any applied filters.
		return ' ' . apply_filters( 'cosmoswp_schema_markup', $schema, $location );
	}
}

if ( ! function_exists( 'cosmoswp_schema_markup' ) ) {

	/**
	 * Output the schema markup based on location.
	 *
	 * This function retrieves the schema markup using the `cosmoswp_get_schema_markup`
	 * function and echoes it to be used in the HTML structure.
	 *
	 * @param string $location The location for which the schema markup is needed.
	 *                         Accepted values include 'html', 'header', 'logo',
	 *                         'site_navigation', 'main', 'breadcrumb', 'sidebar',
	 *                         'footer', 'headline', 'entry_content', 'publish_date',
	 *                         'author_name', 'author_link', 'item', 'url', 'position',
	 *                         'image'.
	 */
	function cosmoswp_schema_markup( $location ) {

		// Echo the schema markup based on the location.
		echo wp_kses_post( cosmoswp_get_schema_markup( $location ) );
	}
}

if ( ! function_exists( 'cosmoswp_html_class' ) ) :

	/**
	 * Outputs HTML class attribute with a custom set of classes.
	 *
	 * This function adds custom classes to the body or HTML element by processing
	 * the passed `$input_class` argument, sanitizing the values, and applying any filters.
	 * It ensures that the classes are properly formatted and escapes any attributes.
	 *
	 * @param string|array $input_class One or more class names to add. Can be a space-separated string or an array of class names.
	 *
	 * @return void
	 */
	function cosmoswp_html_class( $input_class = '' ) {

		$classes = array();

		// If the class is not empty.
		if ( ! empty( $input_class ) ) {
			// If it's not already an array, convert the string into an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the new classes with the existing classes array.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any filters to the classes.
		$classes = apply_filters( 'cosmoswp_html_class', $classes, $input_class );

		// Remove duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize the classes to escape any unsafe attributes.
		$classes = array_map( 'esc_attr', $classes );

		// Join the classes with a single space and prepend the default 'no-js no-svg' classes.
		$classes = join( ' ', $classes );

		// Output the class attribute.
		echo 'class="no-js no-svg ' . esc_attr( $classes ) . '"';
	}
endif;


if ( ! function_exists( 'cosmoswp_get_main_wrap_classes' ) ) :

	/**
	 * Retrieves and sanitizes the main wrapper classes.
	 *
	 * This function processes the provided class names, ensuring they are
	 * properly sanitized and merged with any additional classes via filters.
	 * It returns a string of unique, sanitized class names separated by a space.
	 *
	 * @param string|array $input_class A space-separated string or an array of class names to add.
	 *
	 * @return string The sanitized class attribute for use in HTML.
	 */
	function cosmoswp_get_main_wrap_classes( $input_class = '' ) {

		$classes = array();

		// If class is provided and not empty.
		if ( ! empty( $input_class ) ) {
			// If it's not already an array, convert the string into an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the new classes with the existing classes array.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any filters to the classes.
		$classes = apply_filters( 'cosmoswp_main_wrap_classes', $classes, $input_class );

		// Remove duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize the classes to escape any unsafe attributes.
		$classes = array_map( 'esc_attr', $classes );

		// Join the classes with a single space and return.
		$classes = join( ' ', $classes );

		// Return the final class string.
		return $classes;
	}
endif;

if ( ! function_exists( 'cosmoswp_main_wrap_classes' ) ) :

	/**
	 * Outputs the main wrapper classes in a class attribute.
	 *
	 * This function generates a class attribute by calling the
	 * `cosmoswp_get_main_wrap_classes` function to retrieve the classes,
	 * and then echoes the final result wrapped in a `class` attribute.
	 *
	 * @param string $input_class A space-separated string or an array of class names to add.
	 *
	 * @return void
	 */
	function cosmoswp_main_wrap_classes( $input_class = '' ) {

		// Output the class attribute with the processed classes.
		echo 'class="' . esc_attr( cosmoswp_get_main_wrap_classes( $input_class ) ) . '"';
	}
endif;

if ( ! function_exists( 'cosmoswp_get_vertical_header_main_wrap_classes' ) ) :

	/**
	 * Gets the classes for the vertical header main wrapper.
	 *
	 * This function processes the provided class names, ensuring they are sanitized
	 * and returned as a space-separated string for use in the main wrap of the vertical header.
	 *
	 * @param string $input_class A string or array of classes to be added.
	 * @return string A space-separated string of sanitized class names.
	 */
	function cosmoswp_get_vertical_header_main_wrap_classes( $input_class = '' ) {

		$classes = array();

		if ( ! empty( $input_class ) ) {
			if ( ! is_array( $input_class ) ) {
				// Convert string to an array of classes.
				$input_class = preg_split( '#\s+#', $input_class );
			}
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply filters for additional classes from third-party plugins or themes.
		$classes = apply_filters( 'cosmoswp_vertical_header_main_wrap_classes', $classes, $input_class );

		// Remove duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize each class attribute for security.
		$classes = array_map( 'esc_attr', $classes );

		// Join classes with a single space and return the final class string.
		$classes = join( ' ', $classes );

		return 'cwp-offcanvas-body-wrapper ' . $classes;
	}
endif;

if ( ! function_exists( 'cosmoswp_vertical_header_main_wrap_classes' ) ) :

	/**
	 * Outputs the classes for the vertical header main wrapper.
	 *
	 * This function generates the final class string by processing the provided class names,
	 * sanitizing them, and echoing the result for use in the vertical header main wrapper.
	 *
	 * @param string $input_class A string or array of classes to be added.
	 * @return void
	 */
	function cosmoswp_vertical_header_main_wrap_classes( $input_class = '' ) {

		// Echo the 'class' attribute with sanitized class names.
		echo 'class="' . esc_attr( cosmoswp_get_vertical_header_main_wrap_classes( $input_class ) ) . '"';
	}
endif;

if ( ! function_exists( 'cosmoswp_main_classes' ) ) :

	/**
	 * Outputs the classes for the main wrapper.
	 *
	 * This function processes the provided class names, sanitizes them, and outputs the
	 * final class string for use in the main wrapper of the body element.
	 *
	 * @param string $input_class A string or array of classes to be added.
	 * @return void
	 */
	function cosmoswp_main_classes( $input_class = '' ) {

		$classes = array();

		// Check if the input class is not empty.
		if ( ! empty( $input_class ) ) {
			// If it's not an array, convert it to an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any custom filters to the classes.
		$classes = apply_filters( 'cosmoswp_main_classes', $classes, $input_class );

		// Remove any duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize class names.
		$classes = array_map( 'esc_attr', $classes );

		// Combine classes with a single space.
		$classes = join( ' ', $classes );

		// Echo the final class string.
		echo 'class="cwp-body-main-wrap ' . esc_attr( $classes ) . '"';
	}
endif;

if ( ! function_exists( 'cosmoswp_get_header_wrap_classes' ) ) :

	/**
	 * Gets the classes for the header wrapper.
	 *
	 * This function processes the provided class names, sanitizes them, and returns the
	 * final class string to be used in the header wrapper element.
	 *
	 * @param string $input_class A string or array of classes to be added.
	 * @return string The final class string for the header wrapper.
	 */
	function cosmoswp_get_header_wrap_classes( $input_class = '' ) {

		$classes = array();

		// Check if the input class is not empty.
		if ( ! empty( $input_class ) ) {
			// If it's not an array, convert it to an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any custom filters to the classes.
		$classes = apply_filters( 'cosmoswp_header_wrap_classes', $classes, $input_class );

		// Remove any duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize class names.
		$classes = array_map( 'esc_attr', $classes );

		// Combine classes with a single space.
		$classes = join( ' ', $classes );

		// Return the final class string.
		return 'cwp-dynamic-header ' . $classes;
	}
endif;

if ( ! function_exists( 'cosmoswp_header_wrap_classes' ) ) :

	/**
	 * Outputs the class attribute for the header wrapper.
	 *
	 * This function echoes the final class string for the header wrapper element,
	 * using the processed and sanitized classes from the cosmoswp_get_header_wrap_classes function.
	 *
	 * @param string $input_class A string or array of classes to be added.
	 * @return void
	 */
	function cosmoswp_header_wrap_classes( $input_class = '' ) {

		// Output the class attribute with the generated class string.
		echo 'class="' . esc_attr( cosmoswp_get_header_wrap_classes( $input_class ) ) . '"';
	}
endif;

if ( ! function_exists( 'cosmoswp_blog_grid_classes' ) ) :

	/**
	 * Outputs the class attribute for the blog grid element.
	 *
	 * This function generates the class string for the blog grid element, combining the
	 * input classes with the default 'cwp-blog-grid' class. The input classes are sanitized
	 * and filtered before being output.
	 *
	 * @param string $input_class A string or array of classes to be added to the blog grid.
	 * @return void
	 */
	function cosmoswp_blog_grid_classes( $input_class = '' ) {

		$classes = array();

		// If input class is not empty, process it.
		if ( ! empty( $input_class ) ) {
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any filters for blog grid classes.
		$classes = apply_filters( 'cosmoswp_blog_grid_classes', $classes, $input_class );
		$classes = array_unique( $classes );

		// Sanitize each class.
		$classes = array_map( 'esc_attr', $classes );

		// Collates and separates classes with a single space.
		$classes = join( ' ', $classes );

		// Output the final class attribute.
		echo 'class="cwp-blog-grid ' . esc_attr( $classes ) . '"';
	}
endif;

if ( ! function_exists( 'cosmoswp_blog_main_wrap_classes' ) ) :

	/**
	 * Returns the blog main wrap classes.
	 *
	 * This function generates and sanitizes the class string for the blog main wrap element,
	 * combining the input classes with the default 'cwp-blog-main-wrap' class.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input_class A string or array of additional classes to be added.
	 * @return void
	 */
	function cosmoswp_blog_main_wrap_classes( $input_class = '' ) {

		$classes = array();

		// If input class is not empty, process it.
		if ( ! empty( $input_class ) ) {
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any filters for blog main wrap classes.
		$classes = apply_filters( 'cosmoswp_blog_main_wrap_classes', $classes, $input_class );
		$classes = array_unique( $classes );

		// Sanitize each class.
		$classes = array_map( 'esc_attr', $classes );

		// Collates and separates classes with a single space.
		$classes = join( ' ', $classes );

		// Output the final class attribute.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_post_main_wrap_classes' ) ) :

	/**
	 * Returns the post main wrap classes.
	 *
	 * This function generates and sanitizes the class string for the post main wrap element,
	 * combining the input classes with the default 'cwp-post-main-wrap' class.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string $input_class A string or array of additional classes to be added.
	 * @return void
	 */
	function cosmoswp_post_main_wrap_classes( $input_class = '' ) {

		$classes = array();

		// If input class is not empty, process it.
		if ( ! empty( $input_class ) ) {
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array.
			$input_class = array();
		}

		// Apply any filters for post main wrap classes.
		$classes = apply_filters( 'cosmoswp_post_main_wrap_classes', $classes, $input_class );
		$classes = array_unique( $classes );

		// Sanitize each class.
		$classes = array_map( 'esc_attr', $classes );

		// Collates and separates classes with a single space.
		$classes = join( ' ', $classes );

		// Output the final class attribute.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_is_active_header' ) ) :

	/**
	 * Checks if the header is active.
	 *
	 * This function returns true, indicating that the header is active.
	 *
	 * @return bool True if the header is active, otherwise false.
	 */
	function cosmoswp_is_active_header() {
		// Always returns true indicating the header is active.
		return true;
	}
endif;

if ( ! function_exists( 'cosmoswp_post_thumbnail' ) ) :

	/**
	 * Displays the post thumbnail.
	 *
	 * This function checks if the post has a password, is an attachment, or does not have a thumbnail.
	 * If the post is singular, it will display the thumbnail, otherwise, it wraps the thumbnail in a link.
	 *
	 * @param string $size The size of the thumbnail to display.
	 * @return void
	 */
	function cosmoswp_post_thumbnail( $size ) {
		// Check if the post requires a password, is an attachment, or has no post thumbnail.
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return; // Exit early if any condition is true.
		}

		// Check if the post is singular.
		if ( is_singular() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>
			</div><!-- .post-thumbnail -->
		<?php else : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" aria-hidden="true">
					<?php
					// Display the post thumbnail with alt text.
					the_post_thumbnail(
						$size,
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
					?>
				</a>
			</div>
			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'cosmoswp_header_top_classes' ) ) :

	/**
	 * Return the header top classes.
	 *
	 * This function checks if any input classes are provided, sanitizes and applies filters,
	 * and returns the final classes for the header top element.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class The class(es) to be applied.
	 * @return void
	 */
	function cosmoswp_header_top_classes( $input_class = '' ) {

		$classes = array();

		// Check if the input class is not empty.
		if ( ! empty( $input_class ) ) {
			// Ensure that the input class is an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input class with the existing classes.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce the class to be an array.
			$input_class = array();
		}

		// Apply filters for the header top classes.
		$classes = apply_filters( 'cosmoswp_header_top_classes', $classes, $input_class );
		// Remove duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize each class.
		$classes = array_map( 'esc_attr', $classes );

		// Separate classes with a single space and join them.
		$classes = join( ' ', $classes );

		// Echo the final classes.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_header_main_classes' ) ) :

	/**
	 * Return the header main classes.
	 *
	 * This function checks if any input classes are provided, sanitizes and applies filters,
	 * and returns the final classes for the header main element.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class The class(es) to be applied.
	 * @return void
	 */
	function cosmoswp_header_main_classes( $input_class = '' ) {

		$classes = array();

		// Check if the input class is not empty.
		if ( ! empty( $input_class ) ) {
			// Ensure that the input class is an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input class with the existing classes.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce the class to be an array.
			$input_class = array();
		}

		// Apply filters for the header main classes.
		$classes = apply_filters( 'cosmoswp_header_main_classes', $classes, $input_class );
		// Remove duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize each class.
		$classes = array_map( 'esc_attr', $classes );

		// Separate classes with a single space and join them.
		$classes = join( ' ', $classes );

		// Echo the final classes.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_header_bottom_classes' ) ) :

	/**
	 * Return the header bottom classes.
	 *
	 * This function checks if any input classes are provided, sanitizes and applies filters,
	 * and returns the final classes for the header bottom element.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class The class(es) to be applied.
	 * @return void
	 */
	function cosmoswp_header_bottom_classes( $input_class = '' ) {

		$classes = array();

		// Check if the input class is not empty.
		if ( ! empty( $input_class ) ) {
			// Ensure that the input class is an array.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input class with the existing classes.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce the class to be an array.
			$input_class = array();
		}

		// Apply filters for the header bottom classes.
		$classes = apply_filters( 'cosmoswp_header_bottom_classes', $classes, $input_class );
		// Remove duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize each class.
		$classes = array_map( 'esc_attr', $classes );

		// Separate classes with a single space and join them.
		$classes = join( ' ', $classes );

		// Echo the final classes.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_main_wrap_scroll_data' ) ) :

	/**
	 * Return scroll data for sticky header.
	 *
	 * This function returns data attributes for the scroll behavior, sticky header options,
	 * and sticky header color configuration based on the theme options.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @return void
	 */
	function cosmoswp_main_wrap_scroll_data() {

		$sticky_header_options = cosmoswp_get_theme_options( 'sticky-header-options' );
		$scrolltype_data       = '';
		$sticky_color_data     = 'disable';

		// Check the sticky header option and set the scroll type accordingly.
		if ( 'scroll-down' === $sticky_header_options ) {
			$scrolltype_data = 'cwp-scroll-down-sticky';
		} elseif ( 'scroll-up' === $sticky_header_options ) {
			$scrolltype_data = 'cwp-scroll-up-sticky';
		} elseif ( 'normal' === $sticky_header_options ) {
			$scrolltype_data = 'normal';
		}

		// Check if sticky header is enabled, and if sticky color options are enabled.
		if ( 'disable' !== $sticky_header_options ) {
			$sticky_header_color_options = cosmoswp_get_theme_options( 'enable-sticky-header-color-options' );
			if ( $sticky_header_color_options ) {
				$sticky_color_data = 'enable';
			}
		}

		// Get header position and sticky header trigger height options.
		$header_position_options = cosmoswp_get_theme_options( 'header-position-options' );
		$sticky_header_height    = cosmoswp_get_theme_options( 'sticky-header-trigger-height' );

		// Ensure that the header position is not vertical or overlay transparent.
		if ( ! empty( $header_position_options ) && ( 'cwp-vertical-header' !== $header_position_options ) && ( 'cwp-overlay-transparent' !== $header_position_options ) ) {
			// If a scroll type is set, output the data attributes for scroll behavior.
			if ( ! empty( $scrolltype_data ) ) {
				echo 'data-scrolltype="' . esc_attr( $scrolltype_data ) . '" data-height-trigger-sticky="' . esc_attr( $sticky_header_height ) . '" data-sticky-color="' . esc_attr( $sticky_color_data ) . '"';
			}
		}
	}
endif;

if ( ! function_exists( 'cosmoswp_is_active_footer' ) ) :

	/**
	 * Check if the footer is active.
	 *
	 * This function checks whether the footer is active or not.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @return bool True if active, false otherwise.
	 */
	function cosmoswp_is_active_footer() {
		// Return true if the footer is active.
		return true;
	}
endif;

if ( ! function_exists( 'cosmoswp_footer_wrap_classes' ) ) :

	/**
	 * Return the Footer Wrap classes.
	 *
	 * This function returns the classes for the footer wrap, ensuring any input classes are sanitized
	 * and processed before output.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class Optional. Additional classes to add. Default is an empty string.
	 * @return void Outputs the footer wrap classes.
	 */
	function cosmoswp_footer_wrap_classes( $input_class = '' ) {

		// Initialize an empty array for the classes.
		$classes = array();

		// If input classes are not empty.
		if ( ! empty( $input_class ) ) {
			// If input classes are not already an array, split them into one.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input classes into the $classes array.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array when no input is provided.
			$input_class = array();
		}

		// Apply any filters for the footer wrap classes.
		$classes = apply_filters( 'cosmoswp_footer_wrap_classes', $classes, $input_class );

		// Remove any duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize the classes to ensure they are safe for HTML output.
		$classes = array_map( 'esc_attr', $classes );

		// Combine all classes into a single string separated by spaces.
		$classes = join( ' ', $classes );

		// Echo the sanitized class attribute.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_footer_top_wrap_classes' ) ) :

	/**
	 * Return the Footer Top Wrap classes.
	 *
	 * This function returns the classes for the footer top wrap, ensuring any input classes are sanitized
	 * and processed before output.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class Optional. Additional classes to add. Default is an empty string.
	 * @return void Outputs the footer top wrap classes.
	 */
	function cosmoswp_footer_top_wrap_classes( $input_class = '' ) {

		// Initialize an empty array for the classes.
		$classes = array();

		// If input classes are not empty.
		if ( ! empty( $input_class ) ) {
			// If input classes are not already an array, split them into one.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input classes into the $classes array.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array when no input is provided.
			$input_class = array();
		}

		// Apply any filters for the footer top wrap classes.
		$classes = apply_filters( 'cosmoswp_footer_top_wrap_classes', $classes, $input_class );

		// Remove any duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize the classes to ensure they are safe for HTML output.
		$classes = array_map( 'esc_attr', $classes );

		// Combine all classes into a single string separated by spaces.
		$classes = join( ' ', $classes );

		// Echo the sanitized class attribute.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_footer_main_wrap_classes' ) ) :

	/**
	 * Return the Footer Main Wrap classes.
	 *
	 * This function returns the classes for the footer main wrap, ensuring any input classes are sanitized
	 * and processed before output.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class Optional. Additional classes to add. Default is an empty string.
	 * @return void Outputs the footer main wrap classes.
	 */
	function cosmoswp_footer_main_wrap_classes( $input_class = '' ) {

		// Initialize an empty array for the classes.
		$classes = array();

		// If input classes are not empty.
		if ( ! empty( $input_class ) ) {
			// If input classes are not already an array, split them into one.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input classes into the $classes array.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array when no input is provided.
			$input_class = array();
		}

		// Apply any filters for the footer main wrap classes.
		$classes = apply_filters( 'cosmoswp_footer_main_wrap_classes', $classes, $input_class );

		// Remove any duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize the classes to ensure they are safe for HTML output.
		$classes = array_map( 'esc_attr', $classes );

		// Combine all classes into a single string separated by spaces.
		$classes = join( ' ', $classes );

		// Echo the sanitized class attribute.
		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'cosmoswp_footer_bottom_wrap_classes' ) ) :

	/**
	 * Return the Footer Bottom Wrap classes.
	 *
	 * This function returns the classes for the footer bottom wrap, ensuring any input classes are sanitized
	 * and processed before output.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param string|array $input_class Optional. Additional classes to add. Default is an empty string.
	 * @return void Outputs the footer bottom wrap classes.
	 */
	function cosmoswp_footer_bottom_wrap_classes( $input_class = '' ) {

		// Initialize an empty array for the classes.
		$classes = array();

		// If input classes are not empty.
		if ( ! empty( $input_class ) ) {
			// If input classes are not already an array, split them into one.
			if ( ! is_array( $input_class ) ) {
				$input_class = preg_split( '#\s+#', $input_class );
			}
			// Merge the input classes into the $classes array.
			$classes = array_merge( $classes, $input_class );
		} else {
			// Ensure that we always coerce class to being an array when no input is provided.
			$input_class = array();
		}

		// Apply any filters for the footer bottom wrap classes.
		$classes = apply_filters( 'cosmoswp_footer_bottom_wrap_classes', $classes, $input_class );

		// Remove any duplicate classes.
		$classes = array_unique( $classes );

		// Sanitize the classes to ensure they are safe for HTML output.
		$classes = array_map( 'esc_attr', $classes );

		// Combine all classes into a single string separated by spaces.
		$classes = join( ' ', $classes );

		// Echo the sanitized class attribute.
		echo esc_attr( $classes );
	}
endif;


if ( ! function_exists( 'cosmoswp_meta_collection' ) ) :

	/**
	 * Custom template tags for this theme.
	 *
	 * @package CosmosWP
	 * @param array $cosmoswp_meta_element Meta elements to display.
	 * @return void
	 */
	function cosmoswp_meta_collection( $cosmoswp_meta_element = array() ) {
		// Hide author, category and tag text for pages.
		if ( ! is_array( $cosmoswp_meta_element ) && empty( $cosmoswp_meta_element ) ) {
			return;
		}
		foreach ( $cosmoswp_meta_element as $element ) {
			if ( 'published-date' === $element ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				$posted_on   = sprintf(
					'%s',
					'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				);
				echo '<span class="posted-on"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'far fa-calendar-alt' ) ) . '"></i> ' . $posted_on . '</span>'; // WPCS: XSS OK.
			} elseif ( 'updated-date' === $element ) {
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$time_string = '<time class="updated" datetime="%1$s">%2$s</time>';
				}
				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);
				$posted_on   = sprintf(
					'%s',
					'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				);
				echo '<span class="posted-on"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'far fa-calendar-alt' ) ) . '"></i> ' . $posted_on . '</span>'; // phpcs:ignore
			} elseif ( 'author' === $element ) {
				printf(
					'%s',
					'<span class="author vcard"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'far fa-user' ) ) . '"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				);
			} elseif ( 'categories' === $element ) {

				$categories_list = get_the_category_list( esc_html__( ', ', 'cosmoswp' ) );
				if ( $categories_list ) {
					printf( '<span class="cat-links"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'fas fa-tags' ) ) . '"></i> %1$s</span>', $categories_list ); //phpcs:ignore
				}
			} elseif ( 'tags' === $element ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'cosmoswp' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'fas fa-tags' ) ) . '"></i>%1$s</span>', $tags_list ); // phpcs:ignore
				}
			} elseif ( 'comments' === $element ) {
				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="comments-link"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'far fa-comment-alt' ) ) . '"></i>';
					comments_popup_link( esc_html__( 'Leave a comment', 'cosmoswp' ), esc_html__( '1 Comment', 'cosmoswp' ), esc_html__( '% Comments', 'cosmoswp' ) );
					echo '</span>';
				}
			} else {
				echo '';
			}
		}
		if ( get_edit_post_link() ) :
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'cosmoswp' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link"><i class="' . esc_attr( cosmoswp_get_correct_fa_font( 'far fa-edit' ) ) . '"></i>',
				'</span>'
			);
		endif;
	}
endif;

if ( ! function_exists( 'cosmoswp_sidebar_template' ) ) {

	/**
	 * Sidebar Template
	 * Content, Primary and Secondary Sidebar Display Template
	 *
	 * @since CosmosWP 1.0.2
	 *
	 * @param string $sidebar Sidebar position.
	 * @param string $front   Front page type.
	 * @return void
	 */
	function cosmoswp_sidebar_template( $sidebar, $front = 'blog' ) {
		$primary   = 'template-parts/sidebar/primary-sidebar';
		$secondary = 'template-parts/sidebar/secondary-sidebar';
		$content   = 'template-parts/main-content/blog-main-content';

		if ( 'post' === $front ) {
			$content = 'template-parts/main-content/post-main-content';
		} elseif ( 'page' === $front ) {
			$content = 'template-parts/main-content/cpage-main-content';
		} elseif ( 'cwp-woo-archive' === $front ) {
			$content   = 'cwp-woo/cwp-woo-archive-main-content';
			$primary   = 'cwp-woo/cwp-woo-primary-sidebar';
			$secondary = 'cwp-woo/cwp-woo-secondary-sidebar';
		} elseif ( 'cwp-woo-single' === $front ) {
			$content   = 'cwp-woo/cwp-woo-single-main-content';
			$primary   = 'cwp-woo/cwp-woo-primary-sidebar';
			$secondary = 'cwp-woo/cwp-woo-secondary-sidebar';
		} elseif ( 'cwp-edd-archive' === $front ) {
			$content   = 'edd/edd-archive-main-content';
			$primary   = 'edd/edd-primary-sidebar';
			$secondary = 'edd/edd-secondary-sidebar';
		} elseif ( 'cwp-edd-single' === $front ) {
			$content   = 'edd/edd-single-main-content';
			$primary   = 'edd/edd-primary-sidebar';
			$secondary = 'edd/edd-secondary-sidebar';
		}

		switch ( $sidebar ) :
			case 'ful-ct':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-12">';
				get_template_part( $content );
				echo '</div>';
				break;

			case 'middle-ct':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-8 offset-md-2">';
				get_template_part( $content );
				echo '</div>';
				break;

			case 'ps-ct':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $primary );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-9">';
				get_template_part( $content );
				echo '</div>';
				break;

			case 'ct-ps':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-9">';
				get_template_part( $content );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $primary );
				echo '</div>';
				break;

			case 'ss-ct-ps':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $secondary );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-6">';
				get_template_part( $content );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $primary );
				echo '</div>';
				break;

			case 'ss-ps-ct':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $secondary );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $primary );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-6">';
				get_template_part( $content );
				echo '</div>';
				break;

			case 'ct-ps-ss':
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-6">';
				get_template_part( $content );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $secondary );
				echo '</div>';
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-3">';
				get_template_part( $primary );
				echo '</div>';

				break;

			default:
				echo '<div class="cwp-grid-column cwp-ms-content-grid-column grid-md-12">';
				get_template_part( $content );
				echo '</div>';
				break;
		endswitch;
	}
}
