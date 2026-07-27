<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Archive Customizer Options
 *
 * @package CosmosWP
 */

if ( ! class_exists( 'CosmosWP_WooCommerce_Archive' ) ) :

	/**
	 * WooCommerce Archive Customizer Options
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_WooCommerce_Archive {

		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp-woocommerce-archive';

		/**
		 * Section ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $section = 'cosmoswp-woocommerce-archive';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_WooCommerce_Archive exists in memory at any one
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
				$instance = new CosmosWP_WooCommerce_Archive();
			}

			return $instance;
		}

		/**
		 *  Run functionality with hooks
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function run() {

			add_filter( 'cosmoswp_default_theme_options', array( $this, 'defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 100 );

			add_action( 'cosmoswp_action_woocommerce_archive', array( $this, 'display_woo_archive' ), 110 );

			add_filter( 'cosmoswp_customize_css_refresher', array( $this, 'add_css_refresher' ) );
		}

		/**
		 * Callback functions for cosmoswp_default_theme_options,
		 * Add Header Builder defaults values
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $default_options Default options.
		 * @return array
		 */
		public function defaults( $default_options = array() ) {
			$defaults = array(

				/*Sidebar*/
				'cwp-woo-archive-sidebar'        => 'ct-ps',

				'cwc-archive-show-grid-list'     => 1,

				'cwc-archive-default-view'       => 'grid',

				'cwc-archive-psp-sm'             => 1,
				'cwc-archive-psp-sm-open-text'   => 'Filter »',
				'cwc-archive-psp-sm-close-text'  => 'Close X',

				'cwc-archive-show-result-number' => 1,
				'cwc-archive-show-sort-bar'      => 1,
				'cwc-archive-excerpt-length'     => 9,
				'cwc-archive-elements-align'     => 'cwp-text-center',
				'cwc-archive-elements'           => array( 'image', 'cat', 'title', 'price', 'rating', 'cart' ),
				'cwc-archive-list-media-width'   => wp_json_encode(
					array(
						'desktop' => '40',
						'tablet'  => '40',
						'mobile'  => '40',
					)
				),
				'cwc-archive-responsive-col'     => wp_json_encode(
					array(
						'tab-col'    => 3,
						'mobile-col' => 1,
					)
				),
			);

			return array_merge( $default_options, $defaults );
		}

		/**
		 * Callback functions for customize_register,
		 * Add Panel Section control
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param WP_Customize_Manager $wp_customize WordPress Customizer object.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			$defaults = $this->defaults();

			/*Woo Archive Elements Starts from here*/
			$wp_customize->add_section(
				new CosmosWP_WP_Customize_Section(
					$wp_customize,
					'cosmoswp_woo_panel_elements_separator',
					array(
						'title'    => esc_html__( 'WooCommerce Option', 'cosmoswp' ),
						'priority' => 110,
					)
				)
			);

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				$this->panel,
				array(
					'title'    => esc_html__( 'WooCommerce Archive', 'cosmoswp' ),
					'priority' => 115,
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

			/* Woo Elements */
			require COSMOSWP_PATH . '/inc/addons/woocommerce/archive/main-content.php';
		}

		/**
		 * Callback Function for cosmoswp_action_woocommerce_archive
		 * Display WooCommerce Archive Page/Shop Content
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function display_woo_archive() {
			$sidebar = cosmoswp_get_theme_options( 'cwp-woo-archive-sidebar' );
			?>
			<!-- Start of .blog-content-->
			<div class="cwp-page cwp-content-wrapper <?php echo esc_attr( 'cwp-' . $sidebar ); ?> <?php cosmoswp_blog_main_wrap_classes(); ?>" id="cwp-woo-main-content-wrapper">
				<?php
				echo '<div class="grid-container"><div class="grid-row">';
				cosmoswp_sidebar_template( $sidebar, 'cwp-woo-archive' );
				echo '</div>';/*.grid-row*/
				echo '</div>';/*.grid-container*/
				?>
			</div>
			<!-- End of .blog-content -->
			<?php
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
			$this->display_woo_archive();
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
				'selector'            => '#cwp-woo-main-content-wrapper',
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

			$css_settings = cosmoswp_get_settings_by_type( $all_settings, 'css' );
			return array_unique( array_merge( $css_refresher, $css_settings ) );
		}
	}
endif;

/**
 * Create Instance for CosmosWP_WooCommerce_Archive
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_woocommerce_archive' ) ) {

	function cosmoswp_woocommerce_archive() {//phpcs:ignore
		return CosmosWP_WooCommerce_Archive::instance();
	}

	cosmoswp_woocommerce_archive()->run();
}
