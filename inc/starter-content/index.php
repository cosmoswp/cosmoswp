<?php
/**
 * CosmosWP Starter Content Handler
 *
 * @author  CosmosWP
 * @package CosmosWP
 * @since   1.4.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * CosmosWP Starter Content Handler
 *
 * @author  CosmosWP
 * @package CosmosWP
 * @since   1.4.0
 */

/**
 * Class CosmosWP_Starter_Content
 */
class CosmosWP_Starter_Content {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Register starter content.
		add_action( 'after_setup_theme', array( $this, 'register_starter_content' ), 2 );

		require_once trailingslashit( __DIR__ ) . 'content.php';
	}

	/**
	 * Gets an instance of this object.
	 *
	 * @static
	 * @access public
	 * @since 1.4.0
	 * @return object
	 */
	public static function instance() {
		// Store the instance locally to avoid private static replication.
		static $instance = null;

		// Only create an instance if it doesn't already exist.
		if ( null === $instance ) {
			$instance = new self();
		}

		// Always return the instance.
		return $instance;
	}

	/**
	 * Register starter content.
	 */
	public function register_starter_content() {
		// Define navigation menu items.
		$nav_items_header = array(
			'home'     => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{home}}',
			),
			'about'    => array(
				'type'  => 'custom',
				'title' => esc_html__( 'About us', 'cosmoswp' ),
				'url'   => '#about',
			),
			'services' => array(
				'type'  => 'custom',
				'title' => esc_html__( 'Services', 'cosmoswp' ),
				'url'   => '#services',
			),
			'team'     => array(
				'type'  => 'custom',
				'title' => esc_html__( 'Team', 'cosmoswp' ),
				'url'   => '#team',
			),
			'blog'     => array(
				'type'  => 'custom',
				'title' => esc_html__( 'Blog', 'cosmoswp' ),
				'url'   => '#blog',
			),
			'contact'  => array(
				'type'  => 'custom',
				'title' => esc_html__( 'Contact', 'cosmoswp' ),
				'url'   => '#contact',
			),
		);
		$default_options  = cosmoswp_get_default_theme_options();

		// Define starter content.
		$starter_content = array(
			'attachments' => array(
				'logo' => array(
					'post_title' => _x( 'Logo', 'Theme starter content', 'cosmoswp' ),
					'file'       => 'assets/img/cosmoswp-white-logo.png',
				),
			),
			'theme_mods'  => array(
				'custom_logo'                       => '{{logo}}',
				'blogname'                          => _x( 'CosmosWP', 'Theme starter title', 'cosmoswp' ),
				'page-elements-sorting-with-title'  => array( 'content' ),
				'cosmoswp_header_builder_section_controller' => array(
					'desktop' => array(
						'top'    => '',
						'main'   => array(
							array(
								'x'      => '0',
								'y'      => '1',
								'width'  => '3',
								'height' => '1',
								'id'     => 'title_tagline',
							),
							array(
								'x'      => '3',
								'y'      => '1',
								'width'  => '8',
								'height' => '1',
								'id'     => 'primary_menu',
							),
							array(
								'x'      => '11',
								'y'      => '1',
								'width'  => '1',
								'height' => '1',
								'id'     => 'header_social',
							),
						),
						'bottom' => '',
					),
					'mobile'  => array(
						'top'    => '',
						'main'   => array(
							'0' => array(
								'x'      => '0',
								'y'      => '1',
								'width'  => '9',
								'height' => '1',
								'id'     => 'title_tagline',
							),
							'1' => array(
								'x'      => '9',
								'y'      => '1',
								'width'  => '3',
								'height' => '1',
								'id'     => 'menu_icon',
							),
						),
						'bottom' => '',
					),
					'all'     => array(
						'sidebar' => array(
							'0' => array(
								'x'      => '0',
								'y'      => '1',
								'width'  => '1',
								'height' => '1',
								'id'     => 'primary_menu',
							),
						),
					),
				),
				'header-position-options'           => 'cwp-overlay-fixed',
				'sticky-header-options'             => 'scroll-down',
				'sticky-header-bg-color'            => '#293e5d',

				'site-identity-styling'             => wp_json_encode(
					array(
						'site-title-color'         => '#fff',
						'site-tagline-color'       => '#fff',
						'hover-site-title-color'   => '#275cf6',
						'hover-site-tagline-color' => '#275cf6',
					)
				),
				'primary-menu-styling'              => wp_json_encode(
					array(
						'normal-text-color'   => '#fff',
						'normal-bg-color'     => '',
						'normal-border-style' => 'none',
						'normal-border-color' => '',
						'hover-text-color'    => '#275cf6',
						'hover-bg-color'      => '',
						'hover-border-style'  => 'none',
						'hover-border-color'  => '',
						'active-text-color'   => '#275cf6',
						'active-bg-color'     => '',
						'active-border-style' => 'none',
						'active-border-color' => '',

					)
				),
				'header-general-background-options' => wp_json_encode(
					array(
						'background-color' => 'transparent',
					)
				),
				/* Header social icon Icon fixed on get*/
				'header-social-icon-data'           => wp_json_encode(
					array(
						array(
							'enabled'          => '1',
							'icon'             => 'fab fa-facebook-f',
							'link'             => esc_url( 'https://www.facebook.com/' ),
							'checkbox'         => true,
							'icon-color'       => '#ffffff',
							'icon-hover-color' => '#275cf6',
							'bg-color'         => '',
							'bg-hover-color'   => '',
						),
						array(
							'enabled'          => '1',
							'icon'             => 'fab fa-twitter',
							'link'             => esc_url( 'https://www.twitter.com/' ),
							'checkbox'         => true,
							'icon-color'       => '#ffffff',
							'icon-hover-color' => '#275cf6',
							'bg-color'         => '',
							'bg-hover-color'   => '',
						),
						array(
							'enabled'          => '1',
							'icon'             => 'fab fa-linkedin-in',
							'link'             => esc_url( 'https://www.linkedin.com/' ),
							'checkbox'         => true,
							'icon-color'       => '#ffffff',
							'icon-hover-color' => '#275cf6',
							'bg-color'         => '',
							'bg-hover-color'   => '',
						),
					)
				),
				'single-header-social-icon-margin'  => wp_json_encode(
					array(

						'desktop' => array(
							'top'    => '',
							'right'  => '5',
							'bottom' => '',
							'left'   => '5',
						),
					)
				),
				'header-social-icon-width'          => wp_json_encode(
					array_merge(
						json_decode( $default_options['header-social-icon-width'], true ),
						array(
							'mobile' => '',
						)
					)
				),
				'header-social-icon-height'         => wp_json_encode(
					array_merge(
						json_decode( $default_options['header-social-icon-height'], true ),
						array(
							'mobile' => '',
						)
					)
				),
				'header-social-icon-line-height'    => wp_json_encode(
					array_merge(
						json_decode( $default_options['header-social-icon-line-height'], true ),
						array(
							'mobile' => '',
						)
					)
				),

				'cosmoswp_footer_builder_section_controller' => array(
					'desktop' => array(
						'top'    => array(
							array(
								'x'      => '0',
								'y'      => '1',
								'width'  => '12',
								'height' => '1',
								'id'     => 'footer_menu',
							),

						),
						'main'   => array(

							array(
								'x'      => '0',
								'y'      => '1',
								'width'  => '12',
								'height' => '1',
								'id'     => 'footer_social',
							),
						),
						'bottom' => array(
							array(
								'x'      => '0',
								'y'      => '1',
								'width'  => '12',
								'height' => '1',
								'id'     => 'footer_copyright',
							),

						),
					),
				),
				'footer-general-padding'            => wp_json_encode(
					array(
						'desktop' => array(
							'top'    => '80',
							'right'  => '',
							'bottom' => '80',
							'left'   => '',
						),
						'tablet'  => array(
							'top'    => '60',
							'right'  => '',
							'bottom' => '60',
							'left'   => '',
						),
						'mobile'  => array(
							'top'    => '40',
							'right'  => '',
							'bottom' => '40',
							'left'   => '',
						),
					)
				),
				'footer-general-background-options' => wp_json_encode(
					array(
						'background-color' => '#3B4150',

					)
				),
				'footer-top-padding'                => wp_json_encode(
					array(
						'desktop' => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '0',
						),
					)
				),
				'footer-main-padding'               => wp_json_encode(
					array(

						'mobile' => array(
							'top'    => '20',
							'right'  => '',
							'bottom' => '20',
							'left'   => '',
						),
					)
				),
				'footer-bottom-padding'             => wp_json_encode(
					array(
						'mobile' => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '0',
						),
					)
				),
				'footer-copyright-align'            => wp_json_encode(
					array(
						'mobile' => 'cwp-text-center',
					)
				),
				// footer social.
				'footer_social'                     => wp_json_encode(
					array(
						array(
							'enabled'          => '1',
							'icon'             => 'fab fa-facebook-f',
							'link'             => esc_url( 'https://www.facebook.com/' ),
							'checkbox'         => true,
							'icon-color'       => '#ffffff',
							'icon-hover-color' => '#ffffff',
							'bg-color'         => 'rgba(0,0,0,0.3)',
							'bg-hover-color'   => '#275cf6',
						),
						array(
							'enabled'          => '1',
							'icon'             => 'fab fa-twitter',
							'link'             => esc_url( 'https://www.twitter.com/' ),
							'checkbox'         => true,
							'icon-color'       => '#ffffff',
							'icon-hover-color' => '#ffffff',
							'bg-color'         => 'rgba(0,0,0,0.3)',
							'bg-hover-color'   => '#275cf6',
						),
						array(
							'enabled'          => '1',
							'icon'             => 'fab fa-linkedin-in',
							'link'             => esc_url( 'https://www.linkedin.com/' ),
							'checkbox'         => true,
							'icon-color'       => '#ffffff',
							'icon-hover-color' => '#ffffff',
							'bg-color'         => 'rgba(0,0,0,0.3)',
							'bg-hover-color'   => '#275cf6',
						),
					)
				),
				'footer-social-icon-radius'         => wp_json_encode(
					array(
						'mobile' => '50',
					)
				),

				'footer-social-icon-align'          => wp_json_encode(
					array(
						'mobile' => 'cwp-flex-align-center',
					)
				),
				'footer-menu-title'                 => '',
				'footer-menu-display-position'      => 'cwp-horizontal-menu',
				'footer-menu-align'                 => wp_json_encode(
					array(
						'mobile' => 'cwp-flex-align-center',
					)
				),
				'footer-menu-typography-options'    => 'custom',
				'footer-menu-typography'            => wp_json_encode(
					array(
						'font-type'      => 'google',
						'google-font'    => 'Open Sans',
						'font-weight'    => '600',
						'text-transform' => 'uppercase',
						'font-size'      => array(

							'mobile' => '13',
						),
						'letter-spacing' => array(

							'mobile' => '1',
						),

					)
				),
				'footer-menu-item-margin'           => wp_json_encode(
					array(

						'mobile' => array(
							'top'    => '',
							'right'  => '5',
							'bottom' => '',
							'left'   => '5',
						),
					)
				),

				'main-content-general-padding'      => wp_json_encode(
					array(

						'mobile' => array(
							'top'         => '0',
							'right'       => '0',
							'bottom'      => '0',
							'left'        => '0',
							'cssbox_link' => true,
						),
					)
				),
				'menu-open-icon-styling'            => wp_json_encode(
					array_merge(
						json_decode( $default_options['menu-open-icon-styling'], true ),
						array(
							'normal-text-color' => '#fff',
						)
					)
				),
				'menu-icon-close-icon-styling'      => wp_json_encode(
					array_merge(
						json_decode( $default_options['menu-icon-close-icon-styling'], true ),
						array(
							'normal-text-color' => '#fff',
						)
					)
				),

				'menu-icon-sidebar-color-options'   => wp_json_encode(
					array(
						'background-color' => '#122c99',

					)
				),
				'cosmoswp-banner-options-page'      => 'hide',

			),

			'nav_menus'   => array(
				'header-primary-menu' => array(
					'name'  => esc_html__( 'Header Primary Menu', 'cosmoswp' ),
					'items' => $nav_items_header,
				),
				'footer-menu'         => array(
					'name'  => esc_html__( 'Footer Menu ( Support First Level Only )', 'cosmoswp' ),
					'items' => $nav_items_header,
				),
			),
			'posts'       => cosmoswp_get_starter_posts(),
			'options'     => array(
				'show_on_front'  => 'page',
				'page_on_front'  => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),
		);

		// Add starter content support.
		add_theme_support( 'starter-content', apply_filters( 'cosmoswp_starter_content', $starter_content ) );
	}
}

/**
 * Initializes the CosmosWP Starter Content class.
 *
 * @since 1.4.0
 * @return CosmosWP_Starter_Content
 */
function cosmoswp_starter_content() {//phpcs:ignore
	return CosmosWP_Starter_Content::instance();
}
cosmoswp_starter_content();
