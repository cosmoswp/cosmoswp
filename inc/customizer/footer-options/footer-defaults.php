<?php
/**
 * Footer Defaults
 *
 * @since    1.0.0
 * @access   public
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Footer Defaults
 *
 * @since    1.0.0
 * @access   public
 */
$footer_defaults = array(

	/*Footer General*/
	$this->builder_section_controller                 => array(
		'desktop' => array(
			'top'    => '',
			'main'   => '',
			'bottom' => array(
				array(
					'x'      => '0',
					'y'      => '1',
					'width'  => '6',
					'height' => '1',
					'id'     => 'footer_copyright',
				),
				array(
					'x'      => '6',
					'y'      => '1',
					'width'  => '6',
					'height' => '1',
					'id'     => 'footer_social',
				),
			),
		),
	),
	'footer-general-layout'                           => 'inherit',
	'footer-display-style'                            => 'cwp-normal-footer',
	'footer-general-padding'                          => '',
	'footer-general-margin'                           => '',
	'footer-general-background-options'               => wp_json_encode(
		array(
			'background-color'         => '#444',
			'background-image'         => '',
			'background-size'          => 'cover',
			'background-position'      => 'center',
			'background-repeat'        => 'no-repeat',
			'background-attachment'    => 'scroll',
			'enable-overlay'           => false,
			'background-overlay-color' => '',

		)
	),
	'footer-general-border-styling'                   => wp_json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(),
			'box-shadow-css'   => array(),
			'border-radius'    => array(),
		)
	),
	'footer-general-typography'                       => '',
	'footer-sidebar-margin'                           => '',
	'footer-sidebar-padding'                          => '',

	/*footer top*/
	'footer-top-height-option'                        => 'auto',
	'footer-top-height'                               => '',
	'footer-top-padding'                              => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '25',
				'right'  => '0',
				'bottom' => '25',
				'left'   => '0',
			),

		)
	),
	'footer-top-margin'                               => '',
	'footer-top-bg-options'                           => 'none',
	'footer-top-background-options'                   => wp_json_encode(
		array(
			'background-color'         => '#f5f5f5',
			'background-image'         => '',
			'background-size'          => 'cover',
			'background-position'      => 'center',
			'background-repeat'        => 'no-repeat',
			'background-attachment'    => 'scroll',
			'enable-overlay'           => false,
			'background-overlay-color' => '',
		)
	),
	'footer-top-border-styling'                       => wp_json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(),
			'box-shadow-css'   => array(),
			'border-radius'    => array(),
		)
	),
	'footer-top-widget-title-align'                   => 'cwp-text-left',
	'footer-top-widget-title-color'                   => '#fff',
	'footer-top-widget-title-margin'                  => '',
	'footer-top-widget-title-padding'                 => '',
	'footer-top-widget-title-border-styling'          => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-top-widget-title-typography-options'      => 'inherit',
	'footer-top-widget-title-typography'              => wp_json_encode(
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
	'footer-top-widget-content-align'                 => 'cwp-text-left',
	'footer-top-widget-content-border-styling'        => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-top-widget-content-typography-options'    => 'inherit',
	'footer-top-widget-content-typography'            => wp_json_encode(
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
	'footer-top-widget-content-color-options'         => wp_json_encode(
		array(

			'text-color'       => '#333333',
			'link-color'       => '#275cf6',
			'link-hover-color' => '#1949d4',
		)
	),
	'footer-main-widget-content-color-options'        => wp_json_encode(
		array(

			'title-color'      => '#202020',
			'link-color'       => '#275cf6',
			'link-hover-color' => '#1949d4',
		)
	),
	'footer-bottom-widget-content-color-options'      => wp_json_encode(
		array(

			'text-color'       => '#202020',
			'link-color'       => '#275cf6',
			'link-hover-color' => '#1949d4',
		)
	),

	/*footer Main*/
	'footer-main-height-option'                       => 'auto',
	'footer-main-height'                              => '',
	'footer-main-padding'                             => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '25',
				'right'  => '0',
				'bottom' => '25',
				'left'   => '0',
			),

		)
	),
	'footer-main-margin'                              => '',
	'footer-main-bg-options'                          => 'none',
	'footer-main-background-options'                  => wp_json_encode(
		array(
			'background-color'         => '#444',
			'background-image'         => '',
			'background-size'          => 'cover',
			'background-position'      => 'center',
			'background-repeat'        => 'no-repeat',
			'background-attachment'    => 'scroll',
			'enable-overlay'           => false,
			'background-overlay-color' => '',
		)
	),
	'footer-main-border-styling'                      => wp_json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(),
			'box-shadow-css'   => array(),
			'border-radius'    => array(),
		)
	),
	'footer-main-widget-title-align'                  => 'cwp-text-left',
	'footer-main-widget-title-color'                  => '#fff',
	'footer-main-widget-title-margin'                 => '',
	'footer-main-widget-title-padding'                => '',
	'footer-main-widget-title-border-styling'         => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-main-widget-title-typography-options'     => 'inherit',
	'footer-main-widget-title-typography'             => wp_json_encode(
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
	'footer-main-widget-content-align'                => 'cwp-text-left',
	'footer-main-widget-content-border-styling'       => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-main-widget-content-typography-options'   => 'inherit',
	'footer-main-widget-content-typography'           => wp_json_encode(
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
	/*footer Bottom*/
	'footer-bottom-height-option'                     => 'auto',
	'footer-bottom-height'                            => '',
	'footer-bottom-padding'                           => wp_json_encode(
		array(

			'mobile' => array(
				'top'    => '20',
				'right'  => '0',
				'bottom' => '20',
				'left'   => '0',
			),
		)
	),
	'footer-bottom-margin'                            => '',
	'footer-bottom-bg-options'                        => 'none',
	'footer-bottom-background-options'                => wp_json_encode(
		array(
			'background-color'         => '#101010',
			'background-image'         => '',
			'background-size'          => 'cover',
			'background-position'      => 'center',
			'background-repeat'        => 'no-repeat',
			'background-attachment'    => 'scroll',
			'enable-overlay'           => false,
			'background-overlay-color' => '',
		)
	),
	'footer-bottom-border-styling'                    => wp_json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(),
			'box-shadow-css'   => array(),
			'border-radius'    => array(),
		)
	),
	'footer-bottom-widget-title-align'                => 'cwp-text-left',
	'footer-bottom-widget-title-color'                => '#fff',
	'footer-bottom-widget-title-margin'               => '',
	'footer-bottom-widget-title-padding'              => '',
	'footer-bottom-widget-title-border-styling'       => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-bottom-widget-title-typography-options'   => 'inherit',
	'footer-bottom-widget-title-typography'           => wp_json_encode(
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
	'footer-bottom-widget-content-align'              => 'cwp-text-left',
	'footer-bottom-widget-content-border-styling'     => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-bottom-widget-content-typography-options' => 'inherit',
	'footer-bottom-widget-content-typography'         => wp_json_encode(
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

	/*footer menu*/
	'footer-menu-title'                               => 'Menu Title',
	'footer-menu-custom-menu'                         => '',
	'footer-menu-display-position'                    => '',
	'footer-menu-padding'                             => '',
	'footer-menu-margin'                              => '',
	'footer-menu-title-align'                         => wp_json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'cwp-text-left',
		)
	),
	'footer-menu-title-color'                         => '#fff',
	'footer-menu-title-margin'                        => '',
	'footer-menu-title-padding'                       => '',
	'footer-menu-title-border-styling'                => wp_json_encode(
		array(
			'border-style' => 'none',
			'border-color' => '',
			'border-width' => array(),
		)
	),
	'footer-menu-title-typography-options'            => 'inherit',
	'footer-menu-title-typography'                    => wp_json_encode(
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
	'footer-menu-align'                               => wp_json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'cwp-flex-align-left',
		)
	),
	'footer-menu-item-padding'                        => wp_json_encode(
		array(
			'desktop' => array(
				'top'    => '0',
				'right'  => '5',
				'bottom' => '0',
				'left'   => '5',
			),

		)
	),
	'footer-menu-item-margin'                         => '',
	'footer-menu-styling'                             => wp_json_encode(
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
	'footer-menu-typography-options'                  => 'inherit',
	'footer-menu-typography'                          => wp_json_encode(
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

	// footer social.
	'footer_social'                                   => wp_json_encode(
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
	'footer-social-icon-align'                        => wp_json_encode(
		array(
			'desktop' => 'cwp-flex-align-right',
			'tablet'  => 'cwp-flex-align-right',
			'mobile'  => 'cwp-flex-align-left',
		)
	),
	'footer-social-icon-size'                         => wp_json_encode(
		array(

			'mobile' => '14',
		)
	),
	'footer-social-icon-radius'                       => '',
	'footer-social-icon-width'                        => wp_json_encode(
		array(

			'mobile' => '30',
		)
	),
	'footer-social-icon-height'                       => wp_json_encode(
		array(

			'mobile' => '30',
		)
	),
	'footer-social-icon-line-height'                  => wp_json_encode(
		array(

			'mobile' => '30',
		)
	),
	'individual-footer-social-icon-padding'           => '',
	'individual-footer-social-icon-margin'            => '',
	'footer-social-icon-section-padding'              => '',
	'footer-social-icon-section-margin'               => '',

	/*copyright*/
	'footer-copyright-text-color'                     => '#fff',
	'footer-copyright-align'                          => wp_json_encode(
		array(

			'mobile' => 'cwp-text-left',
		)
	),
	'footer_copyright'                                => esc_html__( 'Copyright &copy; {current_year} {site_title} - Powered by {theme_author}', 'cosmoswp' ),
	'footer-copyright-padding'                        => '',
	'footer-copyright-margin'                         => '',
	'footer-copyright-typography-options'             => 'inherit',
	'footer-copyright-typography'                     => wp_json_encode(
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
	/*HTML*/
	'footer-html-container'                           => '',
	'footer-html-padding'                             => '',
	'footer-html-margin'                              => '',
	'footer-html-text-color'                          => '#fff',
	'footer-html-typography-options'                  => 'inherit',
	'footer-html-typography'                          => wp_json_encode(
		array(
			'font-type'       => 'google',
			'system-font'     => 'verdana',
			'google-font'     => 'Open Sans',
			'custom-font'     => '',
			'font-style'      => 'normal',
			'text-decoration' => 'none',
			'text-transform'  => 'none',
		)
	),
	'footer-sidebar-1-widget-setting-option'          => 'inherit',
	'footer-sidebar-2-widget-setting-option'          => 'inherit',
	'footer-sidebar-3-widget-setting-option'          => 'inherit',
	'footer-sidebar-4-widget-setting-option'          => 'inherit',
	'footer-sidebar-5-widget-setting-option'          => 'inherit',
	'footer-sidebar-6-widget-setting-option'          => 'inherit',
	'footer-sidebar-7-widget-setting-option'          => 'inherit',
	'footer-sidebar-8-widget-setting-option'          => 'inherit',
	'footer-sidebar-1-content-align'                  => 'cwp-text-left',
	'footer-sidebar-1-margin'                         => '',
	'footer-sidebar-1-padding'                        => '',
	'footer-sidebar-2-content-align'                  => 'cwp-text-left',
	'footer-sidebar-2-margin'                         => '',
	'footer-sidebar-2-padding'                        => '',
	'footer-sidebar-3-content-align'                  => 'cwp-text-left',
	'footer-sidebar-3-margin'                         => '',
	'footer-sidebar-3-padding'                        => '',
	'footer-sidebar-4-content-align'                  => 'cwp-text-left',
	'footer-sidebar-4-margin'                         => '',
	'footer-sidebar-4-padding'                        => '',
	'footer-sidebar-5-content-align'                  => 'cwp-text-left',
	'footer-sidebar-5-margin'                         => '',
	'footer-sidebar-5-padding'                        => '',
	'footer-sidebar-6-content-align'                  => 'cwp-text-left',
	'footer-sidebar-6-margin'                         => '',
	'footer-sidebar-6-padding'                        => '',
	'footer-sidebar-7-content-align'                  => 'cwp-text-left',
	'footer-sidebar-7-margin'                         => '',
	'footer-sidebar-7-padding'                        => '',
	'footer-sidebar-8-content-align'                  => 'cwp-text-left',
	'footer-sidebar-8-margin'                         => '',
	'footer-sidebar-8-padding'                        => '',
);
