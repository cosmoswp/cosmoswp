<?php
/**
 * WooCommerce Archive Products Template for CosmosWP Theme
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get default view option.
$woo_archive_default_view = cosmoswp_get_theme_options( 'cwc-archive-default-view' );
$default_view_class       = $woo_archive_default_view ? 'cwp-' . esc_attr( $woo_archive_default_view ) : 'cwp-grid';
?><div class="cosmoswp-woo-archive-grid-row <?php echo esc_attr( $default_view_class ); ?>">
	<?php
	if ( woocommerce_product_loop() ) {
		// Get theme options for archive elements.
		$woo_archive_show_result_number = cosmoswp_get_theme_options( 'cwc-archive-show-result-number' );
		$woo_archive_show_sort_bar      = cosmoswp_get_theme_options( 'cwc-archive-show-sort-bar' );
		$woo_archive_show_grid_list     = cosmoswp_get_theme_options( 'cwc-archive-show-grid-list' );
		$cwc_archive_psp_sm             = cosmoswp_get_theme_options( 'cwc-archive-psp-sm' );
		$sidebar                        = cosmoswp_get_theme_options( 'cwp-woo-archive-sidebar' );

		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked woocommerce_output_all_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );

		// Start product loop.
		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'total' ) ) {
			?>
			<div class="grid-12">
				<div class="cwp-woo-archive-toolbar">
					<?php
					// Show sidebar toggle for specific sidebar layouts.
					if ( $cwc_archive_psp_sm && in_array( $sidebar, array( 'ps-ct', 'ct-ps', 'ss-ct-ps', 'ss-ps-ct', 'ct-ps-ss' ), true ) ) {
						$open_text = cosmoswp_get_theme_options( 'cwc-archive-psp-sm-open-text' );
						echo '<a class="cwc-archive-psp-sm cwc-archive-psp-sm-toggle" href="#" aria-label="' . esc_attr__( 'Toggle Sidebar', 'cosmoswp' ) . '">' . wp_kses_post( $open_text ) . '</a>';
					}

					// Grid/List view switcher.
					if ( $woo_archive_show_grid_list ) {
						$grid_icon = cosmoswp_get_correct_fa_font( 'fas fa-th' );
						$list_icon = cosmoswp_get_correct_fa_font( 'fas fa-list' );
						?>
						<div class="cwp-woo-view-switcher">
							<span class="cwp-trigger-grid <?php echo esc_attr( $grid_icon ); ?> <?php echo 'grid' === $woo_archive_default_view ? 'active' : ''; ?>" data-view="grid" aria-label="<?php esc_attr_e( 'Grid View', 'cosmoswp' ); ?>"></span>
							<span class="cwp-trigger-list <?php echo esc_attr( $list_icon ); ?> <?php echo 'list' === $woo_archive_default_view ? 'active' : ''; ?>" data-view="list" aria-label="<?php esc_attr_e( 'List View', 'cosmoswp' ); ?>"></span>
						</div>
						<?php
					}

					// Result count.
					if ( $woo_archive_show_result_number ) {
						woocommerce_result_count();
					}

					// Sorting .
					if ( $woo_archive_show_sort_bar ) {
						woocommerce_catalog_ordering();
					}
					?>
				</div>
			</div>
			<?php

			// Product loop.
			while ( have_posts() ) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action( 'woocommerce_shop_loop' );

				// Load product template.
				wc_get_template_part( 'content', 'product' );
			}
		}

		// End product loop.
		woocommerce_product_loop_end();

		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );

	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}
	?>
</div><!-- .cosmoswp-woo-archive-grid-row -->
