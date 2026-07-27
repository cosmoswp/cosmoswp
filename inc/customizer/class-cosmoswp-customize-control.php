<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * CosmosWP Customizer Control Manager
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Customize Control Manager class for CosmosWP theme.
 *
 * This class provides functionality to manage and organize WordPress customizer controls
 * specifically for the CosmosWP theme's JavaScript implementation.
 *
 * @package    CosmosWP
 * @subpackage Customizer
 * @since      1.0.0
 */

/**
 * Class CosmosWP_Customize_Control
 */
class CosmosWP_Customize_Control {

	/**
	 * Array of registered controls.
	 *
	 * @var array
	 */
	private $controls = array();

	/**
	 * Add a control to the manager.
	 *
	 * @param string|WP_Customize_Control $id   Control ID or WP_Customize_Control object.
	 * @param array                       $args Control arguments (optional if $id is object).
	 *
	 * @return void
	 */
	public function add( $id, $args = array() ) {
		// If it's an object like WP_Customize_Color_Control.
		if ( is_object( $id ) && $id instanceof WP_Customize_Control ) {
			$control_obj = $id;
			$control_id  = $control_obj->id;
			// Process settings to extract just the setting IDs.
			$settings = $this->extract_settings( $control_obj );
			if ( is_array( $settings ) ) {
				$settings = reset( $settings );
			}

			// Build the basic control args.
			$args = array(
				'type'                       => $control_obj->type,
				'settings'                   => $settings,
				'label'                      => $control_obj->label,
				'description'                => $control_obj->description,
				'section'                    => $control_obj->section,
				'priority'                   => $control_obj->priority,
				'choices'                    => isset( $control_obj->choices ) ? $control_obj->choices : array(),
				'input_attrs'                => isset( $control_obj->input_attrs ) ? $control_obj->input_attrs : array(),
				'fields'                     => isset( $control_obj->fields ) ? $control_obj->fields : array(),
				'repeater_main_label'        => isset( $control_obj->repeater_main_label ) ? $control_obj->repeater_main_label : null,
				'repeater_add_control_field' => isset( $control_obj->repeater_add_control_field ) ? $control_obj->repeater_add_control_field : null,
				'repeater_enable'            => isset( $control_obj->repeater_enable ) ? $control_obj->repeater_enable : null,
				'devices'                    => isset( $control_obj->devices ) ? $control_obj->devices : null,
			);
			if ( in_array( $control_obj->type, array( 'image', 'media', 'upload' ), true ) ) {
				// @see WP_Customize_Media_Control to_json
				$args['mime_type']     = isset( $control_obj->mime_type ) ? $control_obj->mime_type : null;
				$args['button_labels'] = isset( $control_obj->button_labels ) ? $control_obj->button_labels : null;
				$args['canUpload']     = current_user_can( 'upload_files' );
				$value                 = $control_obj->value();

				if ( $value ) {
					$attachment = array(
						'id'   => 1,
						'url'  => $value,
						'type' => $control_obj->type,
					);
					if ( 'image' === $control_obj->type ) {
						$attachment['sizes'] = array(
							'full' => array( 'url' => $value ),
						);
						$args['attachment']  = $attachment;
					} else {
						$args['attachment'] = wp_prepare_attachment_for_js( $value );
					}
				}
			}

			// Handle active_callback.
			$this->handle_active_callback( $control_obj, $args );

		} else {
			$control_id = $id;
			// Ensure settings is properly formatted for array-based controls.
			if ( isset( $args['settings'] ) && is_object( $args['settings'] ) ) {
				$args['settings'] = $args['settings']->id;
			}
			// Process active_callback for array-based controls.
			$this->handle_active_callback_array( $args );
		}

		// Save to control list.
		$this->controls[ $control_id ] = $args;
	}

	/**
	 * Extract settings from control object.
	 *
	 * @param WP_Customize_Control $control_obj The control object.
	 *
	 * @return array|string
	 */
	private function extract_settings( $control_obj ) {
		if ( is_array( $control_obj->settings ) ) {
			$settings = array();
			foreach ( $control_obj->settings as $key => $setting ) {
				$settings[ $key ] = is_object( $setting ) ? $setting->id : $setting;
			}
			return $settings;
		}
		return is_object( $control_obj->settings ) ? $control_obj->settings->id : $control_obj->settings;
	}

	/**
	 * Handle the active_callback logic for controls.
	 *
	 * @param WP_Customize_Control $control_obj The control object.
	 * @param array                $args        The control arguments array (passed by reference).
	 */
	private function handle_active_callback( $control_obj, &$args ) {
		if ( ! isset( $control_obj->active_callback ) ) {
			return;
		}

		$active_callback = null;
		if ( is_string( $control_obj->active_callback ) ) {
			$active_callback = $control_obj->active_callback;
		} elseif ( is_array( $control_obj->active_callback ) && isset( $control_obj->active_callback[1] ) ) {
			$active_callback = is_string( $control_obj->active_callback[1] ) ? $control_obj->active_callback[1] : null;
		}

		if ( null !== $active_callback && 'active_callback' !== $active_callback ) {
			$args['active_callback'] = $active_callback;
		}
	}

	/**
	 * Handle active_callback for array-based controls.
	 *
	 * @param array $args The control arguments array (passed by reference).
	 */
	private function handle_active_callback_array( &$args ) {
		if ( ! isset( $args['active_callback'] ) ) {
			return;
		}

		if ( is_array( $args['active_callback'] ) && isset( $args['active_callback'][1] ) ) {
			$args['active_callback'] = is_string( $args['active_callback'][1] ) ? $args['active_callback'][1] : null;
		} elseif ( ! is_string( $args['active_callback'] ) ) {
			unset( $args['active_callback'] );
			return;
		}

		if ( null === $args['active_callback'] || 'active_callback' === $args['active_callback'] ) {
			unset( $args['active_callback'] );
		}
	}

	/**
	 * Get all registered controls.
	 *
	 * @return array Array of registered controls with only necessary fields.
	 */
	public function get_controls() {
		return $this->controls;
	}
}

// Global instance.
global $cosmoswp_customize_control;
$cosmoswp_customize_control = new CosmosWP_Customize_Control();
