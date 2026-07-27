<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Theme Option Controller.
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_Theme_Options_Controller' ) ) :

	/**
	 * Theme Option Controller.
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Theme_Options_Controller {

		/**
		 * Panel ID, use for theme option
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp_theme_options';

		/**
		 * Breadcrumb_options Sections
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $breadcrumb_options = 'cosmoswp_breadcrumb_options';

		/**
		 * Scroll top Sections
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $scroll_top = 'cosmoswp_scroll_top';


		/**
		 * Search options Sections
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $search_options = 'cosmoswp_search';

		/**
		 * Site layout Sections and Controller ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $sidebar_setting = 'cosmoswp_sidebar_setting';

		/**
		 * Button design Sections and Controller ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $button_design = 'cosmoswp_button_design_option';

		/**
		 * Appearance color Sections and Controller ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $appearance_color = 'cosmoswp_appearance_color';

		/**
		 * Site layout Sections and Controller ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $site_layout = 'cosmoswp-site-layout-options';

		/**
		 * Site layout Sections and Controller ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $sticky_sidebar = 'cosmoswp_design_sidebar_sticky_option';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_Theme_Options_Controller exists in memory at any one
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
				$instance = new CosmosWP_Theme_Options_Controller();
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

			add_filter( 'cosmoswp_default_theme_options', array( $this, 'theme_option_defaults' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 100 );
			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ), 100 );
			add_filter( 'cosmoswp_action_after_footer', array( $this, 'scroll_top_data' ), 100 );
			add_filter( 'cosmoswp_enqueue_google_fonts', array( $this, 'enqueue_google_fonts' ), 1 );
			add_filter( 'body_class', array( $this, 'add_search_template_class' ) );
		}


		/**
		 * Callback functions for cosmoswp_enqueue_google_fonts,
		 * Global Widget Typography
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $google_font_family_array Google font family array.
		 * @return array
		 */
		public function enqueue_google_fonts( $google_font_family_array ) {

			$local_google_fonts = array();

			$widget_title_typography_options = cosmoswp_get_theme_options( 'global-widget-title-typography-options' );
			$widget_title_typography         = cosmoswp_get_theme_options( 'global-widget-title-typography' );
			$widget_title_typography         = json_decode( $widget_title_typography, true );
			$widget_title_font_family        = cosmoswp_font_family( $widget_title_typography );
			if ( 'custom' === $widget_title_typography_options && cosmoswp_is_font_type_google( $widget_title_typography ) ) {
				$local_google_fonts[] = array(
					'family'      => $widget_title_font_family,
					'font-weight' => $widget_title_typography['font-weight'],
				);

			}

			$site_button_typography_options = cosmoswp_get_theme_options( 'site-button-typography-options' );
			$site_button_typography         = cosmoswp_get_theme_options( 'site-button-typography' );
			$site_button_typography         = json_decode( $site_button_typography, true );
			$site_button_font_family        = cosmoswp_font_family( $site_button_typography );
			if ( 'custom' === $site_button_typography_options && cosmoswp_is_font_type_google( $site_button_typography ) ) {
				$local_google_fonts[] = array(
					'family'      => $site_button_font_family,
					'font-weight' => $site_button_typography['font-weight'],
				);
			}

			return array_merge( $google_font_family_array, $local_google_fonts );
		}

		/**
		 * Callback functions for cosmoswp_default_theme_options,
		 * Add theme defaults values
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $default_options Default options.
		 *
		 * @return array
		 */
		public function theme_option_defaults( $default_options = array() ) {

			$theme_option_defaults = array(

				/*button design section */
				'site-button-styling'                      => wp_json_encode(
					array(
						'normal-text-color'       => '#fff',
						'normal-bg-color'         => '#275cf6',
						'normal-border-style'     => 'solid',
						'normal-border-color'     => '#275cf6',
						'normal-border-width'     => array(
							'desktop' => array(
								'top'         => '1',
								'right'       => '1',
								'bottom'      => '1',
								'left'        => '1',
								'cssbox_link' => true,
							),
						),
						'normal-border-radius'    => array(
							'desktop' => array(
								'top'         => '3',
								'right'       => '3',
								'bottom'      => '3',
								'left'        => '3',
								'cssbox_link' => true,
							),
						),
						'normal-box-shadow-color' => '',
						'normal-box-shadow-css'   => array(),
						'hover-text-color'        => '#fff',
						'hover-bg-color'          => '#1949d4',
						'hover-border-style'      => 'solid',
						'hover-border-color'      => '#1949d4',
						'hover-border-width'      => array(
							'desktop' => array(
								'top'         => '1',
								'right'       => '1',
								'bottom'      => '1',
								'left'        => '1',
								'cssbox_link' => true,
							),
						),
						'hover-border-radius'     => array(),
						'hover-box-shadow-color'  => '',
						'hover-box-shadow-css'    => array(),
					)
				),

				'site-button-margin'                       => '',
				'site-button-padding'                      => wp_json_encode(
					array(
						'desktop' => array(
							'top'    => '8',
							'right'  => '16',
							'bottom' => '8',
							'left'   => '16',
						),

					)
				),
				'site-button-typography-options'           => 'custom',
				'site-button-typography'                   => wp_json_encode(
					array(
						'font-type'       => 'google',
						'system-font'     => 'verdana',
						'google-font'     => 'Open Sans',
						'custom-font'     => '',
						'font-weight'     => '400',
						'font-style'      => 'normal',
						'text-decoration' => 'none',
						'text-transform'  => 'none',
						'font-size'       => array(

							'mobile' => '14',
						),
						'line-height'     => array(

							'mobile' => '20',
						),
						'letter-spacing'  => array(

							'mobile' => '1',
						),
					)
				),

				/* global sidebar*/
				'global-sidebar-padding'                   => '',
				'global-sidebar-background-options'        => wp_json_encode(
					array(
						'background-color' => '',
					)
				),
				'global-widget-link-color'                 => '#40454a',

				/* widget styling*/
				'global-widget-content-align'              => 'cwp-text-left',
				'global-widget-content-color'              => '',
				'global-widget-content-margin'             => '',

				'global-widget-content-padding'            => '`',

				'global-widget-content-border-styling'     => wp_json_encode(
					array(
						'border-style' => 'none',
						'border-color' => '',
						'border-width' => array(),
					)
				),

				'global-widget-content-typography-options' => 'inherit',
				'global-widget-content-typography'         => wp_json_encode(
					array(
						'font-type'       => 'google',
						'system-font'     => 'verdana',
						'google-font'     => 'Open Sans',
						'custom-font'     => '',
						'font-weight'     => '400',
						'font-style'      => 'normal',
						'text-decoration' => 'none',
						'text-transform'  => 'none',
						'font-size'       => array(

							'mobile' => '14',
						),
						'line-height'     => array(

							'mobile' => '24',
						),
						'letter-spacing'  => array(),
					)
				),

				/*global widget title*/
				'global-widget-title-align'                => 'cwp-text-left',
				'global-widget-title-color'                => '',
				'global-widget-title-margin'               => '',
				'global-widget-title-padding'              => wp_json_encode(
					array(

						'mobile' => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '15',
						),
					)
				),
				'global-widget-title-border-styling'       => wp_json_encode(
					array(
						'border-style' => 'solid',
						'border-color' => '#275cf6',
						'border-width' => array(
							'desktop' => array(
								'top'    => '0',
								'right'  => '0',
								'bottom' => '0',
								'left'   => '5',
							),
						),
					)
				),
				'global-widget-title-typography-options'   => 'custom',
				'global-widget-title-typography'           => wp_json_encode(
					array(
						'font-type'       => 'google',
						'system-font'     => 'verdana',
						'google-font'     => 'Open Sans',
						'custom-font'     => '',
						'font-weight'     => '600',
						'font-style'      => 'normal',
						'text-decoration' => 'none',
						'text-transform'  => 'none',
						'font-size'       => array(

							'mobile' => '20',
						),
						'line-height'     => array(

							'mobile' => '24',
						),
						'letter-spacing'  => array(),
					)
				),

				/*breadcrumb */
				'cosmoswp-breadcrumb-options'              => 'disable',
				'breadcrumb-before-banner-title'           => false,
				'breadcrumb-after-banner-title'            => false,
				'breadcrumb-before-content'                => true,
				'breadcrumb-color-options'                 => wp_json_encode(
					array(
						'link-color'       => '#275cf6',
						'link-hover-color' => '#1949d4',
						'text-color'       => '#fff',
					)
				),

				/*scroll top*/
				'enable-scroll-top-button'                 => true,
				'remove-scroll-top-button-mobile'          => false,
				'scroll-icon-position-options'             => 'cwp-position-right',
				'scroll-top-button-height'                 => '',
				'scroll-top-button-width'                  => '',
				'scroll-top-icon-options'                  => 'icon',
				'scroll-top-text'                          => esc_html__( 'Top', 'cosmoswp' ),
				'scroll-top-icon-position'                 => 'before',
				'scroll-top-icon'                          => 'fas fa-angle-up', /*done in frontend*/
				'scroll-top-icon-size-responsive'          => wp_json_encode(
					array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					)
				),
				'scroll-top-icon-styling'                  => wp_json_encode(
					array(
						'normal-text-color'       => '#fff',
						'normal-bg-color'         => '#275cf6',
						'normal-border-style'     => 'none',
						'normal-border-color'     => '',
						'normal-box-shadow-color' => '',
						'hover-text-color'        => '#fff',
						'hover-bg-color'          => '#1949d4',
						'hover-border-style'      => 'none',
						'hover-border-color'      => '',
						'hover-box-shadow-color'  => '',
						'normal-border-width'     => array(),
						'normal-box-shadow-css'   => array(),
						'normal-border-radius'    => array(),
						'hover-border-width'      => array(),
						'hover-box-shadow-css'    => array(),
						'hover-border-radius'     => array(),
					)
				),
				'scroll-top-icon-padding'                  => '',
				'scroll-top-icon-margin'                   => '',
				'scroll-top-icon-typography-options'       => 'inherit',
				'scroll-top-icon-typography'               => wp_json_encode(
					array(
						'font-type'       => 'google',
						'system-font'     => 'verdana',
						'google-font'     => 'Open Sans',
						'custom-font'     => '',
						'font-weight'     => '500',
						'font-style'      => 'normal',
						'text-decoration' => 'none',
						'text-transform'  => 'none',
						'font-size'       => array(),
						'line-height'     => array(),
						'letter-spacing'  => array(),
					)
				),

				/*search options*/
				'search-placeholder'                       => esc_html__( 'Search', 'cosmoswp' ),
				'search-template-options'                  => 'default',

				/*comment setting*/
				'cosmoswp-hide-comment'                    => '',
				'cosmoswp-comment-title'                   => esc_html__( 'Leave a Reply', 'cosmoswp' ),
				'cosmoswp-comment-button-text'             => esc_html__( 'Post Comment', 'cosmoswp' ),
				'cosmoswp-comment-notes-after'             => '',
			);

			return array_merge( $default_options, $theme_option_defaults );
		}

		/**
		 * Callback functions for customize_register,
		 * Add Panel Section control
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param object $wp_customize WordPress Customizer object.
		 *
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			$theme_option_defaults = cosmoswp_theme_options_controller()->theme_option_defaults();

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				cosmoswp_theme_options_controller()->panel,
				array(
					'title'    => esc_html__( 'Theme Options', 'cosmoswp' ),
					'priority' => 99,
				)
			);

			/*options customizer Layout*/
			require cosmoswp_file_directory( 'inc/customizer/theme-options/breadcrumb-options.php' );
			require cosmoswp_file_directory( 'inc/customizer/theme-options/button-options.php' );
			require cosmoswp_file_directory( 'inc/customizer/theme-options/comment-setting.php' );
			require cosmoswp_file_directory( 'inc/customizer/theme-options/scroll-top.php' );
			require cosmoswp_file_directory( 'inc/customizer/theme-options/search-options.php' );
			require cosmoswp_file_directory( 'inc/customizer/theme-options/sidebar-setting.php' );
		}


		/**
		 * Callback functions for cosmoswp_action_after_footer,
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return mixed
		 */
		public function scroll_top_data() {

			if ( ! cosmoswp_get_theme_options( 'enable-scroll-top-button' ) ) {
				return '';
			}

			$display_scroll_top_mobile = cosmoswp_get_theme_options( 'remove-scroll-top-button-mobile' );
			$display_scroll_top_mobile = ( $display_scroll_top_mobile ) ? 'cwp-hide-on-mobile' : '';
			$scroll_top_position       = cosmoswp_get_theme_options( 'scroll-icon-position-options' );
			$icon_type                 = cosmoswp_get_theme_options( 'scroll-top-icon-options' );
			$icon_structure            = $icon_spacer = '';
			if ( 'text' === $icon_type ) {
				$open_text      = cosmoswp_get_theme_options( 'scroll-top-text' );
				$icon_structure = cosmoswp_get_icon_structure( $icon_type, $open_text, 0, 0 );
			} elseif ( 'icon' === $icon_type ) {
				$open_icon      = cosmoswp_get_theme_options( 'scroll-top-icon' );
				$icon_structure = cosmoswp_get_icon_structure( $icon_type, 0, $open_icon, 0 );
			} elseif ( 'both' === $icon_type ) {
				$open_text      = cosmoswp_get_theme_options( 'scroll-top-text' );
				$open_icon      = cosmoswp_get_theme_options( 'scroll-top-icon' );
				$icon_position  = cosmoswp_get_theme_options( 'scroll-top-icon-position' );
				$icon_structure = cosmoswp_get_icon_structure( $icon_type, $open_text, $open_icon, $icon_position );
				$icon_spacer    = cosmoswp_get_icon_four_position_class( $icon_position );
			}
			?>
			<a href="#" class="cwp-scroll-to-top <?php echo esc_attr( cosmoswp_string_concator( $scroll_top_position, $icon_spacer, $display_scroll_top_mobile ) ); ?>"><span class="cwp-scroll-top-wrap"><?php echo $icon_structure; //phpcs:ignore -- Escaped at source in cosmoswp_get_icon_structure(). ?></span></a>
			<?php
		}


		/**
		 * Add search template classes to body
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $classes Body classes.
		 * @return array
		 */
		public function add_search_template_class( $classes ) {

			$template = cosmoswp_get_theme_options( 'search-template-options' );
			if ( 'default' !== $template ) {
				$classes[] = $template;
			}

			return $classes;
		}

		/**
		 * Callback functions for cosmoswp_dynamic_css,
		 * Add Theme dynamic css
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param object $dynamic_css Dynamic CSS.
		 *
		 * @return array $theme_option_dynamic_css || $all_css
		 */
		public function dynamic_css( $dynamic_css ) {

			require cosmoswp_file_directory( 'inc/customizer/theme-options/dynamic-css.php' );

			if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
				$all_css = array_merge_recursive( $dynamic_css, $theme_option_dynamic_css );

				return $all_css;
			} else {
				return $theme_option_dynamic_css;
			}
		}
	}
endif;

/**
 * Create Instance for CosmosWP_Theme_Options_Controller
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 *
 * @return object
 */
if ( ! function_exists( 'cosmoswp_theme_options_controller' ) ) {

	function cosmoswp_theme_options_controller() {//phpcs:ignore
		return CosmosWP_Theme_Options_Controller::instance();
	}

	cosmoswp_theme_options_controller()->run();
}
