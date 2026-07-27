<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Customizer Control: cosmoswp-cssbox.
 *
 * @package     CosmosWP theme
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Buttonset control
 */
class CosmosWP_Custom_Control_Cssbox extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'cosmoswp-cssbox';

	/**
	 * Constructor. Initializes the custom controls..
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $manager The manager object (e.g., responsible for registering the field group).
	 * @param string $id      The unique ID of the field group.
	 * @param array  $args    Optional arguments for the field group (e.g., title, context).
	 * @param array  $fields  An array of field definitions.
	 * @param array  $attr  An array of attributes.
	 */
	public function __construct( $manager, $id, $args = array(), $fields = array(), $attr = array() ) {
		$default_fields  = array(
			'top'    => true,
			'right'  => true,
			'bottom' => true,
			'left'   => true,
		);
		$box_fields_attr = ! empty( $fields ) ? $fields : $default_fields;

		$this->fields = $box_fields_attr;
		$this->attr   = $attr;
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
		$this->json['attr']        = $this->attr;
		$this->json['fields']      = $this->fields;
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 *
	 * @see WP_Customize_Control::render()
	 */
	protected function render() {
		$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
		$class = 'customize-control has-switchers customize-control-' . $this->type;

		?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>"></li>
		<?php
	}

	/**
	 * Handle by JavaScript.
	 *
	 * @return void
	 */
	public function render_content() {}
}
