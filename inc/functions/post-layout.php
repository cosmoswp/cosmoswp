<?php
/**
 * Post layout functions
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cosmoswp_heading_title' ) ) {

	/**
	 * Banner Heading
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @return string
	 */
	function cosmoswp_heading_title() {
		$banner_title = '';
		if ( is_search() ) {
			?>
			<div class="entry-header">
				<h1 class="page-title">
					<?php
					printf(
						// Translators: %s is the search query entered by the user.
						esc_html__( 'Search Results for: %s', 'cosmoswp' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h1>
			</div>
			<?php
		} elseif ( is_archive() ) {
			if ( is_post_type_archive( 'download' ) ) {
				$edd_main_title = cosmoswp_get_theme_options( 'edd-archive-main-title' );
				if ( ! empty( $edd_main_title ) ) {
					?>
					<div class="entry-header">
						<h1 class="page-title">
							<?php
							echo esc_html( $edd_main_title );
							?>
						</h1>
					</div><!-- .page-header --> 
					<?php
				}
			} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
				?>
				<div class="entry-header">
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
				</div>
				<?php
			} else {
				?>
				<div class="entry-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div><!-- .page-header -->
				<?php
			}
		} elseif ( is_singular( 'download' ) ) {
			$edd_main_title = cosmoswp_get_theme_options( 'edd-archive-main-title' );
			if ( ! empty( $edd_main_title ) ) {
				?>
				<div class="entry-header">
					<h1 class="page-title">
						<?php echo esc_html( $edd_main_title ); ?>
					</h1>
				</div><!-- .page-header --> 
				<?php
			}
		} elseif ( class_exists( 'WooCommerce' ) && is_product() ) {
			?>
			<div class="entry-header">
				<h1 class="page-title">
					<?php woocommerce_page_title(); ?>
				</h1>
			</div><!-- .page-header --> 
			<?php

		} elseif ( is_singular() ) {
			$banner_display_option = cosmoswp_get_theme_options( 'banner-section-display' );
			if ( 'hide' !== $banner_display_option && ( ! empty( $banner_display_option ) ) ) {
				$single_title_options = cosmoswp_get_theme_options( 'single-banner-section-title' );
				$tag                  = cosmoswp_get_theme_options( 'single-banner-title-tag' );
				if ( 'disable' === $single_title_options ) {
					return false;
				}
				if ( 'custom-title' === $single_title_options ) {
					$banner_title = esc_html( cosmoswp_get_theme_options( 'single-custom-banner-title' ) );
				} else {
					$banner_title = get_the_title();
				}
			}
			if ( ! empty( $banner_title ) ) {
				?>
				<div class="entry-header">
					<?php echo '<' . esc_attr( $tag ) . ' class="page-title">' . esc_html( $banner_title ) . '</' . esc_attr( $tag ) . '>'; ?>
				</div>
				<?php
			}
		} elseif ( is_home() ) {
			$banner_title = cosmoswp_get_theme_options( 'blog-main-title' );
			if ( ! empty( $banner_title ) ) {
				?>
				<div class="entry-header" id="cwp-blog-entry-header">
					<h1 class="page-title">
						<?php echo esc_html( $banner_title ); ?>
					</h1>
				</div>
				<?php
			}
		} else {
			?>
			<div class="entry-header">
				<h1 class="page-title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
			</div>
			<?php
		}
	}
}
