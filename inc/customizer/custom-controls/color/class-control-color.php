<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Customizer Control: cosmoswp-color.
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
 * Color control
 */
class CosmosWP_Custom_Control_Color extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'cosmoswp-color';

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
		if ( isset( $args['active_callback'] ) ) {
			$this->active_callback = $args['active_callback'];
		}
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
	}

	/**
	 * Handle by JavaScript.
	 *
	 * @return void
	 */
	public function render_content() {}
}
