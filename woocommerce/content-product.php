<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$woo_archive_list_elements = cosmoswp_get_theme_options( 'cwc-archive-elements' );
$woo_archive_list_elements = apply_filters( 'cosmoswp_woo_archive_elements', $woo_archive_list_elements );
if ( ! is_array( $woo_archive_list_elements ) || empty( $woo_archive_list_elements ) ) {
	return;
}
$columns                    = wc_get_loop_prop( 'columns' );
$woo_archive_elements_align = cosmoswp_get_theme_options( 'cwc-archive-elements-align' );
$grid                       = esc_attr( $woo_archive_elements_align );
$cwc_archive_responsive_col = json_decode( cosmoswp_get_theme_options( 'cwc-archive-responsive-col' ), true );

/*Add Default and Responsive grid Class*/
$grid .= ' ' . esc_attr( cosmoswp_get_l_grid_class( $columns ) );
if ( isset( $cwc_archive_responsive_col['tab-col'] ) ) {
	$grid .= ' ' . esc_attr( cosmoswp_get_grid_class( $cwc_archive_responsive_col['tab-col'] ) );
}
if ( isset( $cwc_archive_responsive_col['mobile-col'] ) ) {
	$grid .= ' ' . esc_attr( cosmoswp_get_s_grid_class( $cwc_archive_responsive_col['mobile-col'] ) );
}
?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $grid ); ?>>
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
		if ( is_shop() || is_product_category() || is_product_tag() ) {
			echo "<div class='cwp-image-box cwp-list-image-box'>";

			woocommerce_template_loop_product_link_open();
			woocommerce_template_loop_product_thumbnail();
			woocommerce_template_loop_product_link_close();


			if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
				echo '<p class="stock out-of-stock">' . esc_html__( 'Out of Stock', 'cosmoswp' ) . '</p>';
			} else {
				woocommerce_show_product_loop_sale_flash();
			}
			echo '</div>';
		}
		echo "<div class='cwp-product-content'>";
		foreach ( $woo_archive_list_elements as $element ) {
			if ( 'image' === $element ) {
				echo "<div class='cwp-image-box cwp-elements'>";
				woocommerce_template_loop_product_link_open();
				woocommerce_template_loop_product_thumbnail();
				woocommerce_template_loop_product_link_close();
				if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
					echo '<p class="stock out-of-stock">' . esc_html__( 'Out of Stock', 'cosmoswp' ) . '</p>';
				} else {
					woocommerce_show_product_loop_sale_flash();
				}
				echo '</div>';
			} elseif ( 'cat' === $element ) {
				echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ', '<div class="cwp-woo-cat cwp-elements">', '</div>' ) );
			} elseif ( 'title' === $element ) {
				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );

				/**
				 * Hook: woocommerce_shop_loop_item_title.
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * Hook: woocommerce_after_shop_loop_item_title.
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			} elseif ( 'price' === $element ) {
				echo "<div class='cwp-price-box cwp-elements'>";
				woocommerce_template_loop_price();
				echo '</div>';
			} elseif ( 'rating' === $element ) {
				echo "<div class='cwp-rating-box cwp-elements'>";
				woocommerce_template_loop_rating();
				echo '</div>';
			} elseif ( 'cart' === $element ) {
				echo "<div class='cwp-buttons cwp-elements'>";
				woocommerce_template_loop_add_to_cart();
				echo '</div>';
			} elseif ( 'excerpt' === $element ) {
				?>
				<div class="entry-excerpt cwp-elements">
					<?php
					$length = cosmoswp_get_theme_options( 'cwc-archive-excerpt-length' );
					if ( ! $length ) {
						echo wp_kses_post( strip_shortcodes( $post->post_excerpt ) );
					} else {
						echo wp_kses_post( wp_trim_words( strip_shortcodes( $post->post_excerpt ), $length ) );
					}
					?>
				</div><!-- .entry-content -->
				<?php
			} elseif ( 'content' === $element ) {
				?>
				<div class="entry-content cwp-elements">
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
			}
		}
		echo '</div>';
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div><!--End of product-->
<?php
