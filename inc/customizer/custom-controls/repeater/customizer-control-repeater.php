<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Custom Control Repeater Controls
 *
 * @package CosmosWP
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CosmosWP_Repeater_Control' ) ) :

	/**
	 * Custom Control Repeater Controls
	 *
	 * @package CosmosWP
	 * @since 1.0.0
	 */
	class CosmosWP_Repeater_Control extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'cosmoswp-repeater';

		/**
		 * Main label.
		 *
		 * @access public
		 * @var string
		 */
		public $repeater_main_label = '';

		/**
		 * .
		 * Add field label
		 *
		 * @access public
		 * @var string
		 */
		public $repeater_add_control_field = '';

		/**
		 * The fields that each container row will contain.
		 *
		 * @access public
		 * @var array
		 */
		public $fields = array();

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $repeater_enable = true;

		/**
		 * Constructor. Initializes the custom controls..
		 *
		 * @since 1.0.0
		 *
		 * @param mixed   $manager The manager object (e.g., responsible for registering the field group).
		 * @param string  $id      The unique ID of the field group.
		 * @param array   $args    Optional arguments for the field group (e.g., title, context).
		 * @param array   $fields  An array of field definitions.
		 * @param boolean $repeater_enable  Add enable field on repeater.
		 */
		public function __construct( $manager, $id, $args = array(), $fields = array(), $repeater_enable = true ) {
			$this->fields                     = $fields;
			$this->repeater_main_label        = $args['repeater_main_label'];
			$this->repeater_add_control_field = $args['repeater_add_control_field'];
			$this->repeater_enable            = $repeater_enable;
			if ( isset( $args['active_callback'] ) ) {
				$this->active_callback = $args['active_callback'];
			}
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Prepare data for JavaScript.
		 *
		 * @return array
		 */
		public function json() {
			$json                               = parent::json();
			$json['fields']                     = $this->fields;
			$json['repeater_main_label']        = $this->repeater_main_label;
			$json['repeater_add_control_field'] = $this->repeater_add_control_field;
			$json['repeater_enable']            = $this->repeater_enable;
			return $json;
		}

		/**
		 * Handle by JavaScript.
		 *
		 * @return void
		 */
		public function render_content() {}
	}
endif;
