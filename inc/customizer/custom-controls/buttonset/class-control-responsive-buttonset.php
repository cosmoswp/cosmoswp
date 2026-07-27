<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Customizer Control: cosmoswp-responsive-buttonset.
 *
 * @package     CosmosWP WordPress theme
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Responsive Buttonset control
 */
class CosmosWP_Custom_Control_Responsive_Buttonset extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'cosmoswp-responsive-buttonset';

	/**
	 * Constructor. Initializes the custom controls..
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $manager The manager object (e.g., responsible for registering the field group).
	 * @param string $id      The unique ID of the field group.
	 * @param array  $args    Optional arguments for the field group (e.g., title, context).
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->devices = array(
			'desktop' => array(
				'icon' => 'dashicons-desktop',
			),
			'tablet'  => array(
				'icon' => 'dashicons-tablet',

			),
			'mobile'  => array(
				'icon' => 'dashicons-smartphone ',
			),
		);
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
		$this->json['choices']     = $this->choices;
		$this->json['devices']     = $this->devices;
	}

	/**
	 * Handle by JavaScript.
	 *
	 * @return void
	 */
	public function render_content() {}
}
