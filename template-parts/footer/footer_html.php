<?php
/**
 * Template part for displaying footer html
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$raw_html = cosmoswp_get_theme_options( 'footer-html-container' );
$raw_html = apply_filters( 'cosmoswp_footer_html', $raw_html );
?>
<div class="cwp-footer-custom-html">
	<?php echo do_shortcode( wp_kses_post( $raw_html ) ); ?>
</div>
