<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Custom Control Tabs
 *
 * @package CosmosWP
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CosmosWP_Custom_Control_Tabs' ) ) :

	/**
	 * Custom Control Tabs
	 *
	 * @package CosmosWP
	 * @since 1.0.0
	 */
	class CosmosWP_Custom_Control_Tabs extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'cosmoswp-tabs';

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
			$this->fields = $fields;
			$this->label  = $args['label'];
			if ( isset( $args['active_callback'] ) ) {
				$this->active_callback = $args['active_callback'];
			}
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * JSON representation of the control for JS
		 */
		public function to_json() {
			parent::to_json();
			$this->json['label']       = $this->label;
			$this->json['description'] = $this->description;
			$this->json['fields']      = $this->fields;
		}

		/**
		 * Handle by JavaScript.
		 *
		 * @return void
		 */
		public function render_content() {}
	}
endif;
