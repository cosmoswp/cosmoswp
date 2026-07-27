<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Customizer Control: cosmoswp-sortable.
 *
 * @package     CosmosWP
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sortable control
 */
class CosmosWP_Custom_Control_Sortable extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'cosmoswp-sortable';

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
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['choices'] = $this->choices;

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

		$this->json['inputAttrs'] = maybe_serialize( $this->input_attrs() );
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {}
}
