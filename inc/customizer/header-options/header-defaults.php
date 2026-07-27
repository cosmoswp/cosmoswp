<?php
/**
 * Header Options Defaults
 *
 * @package CosmosWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$header_defaults = array(

	$this->builder_section_controller           => array(
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
					'width'  => '9',
					'height' => '1',
					'id'     => 'primary_menu',
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
	/*Header General*/
	'header-position-options'                   => 'normal',
	'header-general-width'                      => 'inherit',
	'vertical-header-position'                  => 'cwp-vertical-header-left',
	'vertical-header-width'                     => '280',
	'header-general-padding'                    => '',
	'header-general-margin'                     => '',
	'header-general-border-styling'             => wp_json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(),
			'box-shadow-css'   => array(),
			'border-radius'    => array(),
		)
	),
	'header-general-background-options'         => wp_json_encode(
		array(
			'background-color'      => '#f5f5f5',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),


	/*Header Top*/
	'top-header-padding'                        => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '10',
				'right'  => '0',
				'bottom' => '10',
				'left'   => '0',

			),
			'tablet'  => array(
				'top'    => '10',
				'right'  => '0',
				'bottom' => '10',
				'left'   => '0',

			),
			'mobile'  => array(
				'top'    => '10',
				'right'  => '0',
				'bottom' => '10',
				'left'   => '0',

			),
		)
	),
	'top-header-margin'                         => '',

	'header-top-height-option'                  => 'auto',
	'top-header-height'                         => '0',
	'header-top-border-styling'                 => '',
	'header-top-background-options'             => wp_json_encode(
		array(
			'background-color'      => '#444',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),
	'header-top-bg-options'                     => 'none',

	/*Header Main*/
	'header-main-height-option'                 => 'auto',
	'header-main-enable-box-width'              => false,
	'header-main-height'                        => '0',
	'header-main-padding'                       => wp_json_encode(
		array(

			'mobile' => array(
				'top'    => '15',
				'right'  => '0',
				'bottom' => '15',
				'left'   => '0',

			),
		)
	),
	'header-main-margin'                        => '',
	'header-main-bg-options'                    => 'none',
	'header-main-background-options'            => wp_json_encode(
		array(
			'background-color'      => '#fff',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),
	'header-main-border-styling'                => '',

	/*Header bottom*/
	'header-bottom-margin'                      => '',
	'header-bottom-padding'                     => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '10',
				'right'  => '0',
				'bottom' => '10',
				'left'   => '0',
			),

		)
	),
	'header-bottom-height-option'               => 'auto',
	'header-bottom-height'                      => '0',
	'header-bottom-border-styling'              => '',
	'header-bottom-bg-options'                  => 'none',
	'header-bottom-background-options'          => wp_json_encode(
		array(
			'background-color'      => '#f5f5f5',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),

	/* Header social icon Icon fixed on get*/
	'header-social-icon-data'                   => wp_json_encode(
		array(
			array(
				'enabled'          => '1',
				'icon'             => 'fab fa-facebook-f',
				'link'             => esc_url( 'https://www.facebook.com/' ),
				'checkbox'         => true,
				'icon-color'       => '#ffffff',
				'icon-hover-color' => '#ffffff',
				'bg-color'         => '#3b5998',
				'bg-hover-color'   => '#4b69a8',
			),
			array(
				'enabled'          => '1',
				'icon'             => 'fab fa-twitter',
				'link'             => esc_url( 'https://www.twitter.com/' ),
				'checkbox'         => true,
				'icon-color'       => '#ffffff',
				'icon-hover-color' => '#ffffff',
				'bg-color'         => '#55ACEE',
				'bg-hover-color'   => '#75CCFF',
			),
			array(
				'enabled'          => '1',
				'icon'             => 'fab fa-linkedin-in',
				'link'             => esc_url( 'https://www.linkedin.com/' ),
				'checkbox'         => true,
				'icon-color'       => '#ffffff',
				'icon-hover-color' => '#ffffff',
				'bg-color'         => '#0077B5',
				'bg-hover-color'   => '#1087C5',
			),
		)
	),
	'header-social-icon-align'                  => wp_json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'cwp-text-right',
		)
	),
	'single-header-social-icon-padding'         => '',
	'single-header-social-icon-margin'          => '',
	'header-social-icon-padding'                => '',
	'header-social-icon-margin'                 => '',
	'header-social-icon-radius'                 => '',
	'header-social-icon-width'                  => wp_json_encode(
		array(

			'mobile' => '30',
		)
	),
	'header-social-icon-height'                 => wp_json_encode(
		array(

			'mobile' => '30',
		)
	),
	'header-social-icon-line-height'            => wp_json_encode(
		array(

			'mobile' => '30',
		)
	),
	'header-social-icon-size'                   => wp_json_encode(
		array(

			'mobile' => '14',
		)
	),

	/*search*/

	// drop down.
	'dd-search-placeholder'                     => esc_html__( 'Search', 'cosmoswp' ),
	'dd-search-icon-align'                      => 'cwp-flex-align-right',
	'dd-search-form-align'                      => 'cwp-search-align-left',
	'drop-down-search-input-height'             => '45',
	'drop-down-search-padding'                  => '',
	'drop-down-search-margin'                   => '',
	'dropdown-search-icon-size'                 => '18',
	'dropdown-search-icon-styling'              => wp_json_encode(
		array(
			'normal-text-color'       => '#333',
			'normal-bg-color'         => '',
			'normal-border-style'     => 'none',
			'normal-border-color'     => '',
			'normal-box-shadow-color' => '',
			'hover-text-color'        => '#275cf6',
			'hover-bg-color'          => '',
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
	'dropdown-search-form-styling'              => wp_json_encode(
		array(
			'normal-text-color'       => '#ddd',
			'normal-bg-color'         => '#fff',
			'normal-border-style'     => 'solid',
			'normal-border-color'     => '#ddd',
			'normal-box-shadow-color' => '',
			'hover-text-color'        => '#444',
			'hover-bg-color'          => '#fff',
			'hover-border-style'      => 'solid',
			'hover-border-color'      => '#cdcdcd',
			'hover-box-shadow-color'  => '',
			'normal-border-width'     => array(
				'desktop' => array(
					'top'         => '1',
					'right'       => '1',
					'bottom'      => '1',
					'left'        => '1',
					'cssbox_link' => true,
				),
			),
			'normal-box-shadow-css'   => array(),
			'normal-border-radius'    => array(),
			'hover-border-width'      => array(),
			'hover-box-shadow-css'    => array(),
			'hover-border-radius'     => array(),
		)
	),
	'dd-search-typography-options'              => 'inherit',
	'dd-search-typography'                      => wp_json_encode(
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

	'normal-search-placeholder'                 => esc_html__( 'Search', 'cosmoswp' ),
	'normal-search-padding'                     => '',
	'normal-search-margin'                      => '',
	'normal-search-icon-size'                   => '18',
	'normal-search-icon-styling'                => wp_json_encode(
		array(
			'normal-text-color'       => '#333',
			'normal-bg-color'         => '',
			'normal-border-style'     => 'none',
			'normal-border-color'     => '',
			'normal-box-shadow-color' => '',
			'hover-text-color'        => '#275cf6',
			'hover-bg-color'          => '',
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
	'normal-search-input-height'                => '45',
	'normal-search-form-styling'                => wp_json_encode(
		array(
			'normal-text-color'       => '#333',
			'normal-bg-color'         => '',
			'normal-border-style'     => 'solid',
			'normal-border-color'     => '#ddd',
			'normal-box-shadow-color' => '',
			'hover-text-color'        => '#444',
			'hover-bg-color'          => '#fff',
			'hover-border-style'      => 'solid',
			'hover-border-color'      => '#999',
			'hover-box-shadow-color'  => '',

			'normal-border-width'     => array(
				'desktop' => array(
					'top'         => '1',
					'right'       => '1',
					'bottom'      => '1',
					'left'        => '1',
					'cssbox_link' => true,
				),
			),
			'normal-box-shadow-css'   => array(),
			'normal-border-radius'    => array(),
			'hover-border-width'      => array(),
			'hover-box-shadow-css'    => array(),
			'hover-border-radius'     => array(),
		)
	),
	'normal-search-typography-options'          => 'inherit',
	'normal-search-typography'                  => wp_json_encode(
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

	/*sticky header options*/
	'sticky-header-options'                     => 'disable',
	'sticky-header-animation-options'           => 'none',
	'sticky-header-trigger-height'              => '300',
	'sticky-header-bg-color'                    => '',
	'sticky-header-include-top'                 => 1,
	'sticky-header-include-main'                => 1,
	'sticky-header-include-bottom'              => 1,
	'sticky-header-mobile-enable'               => 1,
	'enable-sticky-header-color-options'        => false,
	'sticky-top-header-text-color'              => '',
	'sticky-top-header-link-color'              => '',
	'sticky-top-header-link-hover-color'        => '',
	'sticky-top-header-menu-color-options'      => wp_json_encode(
		array(
			'normal-text-color'   => '',
			'normal-bg-color'     => '',
			'normal-border-color' => '',
			'hover-text-color'    => '',
			'hover-bg-color'      => '',
			'hover-border-color'  => '',
		)
	),
	'sticky-main-header-text-color'             => '',
	'sticky-main-header-link-color'             => '',
	'sticky-main-header-link-hover-color'       => '',
	'sticky-main-header-menu-color-options'     => wp_json_encode(
		array(
			'normal-text-color'   => '',
			'normal-bg-color'     => '',
			'normal-border-color' => '',
			'hover-text-color'    => '',
			'hover-bg-color'      => '',
			'hover-border-color'  => '',
		)
	),
	'sticky-bottom-header-text-color'           => '',
	'sticky-bottom-header-link-color'           => '',
	'sticky-bottom-header-link-hover-color'     => '',
	'sticky-bottom-header-menu-color-options'   => wp_json_encode(
		array(
			'normal-text-color'   => '',
			'normal-bg-color'     => '',
			'normal-border-color' => '',
			'hover-text-color'    => '',
			'hover-bg-color'      => '',
			'hover-border-color'  => '',
		)
	),

	/*site identity*/
	'site-identity-sorting'                     => array( 'site-title' ),
	'site-logo-max-width'                       => '',
	'site-logo-position'                        => wp_json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'cwp-left',
		)
	),
	'site-identity-align'                       => wp_json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'cwp-text-left',
		)
	),
	'site-identity-padding'                     => '',
	'site-identity-margin'                      => '',
	'site-identity-styling'                     => wp_json_encode(
		array(
			'site-title-color'         => '#202020',
			'site-tagline-color'       => '#333',
			'hover-site-title-color'   => '#275cf6',
			'hover-site-tagline-color' => '#333',
		)
	),
	'site-identity-typography-options'          => 'custom',
	'site-title-typography'                     => wp_json_encode(
		array(
			'font-type'       => 'google',
			'system-font'     => 'verdana',
			'google-font'     => 'Open Sans',
			'custom-font'     => '',
			'font-weight'     => '700',
			'font-style'      => 'normal',
			'text-decoration' => 'none',
			'text-transform'  => 'uppercase',
			'font-size'       => array(

				'mobile' => '20',
			),
			'line-height'     => array(

				'mobile' => '24',
			),
			'letter-spacing'  => array(),
		)
	),
	'site-tagline-typography'                   => wp_json_encode(
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

				'mobile' => '13',
			),
			'line-height'     => array(),
			'letter-spacing'  => array(),
		)
	),

	/*primary menu*/
	'primary-menu-custom-menu'                  => '',
	'primary-menu-disable-sub-menu'             => false,
	'primary-menu-padding'                      => '',
	'primary-menu-margin'                       => '',
	'primary-menu-align'                        => 'cwp-flex-align-right',
	'primary-menu-item-padding'                 => wp_json_encode(
		array(
			'desktop' => array(),
			'tablet'  => array(),
			'mobile'  => array(
				'top'         => '10',
				'right'       => '10',
				'bottom'      => '10',
				'left'        => '10',
				'cssbox_link' => true,
			),
		)
	),
	'primary-menu-item-margin'                  => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '',
				'right'  => '5',
				'bottom' => '',
				'left'   => '5',

			),
			'tablet'  => array(),
			'mobile'  => array(),
		)
	),
	'primary-menu-styling'                      => wp_json_encode(
		array(
			'normal-text-color'    => '#333',
			'normal-bg-color'      => '',
			'normal-border-style'  => 'none',
			'normal-border-color'  => '',
			'hover-text-color'     => '#275cf6',
			'hover-bg-color'       => '',
			'hover-border-style'   => 'none',
			'hover-border-color'   => '',
			'active-text-color'    => '#275cf6',
			'active-bg-color'      => '',
			'active-border-style'  => 'none',
			'active-border-color'  => '',
			'normal-border-width'  => array(),
			'normal-border-radius' => array(),
			'hover-border-width'   => array(),
			'hover-border-radius'  => array(),
			'active-border-width'  => array(),
			'active-border-radius' => array(),
		)
	),
	'primary-menu-typography-options'           => 'custom',
	'primary-menu-typography'                   => wp_json_encode(
		array(
			'font-type'       => 'google',
			'system-font'     => 'verdana',
			'google-font'     => 'Open Sans',
			'custom-font'     => '',
			'font-weight'     => '600',
			'font-style'      => 'normal',
			'text-decoration' => 'none',
			'text-transform'  => 'uppercase',
			'font-size'       => array(

				'mobile' => '13',
			),
			'line-height'     => array(

				'mobile' => '24',
			),
			'letter-spacing'  => array(

				'mobile' => '1',
			),
		)
	),
	'primary-menu-sub-menu-item-padding'        => '',
	'primary-menu-sub-menu-item-margin'         => '',
	'primary-menu-submenu-display-options'      => 'cwp-submenu-onhover',
	'primary-menu-submenu-bg-color'             => '#fff',
	'primary-menu-submenu-styling'              => wp_json_encode(
		array(
			'normal-text-color'    => '#333',
			'normal-bg-color'      => '',
			'normal-border-style'  => 'none',
			'normal-border-color'  => '',
			'hover-text-color'     => '#275cf6',
			'hover-bg-color'       => '',
			'hover-border-style'   => 'none',
			'hover-border-color'   => '',
			'active-text-color'    => '#275cf6',
			'active-bg-color'      => '',
			'active-border-style'  => 'none',
			'active-border-color'  => '',
			'normal-border-width'  => array(),
			'normal-border-radius' => array(),
			'hover-border-width'   => array(),
			'hover-border-radius'  => array(),
			'active-border-width'  => array(),
			'active-border-radius' => array(),
		)
	),
	'primary-menu-submenu-icon-indicator'       => 'fas fa-angle-down', /*fixed on fronted*/
	'primary-menu-submenu-typography-options'   => 'inherit',
	'primary-menu-submenu-typography'           => wp_json_encode(
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

	/*secondary menu*/
	'secondary-menu-custom-menu'                => '',
	'secondary-menu-disable-sub-menu'           => true,
	'secondary-menu-padding'                    => '',
	'secondary-menu-margin'                     => '',
	'secondary-menu-align'                      => 'cwp-flex-align-left',
	'secondary-menu-item-padding'               => wp_json_encode(
		array(
			'desktop' => array(
				'top'         => '10',
				'right'       => '10',
				'bottom'      => '10',
				'left'        => '10',
				'cssbox_link' => true,
			),

		)
	),
	'secondary-menu-item-margin'                => '',
	'secondary-menu-styling'                    => wp_json_encode(
		array(
			'normal-text-color'    => '#333',
			'normal-bg-color'      => '',
			'normal-border-style'  => 'none',
			'normal-border-color'  => '',
			'hover-text-color'     => '#275cf6',
			'hover-bg-color'       => '',
			'hover-border-style'   => 'none',
			'hover-border-color'   => '',
			'active-text-color'    => '#275cf6',
			'active-bg-color'      => '',
			'active-border-style'  => 'none',
			'active-border-color'  => '',
			'normal-border-width'  => array(),
			'normal-border-radius' => array(),
			'hover-border-width'   => array(),
			'hover-border-radius'  => array(),
			'active-border-width'  => array(),
			'active-border-radius' => array(),
		)
	),
	'secondary-menu-typography-options'         => 'inherit',
	'secondary-menu-typography'                 => wp_json_encode(
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
	'secondary-menu-sub-menu-item-padding'      => '',
	'secondary-menu-sub-menu-item-margin'       => '',
	'secondary-menu-submenu-display-options'    => 'cwp-submenu-onhover',
	'secondary-menu-submenu-icon-indicator'     => 'fas fa-angle-down', /*done in frontend*/
	'secondary-menu-submenu-bg-color'           => '#000',
	'secondary-menu-submenu-styling'            => wp_json_encode(
		array(
			'normal-text-color'    => '#fff',
			'normal-bg-color'      => '',
			'normal-border-style'  => 'none',
			'normal-border-color'  => '',
			'hover-text-color'     => '#275cf6',
			'hover-bg-color'       => '',
			'hover-border-style'   => 'none',
			'hover-border-color'   => '',
			'active-text-color'    => '#275cf6',
			'active-bg-color'      => '',
			'active-border-style'  => 'none',
			'active-border-color'  => '',
			'normal-border-width'  => array(),
			'normal-border-radius' => array(),
			'hover-border-width'   => array(),
			'hover-border-radius'  => array(),
			'active-border-width'  => array(),
			'active-border-radius' => array(),
		)
	),
	'secondary-menu-submenu-typography-options' => 'inherit',
	'secondary-menu-submenu-typography'         => wp_json_encode(
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

	/*Menu Icon*/
	'menu-icon-sidebar-margin'                  => '',
	'menu-icon-sidebar-padding'                 => '',
	'menu-icon-display-menu'                    => 'cwp-left-menu-push',
	'menu-icon-sidebar-width'                   => '',
	'menu-icon-sidebar-color-options'           => wp_json_encode(
		array(
			'background-color' => '#444',
			'text-color'       => '#fff',
			'title-color'      => '#fff',
			'link-color'       => '#fff',
			'link-hover-color' => '#275cf6',
		)
	),
	'menu-icon-open-icon-options'               => 'icon',
	'menu-icon-close-icon-options'              => 'icon',
	'menu-open-text'                            => esc_html__( 'Menu Open', 'cosmoswp' ),
	'menu-close-text'                           => esc_html__( 'Menu Close', 'cosmoswp' ),
	'menu-icon-open-icon-position'              => 'before',
	'menu-icon-close-icon-position'             => 'before',
	'menu-open-icon'                            => 'fas fa-bars', /*done in frontend*/
	'menu-close-icon'                           => 'fas fa-times', /*done in frontend*/
	'menu-open-icon-size-responsive'            => wp_json_encode(
		array(

			'mobile' => '18',
		)
	),
	'menu-icon-close-icon-size-responsive'      => wp_json_encode(
		array(

			'mobile' => '18',
		)
	),
	'menu-open-icon-padding'                    => wp_json_encode(
		array(

			'mobile' => array(
				'top'         => '10',
				'right'       => '10',
				'bottom'      => '10',
				'left'        => '10',
				'cssbox_link' => true,
			),
		)
	),
	'menu-icon-close-padding'                   => wp_json_encode(
		array(

			'mobile' => array(
				'top'         => '10',
				'right'       => '10',
				'bottom'      => '10',
				'left'        => '10',
				'cssbox_link' => true,
			),
		)
	),
	'menu-open-icon-margin'                     => '',
	'menu-icon-close-margin'                    => '',
	'menu-open-icon-align'                      => 'cwp-flex-align-right',
	'menu-icon-close-icon-align'                => 'cwp-flex-align-right',
	'menu-open-icon-typography-options'         => 'inherit',
	'menu-icon-close-text-typography-options'   => 'inherit',
	'menu-open-icon-typography'                 => wp_json_encode(
		array(
			'font-type'       => 'google',
			'system-font'     => 'verdana',
			'google-font'     => 'Open Sans',
			'custom-font'     => '',
			'font-weight'     => '500',
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
	'menu-icon-close-text-typography'           => wp_json_encode(
		array(
			'font-type'       => 'google',
			'system-font'     => 'verdana',
			'google-font'     => 'Open Sans',
			'custom-font'     => '',
			'font-weight'     => '500',
			'font-style'      => 'normal',
			'text-decoration' => 'none',
			'text-transform'  => 'none',
			'font-size'       => array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '14',
			),
			'line-height'     => array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '24',
			),
			'letter-spacing'  => array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			),
		)
	),
	'menu-open-icon-styling'                    => wp_json_encode(
		array(
			'normal-text-color'       => '#333',
			'normal-bg-color'         => '',
			'normal-border-style'     => 'none',
			'normal-border-color'     => '',
			'normal-box-shadow-color' => '',
			'hover-text-color'        => '#275cf6',
			'hover-bg-color'          => '',
			'hover-border-style'      => 'none',
			'hover-border-color'      => '',
			'hover-box-shadow-color'  => '',
			'normal-border-width'     => array(
				'desktop' => array(
					'top'         => '1',
					'right'       => '1',
					'bottom'      => '1',
					'left'        => '1',
					'cssbox_link' => true,
				),
			),
			'normal-box-shadow-css'   => array(),
			'normal-border-radius'    => array(),
			'hover-border-width'      => array(),
			'hover-box-shadow-css'    => array(),
			'hover-border-radius'     => array(),
		)
	),
	'menu-icon-close-icon-styling'              => wp_json_encode(
		array(
			'normal-text-color'       => '#333',
			'normal-bg-color'         => '',
			'normal-border-style'     => 'none',
			'normal-border-color'     => '',
			'normal-box-shadow-color' => '',
			'hover-text-color'        => '#275cf6',
			'hover-bg-color'          => '',
			'hover-border-style'      => 'none',
			'hover-border-color'      => '',
			'hover-box-shadow-color'  => '',
			'normal-border-width'     => array(
				'desktop' => array(
					'top'         => '1',
					'right'       => '1',
					'bottom'      => '1',
					'left'        => '1',
					'cssbox_link' => true,
				),
			),
			'normal-border-radius'    => array(),
			'normal-box-shadow-css'   => array(),
			'hover-border-width'      => array(),
			'hover-border-radius'     => array(),
			'hover-box-shadow-css'    => array(),
		)
	),
	'menu-icon-sidebar-submenu-bg-color'        => 'rgba(0,0,0,0.2)',
	'menu-icon-sidebar-submenu-styling'         => wp_json_encode(
		array(
			'normal-text-color'    => '#fff',
			'normal-bg-color'      => '',
			'normal-border-style'  => 'none',
			'normal-border-color'  => '',
			'hover-text-color'     => '#275cf6',
			'hover-bg-color'       => '',
			'hover-border-style'   => 'none',
			'hover-border-color'   => '',
			'active-text-color'    => '#275cf6',
			'active-bg-color'      => '',
			'active-border-style'  => 'none',
			'active-border-color'  => '',
			'normal-border-width'  => array(),
			'normal-border-radius' => array(),
			'hover-border-width'   => array(),
			'hover-border-radius'  => array(),
			'active-border-width'  => array(),
			'active-border-radius' => array(),
		)
	),


	/*button one*/
	'button-one-text'                           => esc_html__( 'Button One', 'cosmoswp' ),
	'button-one-class-name'                     => '',
	'button-one-enable-icon'                    => true,
	'button-one-align'                          => wp_json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'cwp-flex-align-left',
		)
	),
	'button-one-icon'                           => 'fas fa-bars', /*fixed on frontend*/
	'button-one-icon-position'                  => 'before',
	'button-one-url'                            => '#',
	'button-one-open-link-new-tab'              => '1',
	'button-one-padding'                        => wp_json_encode(
		array(

			'mobile' => array(
				'top'    => '6',
				'right'  => '12',
				'bottom' => '6',
				'left'   => '12',
			),
		)
	),
	'button-one-margin'                         => '',
	'button-one-styling'                        => wp_json_encode(
		array(
			'normal-text-color'       => '#333',
			'normal-bg-color'         => '#fff',
			'normal-border-style'     => 'solid',
			'normal-border-color'     => '#ddd',
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
			'hover-bg-color'          => '#275cf6',
			'hover-border-style'      => 'solid',
			'hover-border-color'      => '#275cf6',
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
	'button-one-typography-options'             => 'inherit',
	'button-one-typography'                     => wp_json_encode(
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

	// contact Information Fixed icon on frontend.
	'contact-information-data'                  => wp_json_encode(
		array(
			array(
				'enabled'   => '1',
				'icon'      => 'fas fa-phone',
				'title'     => esc_html__( 'Phone Number', 'cosmoswp' ),
				'text'      => '+198712345',
				'link-type' => 'tel',
				'link'      => 'https://usaphone.com/',
				'checkbox'  => true,
			),
			array(
				'enabled'   => '1',
				'icon'      => 'far fa-envelope',
				'title'     => esc_html__( 'Email', 'cosmoswp' ),
				'text'      => 'test@gmail.com',
				'link-type' => 'email',
				'link'      => 'www.gmail.com',
				'checkbox'  => true,
			),
		)
	),
	'contact-information-align'                 => wp_json_encode(
		array(

			'mobile' => 'cwp-flex-align-left',
		)
	),
	'contact-info-padding'                      => '',
	'contact-info-margin'                       => '',
	'contact-info-icon-size'                    => wp_json_encode(
		array(

			'mobile' => '14',
		)
	),
	'contact-info-icon-color'                   => '#275cf6',

	'contact-info-title-color'                  => '#333',
	'contact-info-title-typography-options'     => 'custom',
	'contact-info-title-typography'             => wp_json_encode(
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
				'desktop' => '16',
				'tablet'  => '14',
				'mobile'  => '14',
			),
			'line-height'     => array(

				'mobile' => '24',
			),
			'letter-spacing'  => array(

				'mobile' => '1',
			),
		)
	),
	'contact-info-subtitle-color'               => '#9e9e9e',
	'contact-info-subtitle-typography-options'  => 'custom',
	'contact-info-subtitle-typography'          => wp_json_encode(
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

				'mobile' => '12',
			),
			'letter-spacing'  => array(),
		)
	),
	'contact-info-item-padding'                 => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '0',
				'right'  => '25',
				'bottom' => '0',
				'left'   => '0',

			),
		)
	),
	'contact-info-item-margin'                  => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '0',
				'right'  => '25',
				'bottom' => '0',
				'left'   => '0',
			),
		)
	),
	'contact-info-title-border-styling'         => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),

	/*HTML*/
	'html-container'                            => '',
	'header-html-text-color'                    => '#fff',
	'html-padding'                              => '',
	'html-margin'                               => '',
	'html-typography-options'                   => 'inherit',
	'html-typography'                           => wp_json_encode(
		array(
			'font-type'       => 'google',
			'system-font'     => 'verdana',
			'google-font'     => 'Lato',
			'custom-font'     => '',
			'font-style'      => 'normal',
			'text-decoration' => 'none',
			'text-transform'  => 'none',
		)
	),

);
