<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Custom Control for Icons Controls
 *
 * @package CosmosWP
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CosmosWP_Customize_Icons_Control' ) ) :
	/**
	 * Custom Control for Icons Controls
	 *
	 * @package CosmosWP
	 * @since 1.0.0
	 */
	class CosmosWP_Customize_Icons_Control extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'cosmoswp-icons';

		/**
		 * Constructor. Initializes the custom controls..
		 *
		 * @since 1.0.0
		 *
		 * @param mixed  $manager The manager object (e.g., responsible for registering the field group).
		 * @param string $id      The unique ID of the field group.
		 * @param array  $args    Optional arguments for the field group (e.g., title, context).
		 * @param array  $fields  An array of field definitions.
		 */
		public function __construct( $manager, $id, $args = array(), $fields = array() ) {
			if ( isset( $args['active_callback'] ) ) {
				$this->active_callback = $args['active_callback'];
			}
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Handle by JavaScript.
		 *
		 * @return void
		 */
		public function render_content() {}
	}
endif;
