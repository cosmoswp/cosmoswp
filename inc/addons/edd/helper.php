<?php
/**
 * EDD helpers functions
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cosmoswp_is_edd_active' ) ) {
	/**
	 * Check if Edd activated.
	 */
	function cosmoswp_is_edd_active() {
		return class_exists( 'Easy_Digital_Downloads' ) ? true : false;
	}
}

if ( ! function_exists( 'cosmoswp_downloads_navigation' ) ) {
	/**
	 * EDD Downloads navigation
	 *
	 * @since cosmoswp 1.0.0
	 *
	 * @return void
	 */
	function cosmoswp_downloads_navigation() {

		$edd_navigation_options = cosmoswp_get_theme_options( 'edd-navigation-options' );
		if ( 'disable' === $edd_navigation_options ) {
			return;
		}
		if ( 'default' === $edd_navigation_options ) {
			// Previous/next page navigation.
			the_posts_navigation(
				array(
					'prev_text'          => __( 'Older Downloads', 'cosmoswp' ),
					'next_text'          => __( 'Newer Downloads', 'cosmoswp' ),
					'screen_reader_text' => __( 'Downloads navigation', 'cosmoswp' ),
					'aria_label'         => __( 'Downloads', 'cosmoswp' ),
				)
			);
		} else {
			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => '&laquo; ',
					'next_text'          => ' &raquo;',
					'screen_reader_text' => __( 'Downloads navigation', 'cosmoswp' ),
					'aria_label'         => __( 'Downloads', 'cosmoswp' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cosmoswp' ) . ' </span>',
				)
			);
		}
	}
}
add_action( 'cosmoswp_action_edd_navigation', 'cosmoswp_downloads_navigation' );

if ( ! function_exists( 'cosmoswp_is_edd_page' ) ) {
	/**
	 * Checks if the current page is a edd page
	 *
	 * @return boolean
	 */
	function cosmoswp_is_edd_page() {
		if (
		is_singular( 'download' ) ||
		is_post_type_archive( 'download' ) ||
		is_tax( 'download_category' ) ||
		is_tax( 'download_tag' )
		) {
			return true;
		}
		return false;
	}
}

if ( ! function_exists( 'cosmoswp_is_edd_archive' ) ) {
	/**
	 * Checks if the current page is a edd download archive
	 *
	 * @return boolean
	 */
	function cosmoswp_is_edd_archive() {
		if (
		is_post_type_archive( 'download' ) ||
		is_tax( 'download_category' ) ||
		is_tax( 'download_tag' )
		) {
			return true;
		}
		return false;
	}
}

if ( ! function_exists( 'cosmoswp_is_edd_single' ) ) {
	/**
	 * Checks if the current page is a edd single
	 *
	 * @return boolean
	 */
	function cosmoswp_is_edd_single() {
		if ( is_singular( 'download' ) ) {
			return true;
		}
		return false;
	}
}

if ( ! function_exists( 'cosmoswp_edd_sorting' ) ) {
	/**
	 * Edd Sorting Bar
	 *
	 * @return boolean
	 */
	function cosmoswp_edd_sorting() {
		$options  = array(
			'date'       => __( 'Latest', 'cosmoswp' ),
			'date-asc'   => __( 'Oldest', 'cosmoswp' ),
			'a-z'        => __( 'Alphabet', 'cosmoswp' ),
			'z-a'        => __( 'Alphabet Desc', 'cosmoswp' ),
			'price'      => __( 'Sort by price: low to high', 'cosmoswp' ),
			'price-desc' => __( 'Sort by price: high to low', 'cosmoswp' ),
		);
		$selected = isset( $_GET['sortby'] ) ? sanitize_text_field( wp_unslash( $_GET['sortby'] ) ) : 'date';

		$sorting_html
		= '<div class="sorting-wrap">
            <span>' . esc_html__( 'Sort By:', 'cosmoswp' ) . '</span>
            <div class="select-box"> <select name="" id="cosmoswp-edd-select-filter" class="selectpicker">';

		foreach ( $options as $key => $val ) {
			$sorting_html .= "<option value='" . esc_attr( $key ) . "' " . selected( $key, $selected, false ) . "'>";
			$sorting_html .= esc_html( $val );
			$sorting_html .= '</option>';
		}

		$sorting_html
		.= '</select>
            </div>
        </div>';
		$sorting_html  = apply_filters( 'cosmoswp_edd_sorting', $sorting_html );
		return $sorting_html;
	}
}



if ( ! function_exists( 'edd_filter_products_by_permalink' ) ) {

	/**
	 * Filter pre_get_posts in EDD Archive
	 *
	 * @param object $query Query.
	 *
	 * @return boolean
	 */
	function edd_filter_products_by_permalink( $query ) {
		if ( is_admin() ) :
			return $query;
		endif;
		if ( $query->is_main_query() && ( is_post_type_archive( 'download' ) || is_tax( 'download_category' ) )
		) {

			if ( isset( $_GET['sortby'] ) && ! empty( $_GET['sortby'] ) ) {
				$sort = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
				if ( $sort === 'date' ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'orderby', 'date' );
				} elseif ( $sort === 'date-asc' ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'orderby', 'date' );

				} elseif ( $sort === 'a-z' ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'orderby', 'title' );

				} elseif ( $sort === 'z-a' ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'orderby', 'title' );

				} elseif ( $sort === 'price' ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'post_type', 'download' );
					$query->set( 'orderby', 'meta_value_num' );
					$query->set( 'meta_key', 'edd_price' );
				} elseif ( $sort === 'price-desc' ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'post_type', 'download' );
					$query->set( 'orderby', 'meta_value_num' );
					$query->set( 'meta_key', 'edd_price' );

				}
			}
		}
	}

	add_action( 'pre_get_posts', 'edd_filter_products_by_permalink' );
}


if ( ! function_exists( 'cosmoswp_edd_archive_elements_sorting' ) ) {
	/**
	 * Edd Archive Elements Sorting
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @return array $cosmoswp_edd_archive_elements_sorting
	 */
	function cosmoswp_edd_archive_elements_sorting() {
		$cosmoswp_edd_archive_elements_sorting = array(
			'image'   => esc_html__( 'Image', 'cosmoswp' ),
			'cats'    => esc_html__( 'Categories', 'cosmoswp' ),
			'tags'    => esc_html__( 'Tags', 'cosmoswp' ),
			'title'   => esc_html__( 'Title', 'cosmoswp' ),
			'price'   => esc_html__( 'Price', 'cosmoswp' ),
			'excerpt' => esc_html__( 'Excerpt', 'cosmoswp' ),
			'content' => esc_html__( 'Content', 'cosmoswp' ),
			'cart'    => esc_html__( 'Add To Cart', 'cosmoswp' ),
		);
		return apply_filters( 'cosmoswp_edd_archive_elements_sorting', $cosmoswp_edd_archive_elements_sorting );
	}
}


if ( ! function_exists( 'cosmoswp_edd_single_elements' ) ) {
	/**
	 * Edd Single Elements Sorting
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @return array $cosmoswp_edd_single_elements
	 */
	function cosmoswp_edd_single_elements() {
		$cosmoswp_edd_single_elements = array(
			'cats'    => esc_html__( 'Categories', 'cosmoswp' ),
			'tags'    => esc_html__( 'Tags', 'cosmoswp' ),
			'author'  => esc_html__( 'Author', 'cosmoswp' ),
			'title'   => esc_html__( 'Title', 'cosmoswp' ),
			'price'   => esc_html__( 'Price', 'cosmoswp' ),
			'excerpt' => esc_html__( 'Excerpt', 'cosmoswp' ),
			'content' => esc_html__( 'Content', 'cosmoswp' ),
			'cart'    => esc_html__( 'Add To Cart', 'cosmoswp' ),
		);
		return apply_filters( 'cosmoswp_edd_single_elements', $cosmoswp_edd_single_elements );
	}
}
