<?php
/**
 * Include custom controls for the Customizer.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*Custom Control*/
require cosmoswp_file_directory( 'inc/customizer/custom-controls/section/section.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/buttonset/class-control-buttonset.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/buttonset/class-control-responsive-buttonset.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/color/class-control-color.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/message/class-control-message.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/heading/class-control-heading.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/slider/class-control-slider.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/sortable/class-control-sortable.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/multicheck/class-control-multicheck.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/repeater/customizer-control-repeater.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/icons/customizer-control-icons.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/group/class-control-group.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/cssbox/class-control-cssbox.php' );
require cosmoswp_file_directory( 'inc/customizer/custom-controls/tabs/class-control-tabs.php' );

/*Register Section*/
$wp_customize->register_section_type( 'CosmosWP_WP_Customize_Section' );

// Register JS control types.
require cosmoswp_file_directory( 'inc/customizer/custom-controls/back-compact/index.php' );
