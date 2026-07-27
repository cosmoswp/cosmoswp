<?php
/**
 * WooCommerce Cart Template for CosmosWP Theme
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_enable = cosmoswp_get_theme_options( 'cwp-enable-woo-cart' );

// Return early if cart is disabled.
if ( ! $is_enable ) {
	return;
}

// Get cart icon and alignment settings.
$icon  = cosmoswp_get_correct_fa_font( cosmoswp_get_theme_options( 'cwp-woo-cart-icon' ) );
$align = cosmoswp_get_theme_options( 'cwp-woo-cart-icon-align' );

// Check if WooCommerce is active.
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

// Verify cart instance is available.
if ( ! WC()->cart ) {
	return;
}
?><div class="cwp-wc-cart-section">
	<div class="cwp-wc-cart-wrapper">
		<span class="cwp-wc-cart-icon-wrapper <?php echo esc_attr( $align ); ?>">
			<a class="cwp-wc-icon cart-icon" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'View shopping cart', 'cosmoswp' ); ?>">
				<i class="cwp-wc-icon-i <?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
				<span class="cwp-cart-value cwp-cart-customlocation">
					<?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?>
				</span>
			</a>
		</span>
		<div class="cwp-wc-cart-widget-wrapper">
			<?php the_widget( 'WC_Widget_Cart', '' ); ?>
		</div>
	</div>
</div><!-- .cwp-wc-cart-section -->
