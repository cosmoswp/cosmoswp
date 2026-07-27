<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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
<div <?php wc_product_cat_class( $grid, $category ); ?>>
	<?php
	/**
	 * Hook woocommerce_before_subcategory.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * Hook woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * Hook woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * Hook woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * Hook woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category );
	?>
</div>
