<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Custom Common Section Class
 *
 * @package CosmosWP
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_WP_Customize_Section' ) ) :

	/**
	 * Custom Common Section Class
	 *
	 * @package CosmosWP
	 * @since 1.0.0
	 */
	class CosmosWP_WP_Customize_Section extends WP_Customize_Section {

		/**
		 * The section type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'cosmoswp-section';

		/**
		 * Constructor for the section.
		 *
		 * @param WP_Customize_Manager $manager The Customizer manager object.
		 * @param string               $id      The section ID.
		 * @param array                $args    The section arguments.
		 */
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			// Default to 'h3' type if not provided.
			$this->type = isset( $args['type'] ) ? $args['type'] : 'h3';
			if ( isset( $args['active_callback'] ) ) {
				$this->active_callback = $args['active_callback'];
			}
		}

		/**
		 * Handle by JavaScript.
		 *
		 * @return void
		 */
		public function render_content() {}
	}

endif;
