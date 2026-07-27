<?php
/**
 * Primary Menu
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$menu_align             = cosmoswp_get_theme_options( 'primary-menu-align' );
$submenu_display_option = cosmoswp_get_theme_options( 'primary-menu-submenu-display-options' );

$disable_sub_menu = cosmoswp_get_theme_options( 'primary-menu-disable-sub-menu' );
$disable_sub_menu = ( $disable_sub_menu ) ? 1 : 0;
?>
<!-- Start of .navigation -->
<div class="cwp-primary-menu-wrapper navigation <?php echo esc_attr( $menu_align . ' ' . $submenu_display_option ); ?>">
	<?php
	$nav_menu_args = array(
		'theme_location' => 'header-primary-menu',
		'menu_class'     => 'cwp-primary-menu',
		'depth'          => $disable_sub_menu,
		'container'      => '',
	);
	wp_nav_menu( apply_filters( 'cwp_primary_nav_menu_args', $nav_menu_args ) );
	?>
</div>
<!-- End of .navigation -->
