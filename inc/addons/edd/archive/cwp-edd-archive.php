<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Edd Archive Customizer Options
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_Edd_Archive' ) ) :

	/**
	 * Customizer EDD Archive page Customization..
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Edd_Archive {

		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp-edd-archive';

		/**
		 * Section ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $section = 'cosmoswp-edd-archive';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_Edd_Archive exists in memory at any one
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
				$instance = new CosmosWP_Edd_Archive();
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

			add_action( 'cosmoswp_action_edd_archive', array( $this, 'display_edd_archive' ), 100 );

			add_action( 'cosmoswp_customize_partial_page_header_setting', array( $this, 'customize_page_header_partial' ) );
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

				/* product catalog options */
				'edd-show-downloads-per-row'   => wp_json_encode(
					array(
						'desktop' => '4',
						'tablet'  => '3',
						'mobile'  => '1',
					)
				),

				/*Sidebar*/
				'cwp-edd-archive-sidebar'      => 'ct-ps',

				'edd-archive-show-grid-list'   => 1,

				'edd-archive-default-view'     => 'cwp-grid',

				'edd-archive-main-title'       => esc_html__( 'Edd', 'cosmoswp' ),
				'edd-archive-show-sort-bar'    => 1,
				'edd-archive-excerpt-length'   => 9,
				'edd-archive-elements-align'   => 'cwp-text-center',
				'edd-archive-grid-elements'    => array( 'image', 'cats', 'title', 'price', 'cart' ),
				'edd-archive-list-media-width' => wp_json_encode(
					array(
						'desktop' => '40',
						'tablet'  => '40',
						'mobile'  => '100',
					)
				),
				'edd-archive-content-length'   => '',
				'edd-navigation-options'       => 'numeric',

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
		 * @param object $wp_customize WordPress Customizer.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			$defaults = $this->defaults();
			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				$this->panel,
				array(
					'title'    => esc_html__( 'Edd Archive', 'cosmoswp' ),
					'priority' => 150,
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

			/* Edd Elements */
			require COSMOSWP_PATH . '/inc/addons/edd/archive/main-content.php';
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
		public function display_edd_archive() {
			$sidebar = cosmoswp_get_theme_options( 'cwp-edd-archive-sidebar' );
			?>
			<!-- Start of .blog-content-->
			<div class="cwp-page cwp-content-wrapper <?php echo esc_attr( 'cwp-' . $sidebar ); ?> <?php cosmoswp_blog_main_wrap_classes(); ?>" id="cwp-edd-main-content-wrapper">
				<?php
				echo '<div class="grid-container"><div class="grid-row">';
				cosmoswp_sidebar_template( $sidebar, 'cwp-edd-archive' );
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
			$this->display_edd_archive();
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
				'selector'            => '#cwp-edd-main-content-wrapper',
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
		 * Customize Partial Header.
		 *
		 * @param array $output Partially controls.
		 * @since    1.0.2
		 */
		public function customize_page_header_partial( $output ) {

			$cosmoswp_header_settings = array(
				'edd-archive-main-title',
			);

			if ( $output ) {
				return array_merge( $output, $cosmoswp_header_settings );
			}
			return $cosmoswp_header_settings;
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
 * Create Instance for CosmosWP_Edd_Archive
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_edd_archive' ) ) {

	function cosmoswp_edd_archive() {//phpcs:ignore
		return CosmosWP_Edd_Archive::instance();
	}

	cosmoswp_edd_archive()->run();
}
