<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Post Builder and Customizer Options
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_Post_Builder' ) ) :
	/**
	 * Post Builder and Customizer Options
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Post_Builder {

		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp-post';

		/**
		 * Section ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $section = 'cosmoswp-post';


		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_Post_Builder exists in memory at any one
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
				$instance = new CosmosWP_Post_Builder();
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

			add_filter( 'cosmoswp_default_theme_options', array( $this, 'post_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 100 );
			add_action( 'cosmoswp_action_single_post', array( $this, 'display_post' ), 100, 1 );
			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ), 100 );
			add_filter( 'body_class', array( $this, 'add_body_class' ) );

			add_action( 'cosmoswp_single_post_loop_item', array( $this, 'single_post_loop_item' ) );
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
		public function post_defaults( $default_options = array() ) {

			$post_defaults = array(

				/*Sidebar*/
				'post-sidebar'                        => 'ct-ps',

				/*post sorting*/
				'post-elements-sorting'               => array( 'title', 'featured-section', 'primary-meta', 'content' ),
				'post-elements-sorting-without-title' => array( 'featured-section', 'primary-meta', 'content' ),
				'post-primary-meta-sorting'           => array( 'published-date', 'categories', 'author', 'comments' ),
				'post-secondary-meta-sorting'         => '',

				/*excerpt*/
				'post-excerpt-length'                 => '',

				/*post feature Section */
				'post-feature-section-layout'         => 'full-image',
				'post-img-size'                       => 'full',

				/*post navigation*/
				'post-navigation-options'             => 'default',
				'post-pagination-color-options'       => wp_json_encode(
					array(
						'next-prev-color'       => '#999',
						'next-prev-hover-color' => '#444',
						'text-color'            => '#275cf6',
						'text-hover-color'      => '#1949d4',
					)
				),
				'post-main-content-margin'            => '',
				'post-main-content-padding'           => wp_json_encode(
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
			return array_merge( $default_options, $post_defaults );
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

			$post_defaults = $this->post_defaults();

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				$this->panel,
				array(
					'title'    => esc_html__( 'Post Options', 'cosmoswp' ),
					'priority' => 70,
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

			/*Post customizer Layout*/
			require cosmoswp_file_directory( 'inc/customizer/post-options/main-content.php' );
		}

		/**
		 * Callback Function for cosmoswp_action_post
		 * Display Post Content
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param integer $post_id Post ID.
		 * @return void.
		 */
		public function display_post( $post_id = 0 ) {
			if ( ! $post_id ) {
				$post_id = get_the_ID();
			}
			$sidebar = cosmoswp_get_theme_options( 'post-sidebar' );
			?>
			<!-- Start of .blog-content-->
			<div class="cwp-page cwp-single-post cwp-content-wrapper <?php echo esc_attr( 'cwp-' . $sidebar ); ?> <?php cosmoswp_post_main_wrap_classes(); ?>" id="cwp-post-main-content-wrapper">
				<?php
				echo '<div class="grid-container"><div class="grid-row">';
				cosmoswp_sidebar_template( $sidebar, 'post' );
				echo '</div>';/*.grid-row*/
				echo '</div>';/*.grid-container*/
				?>
				<?php do_action( 'cosmoswp_action_after_post_inside_wrap', $post_id ); ?>
			</div>
			<!-- End of .blog-content -->
			<?php
		}

		/**
		 * Add post related classes to body
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $classes Body classes.
		 * @return array
		 */
		public function add_body_class( $classes ) {
			if ( ! is_single() ) {
				return $classes;
			}
			$sidebar = cosmoswp_get_theme_options( 'post-sidebar' );
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

			require cosmoswp_file_directory( 'inc/customizer/post-options/dynamic-css.php' );
			if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
				$all_css = array_merge_recursive( $dynamic_css, $post_dynamic_css );
				return $all_css;
			} else {
				return $post_dynamic_css;
			}
		}

		/**
		 * Callback functions for cosmoswp_single_post_loop_item,
		 * Add Single Post Item
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function single_post_loop_item() {
			get_template_part( 'template-parts/loop/post', 'default' );
		}

		/**
		 * Partial for post main content
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return String
		 */
		public function cosmoswp_customize_partial_post_main_content() {
			ob_start();
			$this->display_post();
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
				'selector'            => '#cwp-post-main-content-wrapper',
				'render_callback'     => array( $this, 'cosmoswp_customize_partial_post_main_content' ),
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
 * Create Instance for CosmosWP_Post_Builder
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_post_builder' ) ) {

	function cosmoswp_post_builder() {//phpcs:ignore
		return CosmosWP_Post_Builder::instance();
	}

	cosmoswp_post_builder()->run();
}
