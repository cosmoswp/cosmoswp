<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Customizer  Builder
 *
 * @package CosmosWP
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'cosmoswp_customizer_builder_sanitize_field_recursive' ) ) :

	/**
	 * Recursively sanitize values for the Customizer fields.
	 *
	 * This function ensures that any non-array values are sanitized using `wp_kses_post`,
	 * while recursively sanitizing all array values. This is useful when sanitizing multiple
	 * fields in the Customizer with potentially nested values.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param mixed $value The value to sanitize, can be a string or an array of values.
	 * @return mixed Sanitized value, either a string or an array.
	 */
	function cosmoswp_customizer_builder_sanitize_field_recursive( $value ) {

		// If the value is not an array, sanitize it as a string.
		if ( ! is_array( $value ) ) {
			$value = wp_kses_post( $value );
		} elseif ( is_array( $value ) ) {
			// If the value is an array, recursively sanitize each item.
			foreach ( $value as $k => $v ) {
				$value[ $k ] = cosmoswp_customizer_builder_sanitize_field_recursive( $v );
			}
		}

		// Return the sanitized value (string or array).
		return $value;
	}

endif;

if ( ! function_exists( 'cosmoswp_customizer_builder_sanitize_field' ) ) :

	/**
	 * Sanitize the Customizer field input.
	 *
	 * This function unslashes the input, decodes it if it is a string (using JSON decoding),
	 * and recursively sanitizes it using `cosmoswp_customizer_builder_sanitize_field_recursive`.
	 * After sanitizing, it encodes the sanitized output into a JSON string.
	 *
	 * @since CosmosWP 1.0.0
	 *
	 * @param mixed $input The input to sanitize.
	 * @return string The sanitized output as a JSON-encoded string.
	 */
	function cosmoswp_customizer_builder_sanitize_field( $input ) {

		// Unscrambling slashed characters from the input.
		$input = wp_unslash( $input );

		// If the input is not an array, attempt to decode it from a JSON string.
		if ( ! is_array( $input ) ) {
			$input = json_decode( urldecode_deep( $input ), true );
		}

		// Recursively sanitize the field input.
		$output = cosmoswp_customizer_builder_sanitize_field_recursive( $input );

		// JSON encode the sanitized output before returning.
		$output = wp_json_encode( $output );

		// Return the sanitized and encoded output.
		return $output;
	}

endif;


/**
 * Add Builder to WP Customize
 *
 * Class CosmosWP_Customizer_Builder
 */
class CosmosWP_Customizer_Builder {

	/**
	 * Main Instance
	 *
	 * Insures that only one instance of CosmosWP_Customizer_Builder exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return object
	 */
	public static function instance() {

		static $instance = null;

		if ( null === $instance ) {
			$instance = new CosmosWP_Customizer_Builder();
		}

		return $instance;
	}

	/**
	 * Run functionality with hooks
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return void
	 */
	public function run() {

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'builder_template' ) );
	}

	/**
	 * Get all builders registered.
	 *
	 * Insures that every builder is registered by cosmoswp_builders filter
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return array
	 */
	public function get_builders() {
		$builders = array();
		$builders = apply_filters( 'cosmoswp_builders', $builders );
		return $builders;
	}

	/**
	 * Callback functions for customize_controls_enqueue_scripts,
	 * Enqueue script and style for builder
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return void
	 */
	public function enqueue() {

		wp_enqueue_script(
			'customizer-builder',
			COSMOSWP_URL . '/build/customizer/builder/index.js',
			array(
				'customize-controls',
				'jquery-ui-resizable',
				'jquery-ui-droppable',
				'jquery-ui-draggable',
			),
			COSMOSWP_VERSION,
			true
		);

		wp_localize_script(
			'customizer-builder',
			'CosmosWP_Customizer_Builder',
			array(
				'footer_moved_widgets_text' => '',
				'builders'                  => $this->get_builders(),
				'is_rtl'                    => is_rtl(),
				'desktop_label'             => esc_html__( 'Desktop', 'cosmoswp' ),
				'mobile_tablet_label'       => esc_html__( 'Mobile/Tablet', 'cosmoswp' ),
			)
		);
	}

	/**
	 * Callback functions for customize_controls_print_footer_scripts,
	 * Add Builder Template
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return void
	 */
	public function builder_template() {
		?>
		<script type="text/html" id="tmpl-cosmoswp-builder-panel">
			<div class="cwp-czr-bldr at-pos at-bg-cl at-trs at-tf at-w at-max-w">
				<div class="cwp-czr-bldr--inner">
					<div class="cwp-czr-bldr--hdr at-flx at-al-itm-ctr at-p at-bdr">
						<div class="cwp-czr-bldr--devs-swch at-flx at-pos"></div>
						<div class="cwp-czr-bldr--actions at-pos">
							<a class="button button-secondary cwp-czr-bldr--btn-close" href="#">
								<span class="close-text"><?php esc_html_e( 'Close', 'cosmoswp' ); ?></span>
								<span class="panel-name-text at-d-non">{{ data.title }}</span>
							</a>
						</div>
					</div>
					<div class="cwp-czr-bldr--body at-bg-cl at-p"></div>
				</div>
			</div>
		</script>

		<script type="text/html" id="tmpl-cosmoswp-cb-panel">
			<# if ( data.device != 'all' ) { #>
				<div class="cwp-czr-bldr--cont at-flx at-flx-col at-gap at-w at-trs">
					<# if ( ! _.isUndefined( data.rows.top ) ) { #>
					<div class="cwp-czr-bldr--row-t cwp-czr-bldr--row at-p at-bdr at-bdr-rad at-pos" data-id="{{ data.id }}_top">
						<div class="cwp-czr-bldr--row-inner at-pos at-p">
							<div class="cwp-czr-bldr--grid-row at-flx at-pos at-w">
								<?php
								for ( $i = 1; $i <= 12; $i++ ) {
									echo '<div class="cwp-czr-bldr--grid-col at-bdr at-w"></div>';
								}
								?>
							</div>
							<div class="cwp-czr-bldr-itms cwp-czr-bldr--grid-stk at-min-h at-pos" data-id="top"></div>
						</div>
						<a class="cwp-czr-bldr--row-settings at-bg-cl at-pos at-w at-cl at-bdr at-flx at-jfy-cont-ctr" title="{{ data.rows.top }}" data-id="top" href="#"></a>
					</div>
					<#  } #>

					<# if ( ! _.isUndefined( data.rows.main ) ) { #>
					<div class="cwp-czr-bldr--row-m cwp-czr-bldr--row at-p at-bdr at-bdr-rad at-pos" data-id="{{ data.id }}_main">
						<div class="cwp-czr-bldr--row-inner at-pos at-p">
							<div class="cwp-czr-bldr--grid-row at-flx at-pos at-w">
								<?php
								for ( $i = 1; $i <= 12; $i++ ) {
									echo '<div class="cwp-czr-bldr--grid-col at-bdr at-w"></div>';
								}
								?>
							</div>
							<div class="cwp-czr-bldr-itms cwp-czr-bldr--grid-stk at-min-h at-pos" data-id="main"></div>
						</div>
						<a class="cwp-czr-bldr--row-settings at-bg-cl at-pos at-w at-cl at-bdr at-flx at-jfy-cont-ctr" title="{{ data.rows.main }}" data-id="main" href="#"></a>
					</div>
					<#  } #>

					<# if ( ! _.isUndefined( data.rows.bottom ) ) { #>
					<div class="cwp-czr-bldr--row-b cwp-czr-bldr--row at-p at-bdr at-bdr-rad at-pos" data-id="{{ data.id }}_bottom">
						<div class="cwp-czr-bldr--row-inner at-pos at-p">
							<div class="cwp-czr-bldr--grid-row at-flx at-pos at-w">
								<?php
								for ( $i = 1; $i <= 12; $i++ ) {
									echo '<div class="cwp-czr-bldr--grid-col at-bdr at-w"></div>';
								}
								?>
							</div>
							<div class="cwp-czr-bldr-itms cwp-czr-bldr--grid-stk at-min-h at-pos" data-id="bottom"></div>
						</div>
						<a class="cwp-czr-bldr--row-settings at-bg-cl at-pos at-w at-cl at-bdr at-flx at-jfy-cont-ctr" title="{{ data.rows.bottom }}" data-id="bottom" href="#"></a>
					</div>
					<#  } #>
				</div>
			<# } #>

			<# if ( data.device == 'all' ) { #>
				<# if ( ! _.isUndefined( data.rows.sidebar ) ) { #>
					<div class="cwp-czr-bldr--sidebar at-w">
						<div class="cwp-czr-bldr--row-b cwp-czr-bldr--row at-p at-bdr at-bdr-rad at-pos" data-id="{{ data.id }}_sidebar">
							<div class="cwp-czr-bldr--row-inner at-pos at-p">
								<div class="cwp-czr-bldr-itms at-min-h at-pos cosmoswp-sidebar-items" data-id="sidebar"></div>
							</div>
							<a class="cwp-czr-bldr--row-settings at-bg-cl at-pos at-w at-cl at-bdr at-flx at-jfy-cont-ctr" title="{{ data.rows.sidebar }}" data-id="sidebar" href="#"></a>
						</div>
						<p class="info"><?php esc_html_e( 'Menu Icon Sidebar will display when Menu Icon is clicked on frontend', 'cosmoswp' ); ?></p>
					</div>
				<# } #>
			<# } #>
			<button type="button" class="at-btn cwp-czr-bldr--add-btn at-p at-m at-bdr at-bdr-rad at-d-non at-md-inl-blk at-box-sdw">
				<span class="dashicons dashicons-plus at-tf at-tf-org at-trs"></span>
				<?php esc_html_e( ' Add a Item', 'cosmoswp' ); ?>
			</button>
		</script>

		<script type="text/html" id="tmpl-cosmoswp-cb-item">
			<div class="cwp-czr-bldr--grid-stk-itm at-h at-pos at-m item-from-list for-s-{{ data.section }}"
				title="{{ data.name }}"
				data-id="{{ data.id }}"
				data-section="{{ data.section }}"
				data-control="{{ data.control }}"
				data-gs-x="{{ data.x }}"
				data-gs-y="{{ data.y }}"
				data-gs-width="{{ data.width }}"
				data-df-width="{{ data.width }}"
				data-gs-height="1"
			>
				<div class="cwp-czr-bldr--grid-stk-itm-cont at-bg-cl at-flx at-al-itm-ctr at-pos at-bdr at-bdr-rad at-gap at-p at-ovf at-cur">
					<i class="cwp-czr-bldr--grid-stk-itm-icon-base cwp-czr-bldr--grid-stk-itm-icon at-trs at-w at-tf
					<# if ( data.icon ) { #>
							{{ data.icon }}
					<# }
					else { #>
							dashicons dashicons-info
					<# }#>
					"></i>
					<div class="cwp-czr-bldr--grid-stk-itm-ttl-wrp at-m">
						<h3 class="cwp-czr-bldr--grid-stk-itm-ttl at-txt at-txt-ovf at-ovf" data-section="{{ data.section }}">{{ data.name }}</h3>
						<# if ( data.desc ) { #>
							<span class="cwp-czr-bldr--grid-stk-itm-desc">{{ data.desc }}</span>
						<# } #>
					</div>
					
					<span class="cwp-czr-bldr--grid-stk-itm-icon-set at-btn at-btn-light at-bdr-rad at-opa cwp-czr-bldr--grid-stk-itm-icon" data-section="{{ data.section }}"><i class="dashicons dashicons-admin-generic at-h at-w"></i></span>
					<span class="cwp-czr-bldr--grid-stk-itm-icon-del at-btn at-btn-danger at-bdr-rad at-opa cwp-czr-bldr--grid-stk-itm-icon"><i class="dashicons dashicons-trash at-w at-h"></i></span>
				</div>
			</div>
		</script>
		<?php
	}
}

if ( ! function_exists( 'cosmoswp_customizer_builder' ) ) {

	function cosmoswp_customizer_builder() {//phpcs:ignore
		return CosmosWP_Customizer_Builder::instance();
	}
	cosmoswp_customizer_builder()->run();
}
