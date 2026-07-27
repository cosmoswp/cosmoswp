<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Page Builder and Customizer Options
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_Page_Builder' ) ) :
	/**
	 * Page Builder and Customizer Options
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Page_Builder {

		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp-page';

		/**
		 * Section ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $section = 'cosmoswp-page';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_Page_Builder exists in memory at any one
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
				$instance = new CosmosWP_Page_Builder();
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

			add_filter( 'cosmoswp_default_theme_options', array( $this, 'page_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 100 );
			add_action( 'cosmoswp_action_page', array( $this, 'display_page' ), 100 );
			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ), 999 );

			add_filter( 'body_class', array( $this, 'add_body_class' ) );
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
		public function page_defaults( $default_options = array() ) {
			$page_defaults = array(

				/*Sidebar*/
				'page-sidebar'                        => 'ct-ps',

				/*page Sorting*/
				'page-elements-sorting-with-title'    => array( 'title', 'featured-section', 'content' ),
				'page-elements-sorting-without-title' => array( 'featured-section', 'content' ),
				'page-primary-meta-sorting'           => array( 'published-date', 'author', 'comments' ),
				'page-secondary-meta-sorting'         => '',

				/*excerpt*/
				'page-excerpt-length'                 => '',

				/*page feature Section */
				'page-feature-section-layout'         => 'full-image',
				'page-img-size'                       => 'full',

				/*margin and padding*/
				'page-main-content-margin'            => '',
				'page-main-content-padding'           => wp_json_encode(
					array(
						'desktop' => array(
							'top'    => '80',
							'right'  => '0',
							'bottom' => '80',
							'left'   => '0',
						),
						'tablet'  => array(
							'top'    => '40',
							'right'  => '0',
							'bottom' => '60',
							'left'   => '0',
						),
						'mobile'  => array(
							'top'    => '20',
							'right'  => '0',
							'bottom' => '40',
							'left'   => '0',
						),
					)
				),
			);

			return array_merge( $default_options, $page_defaults );
		}

		/**
		 * Callback functions for customize_register,
		 * Add Panel Section control
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param object $wp_customize WordPress Customizer object.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			$page_defaults = $this->page_defaults();

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				$this->panel,
				array(
					'title'    => esc_html__( ' Page Options', 'cosmoswp' ),
					'priority' => 60,
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

			/* Page Elements */
			require cosmoswp_file_directory( 'inc/customizer/page-options/main-content.php' );
		}

		/**
		 * Callback Function for cosmoswp_action_page
		 * Display Page Content
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function display_page() {
			$sidebar = cosmoswp_get_theme_options( 'page-sidebar' );
			?>
			<!-- Start of .blog-content-->
			<div class="cwp-page cwp-content-wrapper <?php echo esc_attr( 'cwp-' . $sidebar ); ?> <?php cosmoswp_blog_main_wrap_classes(); ?>" id="cwp-blog-main-content-wrapper">
				<?php
				echo '<div class="grid-container"><div class="grid-row">';
				cosmoswp_sidebar_template( $sidebar, 'page' );
				echo '</div>';/*.grid-row*/
				echo '</div>';/*.grid-container*/
				?>
			</div>
			<!-- End of .blog-content -->
			<?php
		}


		/**
		 * Add page related classes to body
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $classes array Body classes.
		 * @return array
		 */
		public function add_body_class( $classes ) {
			if ( ! is_page() ) {
				return $classes;
			}
			$sidebar = cosmoswp_get_theme_options( 'page-sidebar' );
			if ( 'ful-ct' === $sidebar || 'middle-ct' === $sidebar ) {
				$classes[] = 'cwp-main-content-only';
			}

			return $classes;
		}

		/**
		 * Callback functions for cosmoswp_dynamic_css,
		 * Add Dynamic Css
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $dynamic_css Dynamic CSS.
		 * @return array
		 */
		public function dynamic_css( $dynamic_css ) {

			$main_content_dynamic_css['all']     = '';
			$main_content_dynamic_css['tablet']  = '';
			$main_content_dynamic_css['desktop'] = '';
			/*Page Css*/
			$page_main_content_css         = '';
			$page_main_content_tablet_css  = '';
			$page_main_content_desktop_css = '';

			/* margin */
			$main_content_margin = cosmoswp_get_theme_options( 'page-main-content-margin' );
			$main_content_margin = json_decode( $main_content_margin, true );
			// desktop .
			$main_content_margin_desktop = cosmoswp_cssbox_values_inline( $main_content_margin, 'desktop' );
			if ( strpos( $main_content_margin_desktop, 'px' ) !== false ) {
				$page_main_content_desktop_css .= 'margin:' . $main_content_margin_desktop . ';';
			}
			// tablet margin.
			$main_content_margin_tablet = cosmoswp_cssbox_values_inline( $main_content_margin, 'tablet' );
			if ( strpos( $main_content_margin_tablet, 'px' ) !== false ) {
				$page_main_content_tablet_css .= 'margin:' . $main_content_margin_tablet . ';';
			}
			// mobile margin.
			$main_content_margin_mobile = cosmoswp_cssbox_values_inline( $main_content_margin, 'mobile' );
			if ( strpos( $main_content_margin_mobile, 'px' ) !== false ) {
				$page_main_content_css .= 'margin:' . $main_content_margin_mobile . ';';
			}

			/* padding */
			$main_content_padding = cosmoswp_get_theme_options( 'page-main-content-padding' );
			$main_content_padding = json_decode( $main_content_padding, true );

			// desktop padding.
			$main_content_padding_desktop = cosmoswp_cssbox_values_inline( $main_content_padding, 'desktop' );
			if ( strpos( $main_content_padding_desktop, 'px' ) !== false ) {
				$page_main_content_desktop_css .= 'padding:' . $main_content_padding_desktop . ';';
			}
			// tablet padding.
			$main_content_padding_tablet = cosmoswp_cssbox_values_inline( $main_content_padding, 'tablet' );
			if ( strpos( $main_content_padding_tablet, 'px' ) !== false ) {
				$page_main_content_tablet_css .= 'padding:' . $main_content_padding_tablet . ';';
			}

			// mobile padding.
			$main_content_padding_mobile = cosmoswp_cssbox_values_inline( $main_content_padding, 'mobile' );
			if ( strpos( $main_content_padding_mobile, 'px' ) !== false ) {
				$page_main_content_css .= 'padding:' . $main_content_padding_mobile . ';';
			}

			/* mobile css */
			if ( ! empty( $page_main_content_css ) ) {
				$main_content_mobile_dynamic_css  = '.cwp-page.cwp-content-wrapper{' . $page_main_content_css . '}';
				$main_content_dynamic_css['all'] .= $main_content_mobile_dynamic_css;
			}

			/* tablet css */
			if ( ! empty( $page_main_content_tablet_css ) ) {
				$main_content_tablet_dynamic_css     = '.cwp-page.cwp-content-wrapper{' . $page_main_content_tablet_css . '}';
				$main_content_dynamic_css['tablet'] .= $main_content_tablet_dynamic_css;
			}

			/* desktop css  */
			if ( ! empty( $page_main_content_desktop_css ) ) {
				$main_content_desktop_dynamic_css     = '.cwp-page.cwp-content-wrapper{' . $page_main_content_desktop_css . '}';
				$main_content_dynamic_css['desktop'] .= $main_content_desktop_dynamic_css;
			}

			if ( is_array( $main_content_dynamic_css ) && ! empty( $main_content_dynamic_css ) ) {
				if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
					$all_css = array_merge_recursive( $dynamic_css, $main_content_dynamic_css );
					return $all_css;
				}
			} else {
				return $dynamic_css;
			}
		}

		/**
		 * Partial refresh for page main content.,
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return String
		 */
		public function cosmoswp_customize_partial_page_main_content() {
			ob_start();
			$this->display_page();
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
				'selector'            => '#cosmoswp-page-main-content-wrapper',
				'render_callback'     => array( $this, 'cosmoswp_customize_partial_page_main_content' ),
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
	}

endif;

/**
 * Create Instance for CosmosWP_Page_Builder
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_page_builder' ) ) {

	function cosmoswp_page_builder() {//phpcs:ignore
		return CosmosWP_Page_Builder::instance();
	}

	cosmoswp_page_builder()->run();
}
