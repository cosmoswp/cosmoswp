<?php
/**
 * WooCommerce single main.
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><div class="cosmoswp-woo-single-grid-row">
	<?php
	/**
	 * WooCommerce hook.
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );

	while ( have_posts() ) :
		the_post();

		$woo_single_list_elements = cosmoswp_get_theme_options( 'cwc-single-elements' );
		$woo_single_list_elements = apply_filters( 'cosmoswp_woo_single_list_elements', $woo_single_list_elements );

		if ( ! is_array( $woo_single_list_elements ) || empty( $woo_single_list_elements ) ) {
			return;
		}

		/**
		 * Hook: woocommerce_before_single_product.
		 *
		 * @hooked wc_print_notices - 10
		 */
		do_action( 'woocommerce_before_single_product' );

		if ( post_password_required() ) {
			echo get_the_password_form(); //phpcs:ignore
			return;
		}
		?>

		<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
			<div class="cwp-single-summary-wrapper">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>

				<div class="cwp-single-summary-content">
					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>

			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_single_product' ); ?>

		<?php
	endwhile;

	/**
	 * WooCommerce hook.
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10
	 */
	do_action( 'woocommerce_after_main_content' );
	?>
</div><!-- .cosmoswp-woo-single-grid-row -->
