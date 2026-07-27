<?php
/**
 * CosmosWP Theme Customizer.
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*CosmosWP customizer Controls*/
require cosmoswp_file_directory( 'inc/customizer/class-cosmoswp-customize-control.php' );

/*Options and defaults*/
require cosmoswp_file_directory( 'inc/customizer/defaults.php' );
require cosmoswp_file_directory( 'inc/customizer/options.php' );
require cosmoswp_file_directory( 'inc/customizer/sanitize.php' );
require cosmoswp_file_directory( 'inc/customizer/callback.php' );
require cosmoswp_file_directory( 'inc/customizer/selective-refresh.php' );

/*Upgrade to pro*/
if ( ! function_exists( 'run_cosmoswp_pro' ) ) {
	require cosmoswp_file_directory( 'inc/customizer/customizer-pro/class-customize.php' );
}

/*general setting*/
require cosmoswp_file_directory( 'inc/customizer/general-setting/general-setting-controller.php' );

/*Customizer Builder*/
require cosmoswp_file_directory( 'inc/library/customizer-builder/class-customizer-builder.php' );

/*Header Builder*/
require cosmoswp_file_directory( 'inc/customizer/header-options/header-builder.php' );

/*Advanced Banner*/
require cosmoswp_file_directory( 'inc/customizer/advance-banner/advanced-banner-controller.php' );

/*Main Content */
require cosmoswp_file_directory( 'inc/customizer/main-content/main-content-controller.php' );

/*Footer Builder*/
require cosmoswp_file_directory( 'inc/customizer/footer-options/footer-builder.php' );

/*Blog Builder*/
require cosmoswp_file_directory( 'inc/customizer/blog-options/blog-builder.php' );

/*Post Controller*/
require cosmoswp_file_directory( 'inc/customizer/post-options/post-builder.php' );

/*Page Builder*/
require cosmoswp_file_directory( 'inc/customizer/page-options/builder-page.php' );

/*Theme Options Controller*/
require cosmoswp_file_directory( 'inc/customizer/theme-options/theme-option-controller.php' );

/**
 * Adding custom controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cosmoswp_customizer_custom_controls( $wp_customize ) {
	$defaults = cosmoswp_get_default_theme_options();

	require cosmoswp_file_directory( 'inc/customizer/custom-controls.php' );
}
add_action( 'customize_register', 'cosmoswp_customizer_custom_controls', 1 );

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cosmoswp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'         => '.logo-title',
				'render_callback'  => 'cosmoswp_customize_partial_blogname',
				'fallback_refresh' => false,
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'         => '.logo-tagline',
				'render_callback'  => 'cosmoswp_customize_partial_blogdescription',
				'fallback_refresh' => false,
			)
		);

		/*
		Customizer
		customize_partial_header
		Create array of every setting inside "cosmoswp_header'
		that is responsible for change of html inside #cwp-header-wrap
		*/

		$cosmoswp_header_settings = array(
			'header-top-bg-options',
			'header-top-background-options',

			'header-main-enable-box-width',
			'header-main-bg-options',
			'header-main-background-options',

			'header-bottom-bg-options',
			'header-bottom-background-options',

			/*Header Builder*/
			'cosmoswp_header_builder_section_controller',

			/*Site Identity*/
			'site-logo-position',
			'site-identity-sorting',
			'site-identity-align',

			/*Primary Menu*/
			'primary-menu-custom-menu',
			'primary-menu-disable-sub-menu',
			'primary-menu-align',
			'primary-menu-submenu-display-options',

			/*Secondary Menu*/
			'secondary-menu-custom-menu',
			'secondary-menu-disable-sub-menu',
			'secondary-menu-align',
			'secondary-menu-submenu-display-options',

			/*Social*/
			'header-social-icon-data',
			'header-social-icon-align',

			/*Dropdown Search*/
			'dd-search-placeholder',
			'dd-search-icon-align',
			'dd-search-form-align',

			/*Normal Search*/
			'normal-search-placeholder',

			/*Button One*/
			'button-one-text',
			'button-one-enable-icon',
			'button-one-icon',
			'button-one-icon-position',
			'button-one-url',
			'button-one-open-link-new-tab',
			'button-one-align',
			'button-one-class-name',

			/*Contact Information*/
			'contact-information-data',
			'contact-information-align',

			/*HTML*/
			'html-container',
			'html-container',

			/*Menu Icon*/
			'menu-icon-open-icon-options',
			'menu-open-text',
			'menu-open-icon',
			'menu-icon-open-icon-position',
			'menu-open-icon-align',

			/*Sticky Header*/
			'sticky-header-options',
			'sticky-header-animation-options',
			'sticky-header-trigger-height',
			'sticky-header-include-top',
			'sticky-header-include-main',
			'sticky-header-include-bottom',
			'sticky-header-mobile-enable',

		);

		$cosmoswp_header_settings = apply_filters( 'cosmoswp_customize_partial_header_setting', $cosmoswp_header_settings );

		$wp_customize->selective_refresh->add_partial(
			'cosmoswp_header',
			array(
				'selector'        => '#cwp-header-wrap',
				'settings'        => $cosmoswp_header_settings,
				'render_callback' => 'cosmoswp_customize_partial_header',

			)
		);
		$cosmoswp_header_menu_sidebar_settings = array(
			/*Menu Close Icon*/
			'menu-icon-close-icon-options',
			'menu-close-text',
			'menu-close-icon',
			'menu-icon-close-icon-position',
			'menu-icon-close-icon-align',
		);
		$cosmoswp_header_menu_sidebar_settings = apply_filters( 'cosmoswp_customize_partial_header_menu_sidebar_setting', $cosmoswp_header_menu_sidebar_settings );
		$wp_customize->selective_refresh->add_partial(
			'cosmoswp_header_menu_sidebar',
			array(
				'selector'        => '#cwp-header-menu-sidebar',
				'settings'        => $cosmoswp_header_menu_sidebar_settings,
				'render_callback' => 'cosmoswp_customize_partial_header_menu_sidebar',

			)
		);

		/*FOOTER OPTIONS*/
		$cosmoswp_footer_settings = array(

			cosmoswp_footer_builder()->builder_section_controller,

			'footer-general-background-options',

			/*footer top*/
			'footer-top-bg-options',
			'footer-top-background-options',
			'footer-top-widget-title-align',
			'footer-top-widget-content-align',

			/*footer main*/
			'footer-main-bg-options',
			'footer-main-background-options',
			'footer-main-widget-title-align',
			'footer-main-widget-content-align',

			/*footer bottom*/
			'footer-bottom-bg-options',
			'footer-bottom-background-options',
			'footer-bottom-widget-title-align',
			'footer-bottom-widget-content-align',

			/*footer menu*/
			'footer-menu-title',
			'footer-menu-custom-menu',
			'footer-menu-display-position',
			'footer-menu-align',
			'footer-menu-title-align',

			/*footer social*/
			'footer_social',
			'footer-social-icon-align',

			/*copyright*/
			'footer_copyright',
			'footer-copyright-align',

			/*Html*/
			'footer-html-container',

		);
		$cosmoswp_footer_settings = apply_filters( 'cosmoswp_customize_partial_footer_setting', $cosmoswp_footer_settings );

		$wp_customize->selective_refresh->add_partial(
			'cosmoswp_footer',
			array(
				'selector'         => '#cwp-footer-wrap',
				'settings'         => $cosmoswp_footer_settings,
				'render_callback'  => 'cosmoswp_customize_partial_footer',
				'fallback_refresh' => false,
			)
		);

		/* MAIN CONTENT*/

		/*Banner*/
		$cosmoswp_page_header_settings = array(
			'banner-section-display',
			'single-banner-section-title',
			'single-custom-banner-title',
			'single-banner-title-tag',
			'banner-section-title-align',
			'banner-section-content-position',
			'enable-banner-overlay-color',
		);

		$cosmoswp_page_header_settings = apply_filters( 'cosmoswp_customize_partial_page_header_setting', $cosmoswp_page_header_settings );

		$wp_customize->selective_refresh->add_partial(
			'cosmoswp_main_content',
			array(
				'selector'            => '#cwp-page-header-wrap',
				'settings'            => $cosmoswp_page_header_settings,
				'render_callback'     => 'cosmoswp_customize_partial_page_header',
				'container_inclusive' => true,

			)
		);
	}
}
add_action( 'customize_register', 'cosmoswp_customize_register', 999999 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cosmoswp_customize_preview_js() {

	/*Scripts dependency files*/
	$deps_file = COSMOSWP_PATH . '/build/customizer/preview/index.asset.php';

	/*New dependency array*/
	$dependency = array(
		'customize-preview',
		'customize-selective-refresh',
		'wp-custom-header',
	);
	$version    = COSMOSWP_VERSION;

	/*Set dependency and version*/
	if ( file_exists( $deps_file ) ) {
		$deps_file  = require $deps_file;
		$dependency = array_merge( $dependency, $deps_file['dependencies'] );
		$version    = $deps_file['version'];
	}

	wp_enqueue_script(
		'cosmoswp-customizer',
		COSMOSWP_URL . '/build/customizer/preview/index.js',
		$dependency,
		$version,
		true
	);

	$control_groups = array(
		// CSS Refresh Controls.
		'css_refresh'          => apply_filters(
			'cosmoswp_customize_css_refresher',
			array(
				// General Settings.
				'general-setting-color-options',

				// Header General.
				'vertical-header-width',
				'header-general-margin',
				'header-general-padding',
				'header-general-background-options',
				'header-general-border-styling',

				// Header Top.
				'header-top-height-option',
				'top-header-height',
				'top-header-margin',
				'top-header-padding',
				'header-top-bg-options',
				'header-top-background-options',
				'header-top-border-styling',

				// Header Main.
				'header-main-height-option',
				'header-main-height',
				'header-main-margin',
				'header-main-padding',
				'header-main-bg-options',
				'header-main-background-options',
				'header-main-border-styling',

				// Header Bottom.
				'header-bottom-height-option',
				'header-bottom-height',
				'header-bottom-margin',
				'header-bottom-padding',
				'header-bottom-bg-options',
				'header-bottom-background-options',
				'header-bottom-border-styling',

				// Site Identity.
				'site-logo-max-width',
				'site-identity-margin',
				'site-identity-padding',
				'site-identity-styling',

				// Primary Menu.
				'primary-menu-margin',
				'primary-menu-padding',
				'primary-menu-item-margin',
				'primary-menu-item-padding',
				'primary-menu-styling',
				'primary-menu-submenu-bg-color',
				'primary-menu-submenu-styling',
				'primary-menu-sub-menu-item-margin',
				'primary-menu-sub-menu-item-padding',

				// Secondary Menu.
				'secondary-menu-margin',
				'secondary-menu-padding',
				'secondary-menu-item-margin',
				'secondary-menu-item-padding',
				'secondary-menu-styling',
				'secondary-menu-submenu-bg-color',
				'secondary-menu-submenu-styling',
				'secondary-menu-sub-menu-item-margin',
				'secondary-menu-sub-menu-item-padding',

				// Header Social.
				'header-social-icon-data',
				'header-social-icon-size',
				'header-social-icon-width',
				'header-social-icon-height',
				'header-social-icon-line-height',
				'single-header-social-icon-margin',
				'single-header-social-icon-padding',
				'header-social-icon-margin',
				'header-social-icon-padding',
				'header-social-icon-radius',

				// Dropdown Search.
				'drop-down-search-margin',
				'drop-down-search-padding',
				'dropdown-search-icon-size',
				'dropdown-search-icon-styling',
				'drop-down-search-input-height',
				'dropdown-search-form-styling',

				// Normal Search.
				'normal-search-margin',
				'normal-search-padding',
				'normal-search-icon-size',
				'normal-search-icon-styling',
				'normal-search-input-height',
				'normal-search-form-styling',

				// Buttons.
				'button-one-margin',
				'button-one-padding',
				'button-one-styling',
				'button-two-margin',
				'button-two-padding',
				'button-two-styling',

				// Contact Information.
				'contact-info-margin',
				'contact-info-padding',
				'contact-info-icon-size',
				'contact-info-icon-color',
				'contact-info-title-color',
				'contact-info-subtitle-color',
				'contact-info-item-margin',
				'contact-info-item-padding',
				'contact-info-title-border-styling',

				// HTML.
				'header-html-text-color',
				'html-margin',
				'html-padding',

				// Menu Icon.
				'menu-open-icon-size-responsive',
				'menu-open-icon-padding',
				'menu-open-icon-margin',
				'menu-open-icon-styling',

				// Menu Close Icon.
				'menu-icon-close-icon-size-responsive',
				'menu-icon-close-padding',
				'menu-icon-close-margin',
				'menu-icon-close-icon-styling',

				// Menu Icon Sidebar.
				'menu-icon-sidebar-margin',
				'menu-icon-sidebar-padding',
				'menu-icon-sidebar-color-options',
				'menu-icon-sidebar-submenu-bg-color',

				// Sticky Header.
				'enable-sticky-header-color-options',
				'sticky-header-bg-color',
				'sticky-top-header-text-color',
				'sticky-top-header-link-color',
				'sticky-top-header-link-hover-color',
				'sticky-top-header-menu-color-options',
				'sticky-main-header-text-color',
				'sticky-main-header-link-color',
				'sticky-main-header-link-hover-color',
				'sticky-main-header-menu-color-options',
				'sticky-bottom-header-text-color',
				'sticky-bottom-header-link-color',
				'sticky-bottom-header-link-hover-color',
				'sticky-bottom-header-menu-color-options',

				// Dropdown Menu.
				'dropdown-menu-bg-color',
				'dropdown-menu-icon-size-responsive',
				'dropdown-menu-margin',
				'dropdown-menu-padding',
				'dropdown-icon-styling',
				'dropdown-menu-item-margin',
				'dropdown-menu-item-padding',
				'dropdown-menu-styling',

				// Dropdown Menu Close.
				'dropdown-menu-close-icon-size-responsive',
				'dropdown-close-icon-margin',
				'dropdown-close-icon-padding',
				'dropdown-close-icon-styling',

				// Fullscreen Search.
				'fullscreen-search-padding',
				'fullscreen-search-margin',
				'fullscreen-search-icon-size',
				'fullscreen-search-icon-styling',
				'fullscreen-search-input-height',
				'fullscreen-search-form-styling',

				// Header Sidebar.
				'header-sidebar-margin',
				'header-sidebar-padding',
				'header-sidebar-color-options',

				// Header Sidebar Widget.
				'header-sidebar-widget-title-color',
				'header-sidebar-widget-title-margin',
				'header-sidebar-widget-title-padding',
				'header-sidebar-widget-title-border-styling',
				'header-sidebar-widget-content-border-styling',
				'header-sidebar-widget-content-color-options',

				// NewsTicker.
				'news-ticker-margin',
				'news-ticker-padding',
				'news-ticker-background-options',

				// Overlay Search.
				'overlay-search-margin',
				'overlay-search-padding',
				'overlay-search-icon-size',
				'overlay-search-icon-styling',
				'overlay-search-input-height',
				'overlay-search-form-styling',

				// Off Canvas.
				'off-canvas-open-icon-size-responsive',
				'off-canvas-open-icon-padding',
				'off-canvas-open-icon-margin',
				'off-canvas-open-icon-styling',

				// Off Canvas Sidebar.
				'off-canvas-sidebar-margin',
				'off-canvas-sidebar-padding',
				'off-canvas-sidebar-color-options',
				'off-canvas-sidebar-submenu-bg-color',

				// Off Canvas Widget.
				'off-canvas-sidebar-widget-title-color',
				'off-canvas-sidebar-widget-title-margin',
				'off-canvas-sidebar-widget-title-padding',
				'off-canvas-sidebar-widget-title-border-styling',
				'off-canvas-sidebar-widget-content-border-styling',
				'off-canvas-sidebar-widget-content-color-options',

				// Popup Sidebar.
				'popup-sidebar-open-icon-size-responsive',
				'popup-sidebar-open-icon-margin',
				'popup-sidebar-open-icon-padding',
				'popup-open-icon-styling',
				'popup-sidebar-width',
				'popup-sidebar-margin',
				'popup-sidebar-padding',
				'popup-sidebar-color-options',

				// Popup Sidebar Widget.
				'popup-sidebar-widget-title-color',
				'popup-sidebar-widget-title-margin',
				'popup-sidebar-widget-title-padding',
				'popup-sidebar-widget-title-border-styling',
				'popup-sidebar-widget-content-border-styling',
				'popup-sidebar-widget-content-color-options',

				// Popup Sidebar Close.
				'popup-sidebar-close-icon-size-responsive',
				'popup-sidebar-close-icon-margin',
				'popup-sidebar-close-icon-padding',
				'popup-close-icon-styling',

				// Footer General.
				'footer-general-margin',
				'footer-general-padding',
				'footer-general-background-options',
				'footer-general-border-styling',
				'footer-sidebar-margin',
				'footer-sidebar-padding',
				'footer-sidebar-1-margin',
				'footer-sidebar-1-padding',
				'footer-sidebar-2-margin',
				'footer-sidebar-2-padding',
				'footer-sidebar-3-margin',
				'footer-sidebar-3-padding',
				'footer-sidebar-4-margin',
				'footer-sidebar-4-padding',
				'footer-sidebar-5-margin',
				'footer-sidebar-5-padding',
				'footer-sidebar-6-margin',
				'footer-sidebar-6-padding',
				'footer-sidebar-7-margin',
				'footer-sidebar-7-padding',
				'footer-sidebar-8-margin',
				'footer-sidebar-8-padding',

				// Footer Top.
				'footer-top-height-option',
				'footer-top-height',
				'footer-top-margin',
				'footer-top-padding',
				'footer-top-bg-options',
				'footer-top-background-options',
				'footer-top-border-styling',
				'footer-top-widget-title-color',
				'footer-top-widget-title-margin',
				'footer-top-widget-title-padding',

				// Footer Main.
				'footer-main-height-option',
				'footer-main-height',
				'footer-main-margin',
				'footer-main-padding',
				'footer-main-bg-options',
				'footer-main-background-options',
				'footer-main-border-styling',
				'footer-main-widget-title-color',
				'footer-main-widget-title-margin',
				'footer-main-widget-title-padding',

				// Footer Bottom.
				'footer-bottom-height-option',
				'footer-bottom-height',
				'footer-bottom-margin',
				'footer-bottom-padding',
				'footer-bottom-bg-options',
				'footer-bottom-background-options',
				'footer-bottom-border-styling',
				'footer-bottom-widget-title-color',
				'footer-bottom-widget-title-margin',
				'footer-bottom-widget-title-padding',

				// Footer Menu.
				'footer-menu-margin',
				'footer-menu-padding',
				'footer-menu-item-margin',
				'footer-menu-item-padding',
				'footer-menu-title-color',
				'footer-menu-title-margin',
				'footer-menu-title-padding',
				'footer-menu-title-border-styling',
				'footer-menu-styling',

				// Footer Social.
				'footer-social-icon-size',
				'footer-social-icon-radius',
				'footer-social-icon-width',
				'footer-social-icon-height',
				'footer-social-icon-line-height',
				'individual-footer-social-icon-margin',
				'individual-footer-social-icon-padding',
				'footer-social-icon-section-margin',
				'footer-social-icon-section-padding',

				// Copyright.
				'footer-copyright-text-color',
				'footer-copyright-margin',
				'footer-copyright-padding',
				'footer-top-widget-title-border-styling',
				'footer-top-widget-content-color-options',
				'footer-main-widget-content-color-options',
				'footer-bottom-widget-content-color-options',
				'footer-top-widget-content-border-styling',

				// Footer HTML.
				'footer-html-text-color',
				'footer-html-margin',
				'footer-html-padding',

				// Sticky Footer.
				'sticky-footer-icon-styling',
				'sticky-footer-html-text-color',
				'sticky-footer-html-margin',
				'sticky-footer-html-padding',
				'sticky-footer-social-icon-size',
				'sticky-footer-social-icon-radius',
				'sticky-footer-social-icon-width',
				'sticky-footer-social-icon-height',
				'sticky-footer-social-icon-line-height',
				'individual-sticky-footer-social-icon-margin',
				'individual-sticky-footer-social-icon-padding',
				'sticky-footer-social-icon-section-margin',
				'sticky-footer-social-icon-section-padding',
				'sticky-footer-menu-margin',
				'sticky-footer-menu-padding',
				'sticky-footer-menu-item-margin',
				'sticky-footer-menu-item-padding',
				'sticky-footer-menu-styling',

				// Blog Content.
				'blog-navigation-styling',
				'blog-pagination-color-options',
				'blog-default-pagination-color-options',
				'blog-sticky-post-title-font-size',
				'blog-sticky-post-content-font-size',
				'blog-sticky-post-margin',
				'blog-sticky-post-padding',
				'blog-sticky-post-bg-color',
				'blog-sticky-post-color-options',
				'blog-sticky-post-border-styling',
				'blog-button-margin',
				'blog-button-padding',
				'blog-button-styling',
				'blog-main-content-margin',
				'blog-main-content-padding',

				// Post Content.
				'post-pagination-color-options',
				'post-main-content-padding',
				'post-main-content-margin',

				// Page Content.
				'page-main-content-margin',
				'page-main-content-padding',

				// Banner Section.
				'banner-section-color',
				'banner-section-background-color',
				'enable-banner-overlay-color',
				'banner-overlay-color',
				'banner-section-background-image-options',
				'cosmoswp-banner-height',
				'banner-margin',
				'banner-padding',

				// Main Content.
				'main-content-general-margin',
				'main-content-general-padding',
				'main-content-general-background-options',
				'main-content-general-border-styling',
			)
		),

		// Typography Refresh Controls.
		'typography_refresh'   => apply_filters(
			'cosmoswp_customize_typography_refresher',
			array(
				// General Typography.
				'general-setting-body-p-typography',
				'general-setting-h1-typography',
				'general-setting-h2-typography',
				'general-setting-h3-typography',
				'general-setting-h4-typography',
				'general-setting-h5-typography',
				'general-setting-h6-typography',

				// Site Identity.
				'site-identity-typography-options',
				'site-title-typography',
				'site-tagline-typography',

				// Primary Menu.
				'primary-menu-typography-options',
				'primary-menu-typography',
				'primary-menu-submenu-typography-options',
				'primary-menu-submenu-typography',

				// Secondary Menu.
				'secondary-menu-typography-options',
				'secondary-menu-typography',
				'secondary-menu-submenu-typography-options',
				'secondary-menu-submenu-typography',

				// Dropdown Search.
				'dd-search-typography-options',
				'dd-search-typography',

				// Normal Search.
				'normal-search-typography-options',
				'normal-search-typography',

				// Buttons.
				'button-one-typography-options',
				'button-one-typography',
				'button-two-typography-options',
				'button-two-typography',

				// Contact Information.
				'contact-info-title-typography-options',
				'contact-info-title-typography',
				'contact-info-subtitle-typography-options',
				'contact-info-subtitle-typography',

				// HTML.
				'html-typography-options',
				'html-typography',

				// Header Sidebar.
				'header-sidebar-widget-title-typography-options',
				'header-sidebar-widget-title-typography',
				'header-sidebar-widget-content-typography-options',
				'header-sidebar-widget-content-typography',

				// Off Canvas.
				'off-canvas-widget-title-typography-options',
				'off-canvas-widget-title-typography',
				'off-canvas-widget-content-typography-options',
				'off-canvas-widget-content-typography',

				// Popup Sidebar.
				'popup-sidebar-widget-title-typography-options',
				'popup-sidebar-widget-title-typography',
				'popup-sidebar-widget-content-typography-options',
				'popup-sidebar-widget-content-typography',

				// Menu Icon.
				'menu-open-icon-typography-options',
				'menu-open-icon-typography',

				// Drop Down.
				'dropdown-menu-typography-options',
				'dropdown-menu-open-text-typography-options',
				'dropdown-menu-open-text-typography',
				'dropdown-menu-typography',

				// Drop Down Close.
				'dropdown-menu-close-text-typography-options',
				'dropdown-menu-close-text-typography',

				// Fullscreen Search.
				'fullscreen-search-typography-options',
				'fullscreen-search-typography',

				// News Ticker.
				'news-ticker-typography-options',
				'news-ticker-typography',

				// Overlay Search.
				'overlay-search-typography-options',
				'overlay-search-typography',

				// Off Canvas.
				'off-canvas-open-text-typography-options',
				'off-canvas-open-text-typography',

				// Popup Sidebar.
				'popup-open-text-typography-options',
				'popup-open-text-typography',

				// Footer.
				'footer-top-widget-title-typography-options',
				'footer-top-widget-title-typography',
				'footer-top-widget-content-typography-options',
				'footer-top-widget-content-typography',
				'footer-menu-title-typography-options',
				'footer-menu-title-typography',
				'footer-menu-typography-options',
				'footer-menu-typography',
				'footer-copyright-typography-options',
				'footer-copyright-typography',
				'footer-html-typography-options',
				'footer-html-typography',

				// Blog.
				'blog-button-typography-options',
				'blog-button-typography',

				// Sticky Footer.
				'sticky-footer-html-typography-options',
				'sticky-footer-html-typography',
				'sticky-footer-menu-typography-options',
				'sticky-footer-menu-typography',
			)
		),

		// Header Class Refresh Controls.
		'header_class_refresh' => apply_filters(
			'cosmoswp_customize_header_class_refresher',
			array(
				'header-position-options',
				'header-general-width',
				'vertical-header-position',
			)
		),

		// Simple Class Toggles.
		'class_toggles'        => apply_filters(
			'cosmoswp_customize_class_toggles',
			array(
				'general-setting-layout' => array(
					'target'  => 'body',
					'classes' => array(
						'cwp-full-width-body',
						'cwp-boxed-width-body',
						'cwp-fluid-width-body',
					),
				),
				'general-content-layout' => array(
					'target'  => 'body',
					'classes' => array(
						'cwp-content-default',
						'cwp-separate-boxed',
						'cwp-content-boxed',
						'cwp-content-separate-boxed',
						'cwp-sidebar-boxed',
						'cwp-sidebar-separate-boxed',
					),
				),
				'footer-general-layout'  => array(
					'target'  => 'body',
					'classes' => array(
						'cwp-full-width-footer',
						'cwp-boxed-width-footer',
						'cwp-fluid-width-footer',
					),
				),
				'footer-display-style'   => array(
					'target'  => 'body',
					'classes' => array(
						'cwp-normal-footer',
						'cwp-parallax-footer',
					),
				),
			)
		),

		// Text Updates.
		'text_updates'         => apply_filters(
			'cosmoswp_customize_text_updates',
			array(
				'blogname'        => '.logo-title',
				'blogdescription' => '.logo-tagline',
			)
		),

		// Special Cases.
		'special_cases'        => array(
			'footer-sidebar-1-widget-setting-option' => array(
				'type'     => 'toggle_class',
				'selector' => '#customize-control-footer-sidebar-1-margin',
				'class'    => 'cwp-right-push',
				'value'    => 'custom',
			),
			'menu-icon-display-menu'                 => array(
				'type' => 'menu_sidebar',
			),
			'footer-sidebar-*-content-align'         => array(
				'type'  => 'footer_widget_align',
				'count' => 8,
			),
		),
	);

	wp_localize_script(
		'cosmoswp-customizer',
		'cosmoswpCustomizerData',
		array(
			'ajaxurl'       => admin_url( 'admin-ajax.php' ),
			'wpnonce'       => wp_create_nonce( 'cosmoswp_customizer_nonce' ),
			'controlGroups' => $control_groups,
			'elements'      => array(
				'body'           => 'body',
				'googleFonts'    => '#cosmoswp-google-fonts-css',
				'dynamicCSS'     => '#cosmoswp-head-dynamic-css',
				'headerWrap'     => '#cwp-header-wrap',
				'mainWrap'       => '#cwp-main-wrap',
				'menuWrapper'    => '.cwp-menu-wrapper',
				'verticalHeader' => '#cwp-offcanvas-body-wrapper',
				'footerWrap'     => '#cwp-footer-wrap',
				'stickyFooter'   => '#cwp-sticky-footer-wrapper',
				'main'           => '#cwp-main',
				'blogContent'    => '#cwp-blog-main-content-wrapper',
				'postContent'    => '#cosmoswp-post-main-content-wrapper',
				'pageContent'    => '#cosmoswp-page-main-content-wrapper',
				'pageHeader'     => '#cwp-page-header-wrap',
			),
		)
	);
}
add_action( 'customize_preview_init', 'cosmoswp_customize_preview_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cosmoswp_customize_controls_scripts() {

	/* Atomic css */
	wp_register_style( 'atomic', COSMOSWP_URL . '/assets/library/atomic-css/atomic.min.css', array(), '1.0.0' );

	/* Atomic CSS */
	wp_enqueue_style( 'atomic' );
	wp_style_add_data( 'atomic', 'rtl', 'replace' );

	if ( defined( 'GUTENTOR_URL' ) ) {
		wp_enqueue_style(
			'fontawesome', // Handle.
			GUTENTOR_URL . '/assets/library/fontawesome/css/all' . GUTENTOR_SCRIPT_PREFIX . '.css',
			array(),
			'5.12.0'
		);
	} else {
		/*Font-Awesome-master*/
		wp_enqueue_style( 'fontawesome', COSMOSWP_URL . '/assets/library/Font-Awesome/css/all' . COSMOSWP_SCRIPT_PREFIX . '.css', array(), '5.12.0' );
	}

	/*Scripts dependency files*/
	$deps_file = COSMOSWP_PATH . '/build/customizer/controls/index.asset.php';

	/*Fallback dependency array*/
	$dependency = array(
		'jquery',
		'wp-color-picker',
		'customize-base',
		'jquery-ui-core',
		'jquery-ui-slider',
		'jquery-ui-sortable',
		'jquery-ui-draggable',
		'customize-controls',
	);
	$version    = COSMOSWP_VERSION;

	/*Set dependency and version*/
	if ( file_exists( $deps_file ) ) {
		$deps_file  = require $deps_file;
		$dependency = array_merge( $dependency, $deps_file['dependencies'] );
		$version    = $deps_file['version'];
	}

	wp_enqueue_style( 'cosmoswp-general', COSMOSWP_URL . '/build/customizer/controls/index.css', array( 'wp-components' ), $version );

	wp_enqueue_script(
		'cosmoswp-general',
		COSMOSWP_URL . '/build/customizer/controls/index.js',
		$dependency,
		$version,
		true
	);

	global $cosmoswp_customize_control;
	wp_localize_script(
		'cosmoswp-general',
		'cosmoswpCustomizerData',
		array(
			'ajaxurl'     => admin_url( 'admin-ajax.php' ),
			'wpnonce'     => wp_create_nonce( 'cosmoswp_customizer_nonce' ),
			'icons'       => cosmoswp_icons_array(),
			'hasGutentor' => defined( 'GUTENTOR_URL' ),
			'faVersion'   => function_exists( 'gutentor_get_options' ) ? gutentor_get_options( 'gutentor_font_awesome_version' ) : '',
			'controls'    => $cosmoswp_customize_control->get_controls(),
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'cosmoswp_customize_controls_scripts', 1 );

/**
 * Exports custom header video settings during selective refresh.
 *
 * This function checks if the 'cosmoswp_main_content' partial is set,
 * and if so, adds the current header video settings to the selective refresh response.
 *
 * @since 1.0.0
 *
 * @param array                          $response          The current response array for selective refresh.
 * @param WP_Customize_Selective_Refresh $selective_refresh Selective refresh component.
 * @param array                          $partials          An array of partials being rendered.
 *
 * @return array Modified response including custom header video settings, if applicable.
 */
function cosmoswp_export_header_video_settings( $response, $selective_refresh, $partials ) {
	if ( isset( $partials['cosmoswp_main_content'] ) ) {
		$response['custom_header_settings'] = get_header_video_settings();
	}

	return $response;
}
add_filter( 'customize_render_partials_response', 'cosmoswp_export_header_video_settings', 10, 3 );
