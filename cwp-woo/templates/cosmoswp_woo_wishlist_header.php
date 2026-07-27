<?php
/**
 * WooCommerce Wishlist Template for CosmosWP Theme
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_enable = cosmoswp_get_theme_options( 'cwp-enable-woo-wishlist' );

// Return early if wishlist is disabled.
if ( ! $is_enable ) {
	return;
}

// Check if YITH WooCommerce Wishlist is active.
if ( ! class_exists( 'YITH_WCWL' ) ) {
	return;
}

// Get wishlist icon and alignment settings.
$icon  = cosmoswp_get_correct_fa_font( cosmoswp_get_theme_options( 'cwp-woo-wishlist-icon' ) );
$align = cosmoswp_get_theme_options( 'cwp-woo-wishlist-icon-align' );

// Get wishlist page ID and verify it exists.
$wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );

// Return if no valid wishlist page exists.
if ( ! absint( $wishlist_page_id ) ) {
	return;
}

// Verify the wishlist page is published.
$wishlist_page = get_post( $wishlist_page_id );
if ( ! $wishlist_page || 'publish' !== $wishlist_page->post_status ) {
	return;
}
?><div class="cwp-wc-wishlist-wrapper <?php echo esc_attr( $align ); ?>">
	<a class="cwp-wc-wishlist-icon wishlist-icon" href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>" aria-label="<?php esc_attr_e( 'View your wishlist', 'cosmoswp' ); ?>">
		<i class="cwp-wc-icon-i <?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
		<span class="cwp-wishlist-value">
			<?php echo absint( yith_wcwl_count_products() ); ?>
		</span>
	</a>
</div>
