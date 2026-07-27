<?php
/**
 * Triggers the WooCommerce secondary sidebar action hook
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'cosmoswp_woo_secondary_sidebar' );
