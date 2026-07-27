<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * WooCommerce Single Customizer Options
 *
 * @package CosmosWP
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Single Customizer Options
 *
 * @package CosmosWP
 */

if ( ! class_exists( 'CosmosWP_WooCommerce_Single' ) ) :

	/**
	 * WooCommerce Single Customizer Options
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_WooCommerce_Single {


		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp-woocommerce-single';

		/**
		 * Section ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $section = 'cosmoswp-woocommerce-single';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_WooCommerce_Single exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @return object
		 * @since    1.0.0
		 * @access   public
		 */
		public static function instance() {

			static $instance = null;

			if ( null === $instance ) {
				$instance = new CosmosWP_WooCommerce_Single();
			}

			return $instance;
		}

		/**
		 *  Run functionality with hooks
		 *
		 * @return void
		 * @since    1.0.0
		 * @access   public
		 */
		public function run() {

			add_filter( 'cosmoswp_default_theme_options', array( $this, 'defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 100 );

			add_action( 'cosmoswp_action_woocommerce_single', array( $this, 'display_woo_single' ), 110 );

			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ), 100 );

			add_filter( 'cosmoswp_customize_css_refresher', array( $this, 'add_css_refresher' ) );
		}

		/**
		 * Callback functions for cosmoswp_default_theme_options,
		 * Add Header Builder defaults values
		 *
		 * @param array $default_options Default Options.
		 * @return array
		 * @since    1.0.0
		 * @access   public
		 */
		public function defaults( $default_options = array() ) {
			$defaults = array(

				/*Sidebar*/
				'cwp-woo-single-sidebar'              => 'ct-ps',

				'cwc-single-tab-show-content-heading' => '',
				'cwc-single-upsell-number'            => 4,
				'cwc-single-related-number'           => 4,
				'cwc-single-tab-design'               => 'default',
				'cwc-single-upsell-col'               => 4,
				'cwc-single-related-col'              => 4,
				'cwc-single-elements'                 => array( 'title', 'rating', 'price', 'excerpt', 'cart', 'metadata' ),
				'cwc-single-media-width'              => wp_json_encode(
					array(
						'desktop' => '40',
						'tablet'  => '40',
						'mobile'  => '100',
					)
				),

			);

			return array_merge( $default_options, $defaults );
		}

		/**
		 * Callback functions for customize_register,
		 * Add Panel Section control
		 *
		 * @param object $wp_customize WordPress customizer object.
		 * @return void
		 * @since    1.0.0
		 * @access   public
		 */
		public function customize_register( $wp_customize ) {
			$defaults = $this->defaults();

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				$this->panel,
				array(
					'title'    => esc_html__( 'WooCommerce Single', 'cosmoswp' ),
					'priority' => 120,
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				$this->section,
				array(
					'title'    => esc_html__( ' Main Content', 'cosmoswp' ),
					'priority' => 230,
					'panel'    => $this->panel,
				)
			);

			/* WOO Single Elements */
			require COSMOSWP_PATH . '/inc/addons/woocommerce/single/main-content.php';
		}

		/**
		 * Callback Function for cosmoswp_action_woocommerce_single
		 * Display WooCommerce Single Product
		 *
		 * @return void
		 * @since    1.0.0
		 * @access   public
		 */
		public function display_woo_single() {
			$sidebar = cosmoswp_get_theme_options( 'cwp-woo-single-sidebar' );
			?>
			<!-- Start of .blog-content-->
			<div class="cwp-page cwp-content-wrapper <?php echo esc_attr( 'cwp-' . $sidebar ); ?> <?php cosmoswp_blog_main_wrap_classes(); ?>"
				id="cwp-woo-single-main-content-wrapper">
				<?php
				echo '<div class="grid-container"><div class="grid-row">';
				cosmoswp_sidebar_template( $sidebar, 'cwp-woo-single' );
				echo '</div>';/*.grid-row*/
				echo '</div>';/*.grid-container*/
				?>
			</div>
			<!-- End of .blog-content -->
			<?php
		}

		/**
		 * Callback functions for cosmoswp_dynamic_css,
		 * Add Dynamic Css
		 *
		 * @param array $dynamic_css Dynamic CSS.
		 * @return array
		 * @since    1.0.9
		 * @access   public
		 */
		public function dynamic_css( $dynamic_css ) {
			/**
			 * Blog Option Dynamic CSS
			 */
			$woo_dynamic_css = array(
				'all'     => '',
				'tablet'  => '',
				'desktop' => '',
			);

			$woo_main_content_css                   = '';
			$woo_single_summary_content_css         = '';
			$woo_main_content_tablet_css            = '';
			$woo_single_summary_content_tablet_css  = '';
			$woo_main_content_desktop_css           = '';
			$woo_single_summary_content_desktop_css = '';

			$cwc_single_media_width = cosmoswp_get_theme_options( 'cwc-single-media-width' );
			$cwc_single_media_width = json_decode( $cwc_single_media_width, true );

			if ( isset( $cwc_single_media_width['mobile'] ) ) {
				$woo_main_content_css           .= 'width:' . $cwc_single_media_width['mobile'] . '%;';
				$woo_single_summary_content_css .= 100 === $cwc_single_media_width['mobile'] ? 'width:100%;' : 'width:calc(100% - ' . $cwc_single_media_width['mobile'] . '%);';
				$woo_dynamic_css['all']         .= '.woocommerce div.product div.images{
                    ' . $woo_main_content_css . '
                }';
				$woo_dynamic_css['all']         .= '.cwp-single-summary-content{
                ' . $woo_single_summary_content_css . '
                }';
			}
			if ( isset( $cwc_single_media_width['tablet'] ) ) {
				$woo_main_content_tablet_css           .= 'width:' . $cwc_single_media_width['tablet'] . '%;';
				$woo_single_summary_content_tablet_css .= 100 === $cwc_single_media_width['tablet'] ? 'width:100%;' : 'width:calc(100% - ' . $cwc_single_media_width['tablet'] . '% - 40px);';

				$woo_dynamic_css['tablet'] .= '.woocommerce div.product div.images{
                    ' . $woo_main_content_tablet_css . '
                }';
				$woo_dynamic_css['tablet'] .= '.cwp-single-summary-content{
                ' . $woo_single_summary_content_tablet_css . '
                }';
			}
			if ( isset( $cwc_single_media_width['desktop'] ) ) {
				$woo_main_content_desktop_css           .= 'width:' . $cwc_single_media_width['desktop'] . '%;';
				$woo_single_summary_content_desktop_css .= 100 === $cwc_single_media_width['desktop'] ? 'width:100%;' : 'width:calc(100% - ' . $cwc_single_media_width['desktop'] . '% - 40px);';

				$woo_dynamic_css['desktop'] .= '.woocommerce div.product div.images{
                    ' . $woo_main_content_desktop_css . '
                }';
				$woo_dynamic_css['desktop'] .= '.cwp-single-summary-content{
                ' . $woo_single_summary_content_desktop_css . '
                }';
			}

			if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
				$all_css = array_merge_recursive( $dynamic_css, $woo_dynamic_css );
				return $all_css;
			} else {
				return $woo_dynamic_css;
			}
		}

		/**
		 * Partial refreshment.
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return String
		 */
		public function partial_content() {
			ob_start();
			$this->display_woo_single();
			$value = ob_get_clean();
			return $value;
		}

		/**
		 * Add selective refresh for the blog main content.
		 *
		 * @param WP_Customize_Manager $wp_customize The customizer manager.
		 * @param string               $control_id The control ID.
		 * @param array                $args Additional arguments.
		 */
		public function add_selective_refresh( $wp_customize, $control_id, $args = array() ) {
			$defaults = array(
				'selector'            => '#cwp-woo-single-main-content-wrapper',
				'render_callback'     => array( $this, 'partial_content' ),
				'container_inclusive' => false,
				'fallback_refresh'    => false,
			);

			$args = wp_parse_args( $args, $defaults );

			$wp_customize->selective_refresh->add_partial(
				$control_id,
				array(
					'selector'            => $args['selector'],
					'render_callback'     => $args['render_callback'],
					'container_inclusive' => $args['container_inclusive'],
					'fallback_refresh'    => $args['fallback_refresh'],
				)
			);
		}

		/**
		 * Callback functions for cosmoswp_customize_css_refresher,
		 * Add CSS refresher settings
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $css_refresher CSS refresher.
		 * @return array
		 */
		public function add_css_refresher( $css_refresher ) {
			$all_settings = array_keys( $this->defaults() );

			$css_settings = cosmoswp_get_settings_by_type( $all_settings, 'css', array( 'width' ) );
			return array_unique( array_merge( $css_refresher, $css_settings ) );
		}
	}
endif;

/**
 * Create Instance for CosmosWP_WooCommerce_Single
 *
 * @param
 * @return object
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'cosmoswp_woocommerce_single' ) ) {

	function cosmoswp_woocommerce_single() {//phpcs:ignore

		return CosmosWP_WooCommerce_Single::instance();
	}

	cosmoswp_woocommerce_single()->run();
}
