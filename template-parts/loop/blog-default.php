<?php
/**
 * Template part for displaying posts and search results.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* blog element with sorting */
$blog_sorting_element = cosmoswp_get_theme_options( 'blog-elements-sorting' );
$blog_sorting_element = apply_filters( 'cosmoswp_blog_elements', $blog_sorting_element );
if ( ! is_array( $blog_sorting_element ) || empty( $blog_sorting_element ) ) {
	return;
}

/* meta data */
$primary_meta_element   = cosmoswp_get_theme_options( 'blog-primary-meta-sorting' );
$secondary_meta_element = cosmoswp_get_theme_options( 'blog-secondary-meta-sorting' );

/*featured image*/
$thumbnail_size = cosmoswp_get_theme_options( 'blog-img-size' );
if ( has_post_thumbnail() ) {
	$featured_image_layout = cosmoswp_get_theme_options( 'blog-feature-section-layout' );
} else {
	$featured_image_layout = 'no-image';
}


if ( ! is_array( $blog_sorting_element ) || empty( $blog_sorting_element ) ) {
	return;
}
foreach ( $blog_sorting_element as $element ) {
	if ( 'title' === $element ) {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	} elseif ( 'primary-meta' === $element ) {
		if ( is_array( $primary_meta_element ) && ! empty( $primary_meta_element ) ) { ?>

			<div class="entry-meta primary-meta">
				<?php
				cosmoswp_meta_collection( $primary_meta_element );
				?>
			</div><!-- .entry-meta -->
			<?php
		}
	} elseif ( 'featured-section' === $element ) {
		if ( has_post_thumbnail() && 'hide-image' !== $featured_image_layout ) {
			cosmoswp_post_thumbnail( $thumbnail_size );
		}
	} elseif ( 'content' === $element ) {
		?>
		<div class="entry-content clearfix">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'cosmoswp' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
		<?php
	} elseif ( 'excerpt' === $element ) {
		$excerpt_length = absint( cosmoswp_get_theme_options( 'blog-excerpt-length' ) );
		if ( $excerpt_length ) {
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
		}
	} elseif ( 'secondary-meta' === $element ) {

		if ( is_array( $secondary_meta_element ) && ! empty( $secondary_meta_element ) ) {
			?>
			<div class="entry-meta secondary-meta">
				<?php
				cosmoswp_meta_collection( $secondary_meta_element );
				?>
			</div><!-- .entry-meta -->
			<?php
		}
	}
}
