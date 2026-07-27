<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Customizer Options for Easy Digital Downloads
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_Edd_Advanced_Styling' ) ) :

	/**
	 * Customizer EDD Advanced Styling.
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Edd_Advanced_Styling {

		/**
		 * Main Instance
		 *
		 * @var CosmosWP_Edd_Advanced_Styling
		 */
		private static $instance;

		/**
		 * Get active instance
		 *
		 * @return CosmosWP_Edd_Advanced_Styling
		 */
		public static function instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
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
			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ), 100 );

			add_filter( 'cosmoswp_customize_css_refresher', array( $this, 'add_css_refresher' ) );
		}


		/**
		 * Default theme options
		 *
		 * @param array $default_options Default Options.
		 * @return array
		 */
		public function defaults( $default_options = array() ) {
			$defaults = array(

				/* advanced styling */
				'edd-product-toolbar'                  => wp_json_encode(
					array(
						'background-color'      => '#f5f5f5',
						'grid-list-color'       => '#999',
						'grid-list-hover-color' => '#275cf6',
					)
				),
				'edd-product-box'                      => wp_json_encode(
					array(
						'title-font-size'        => '',
						'title-color'            => '#333',
						'title-hover-color'      => '#275cf6',
						'price-font-size'        => '',
						'price-color'            => '#333',
						'price-hover-color'      => '#275cf6',
						'content-font-size'      => '',
						'content-color'          => '#333',
						'categories-font-size'   => '14',
						'categories-color'       => '#275cf6',
						'categories-hover-color' => '#275cf6',
						'tag-font-size'          => '14',
						'tag-color'              => '#999',
						'tag-hover-color'        => '#275cf6',
					)
				),
				'edd-product-button-styling'           => wp_json_encode(
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
				'edd-product-pagination-color-options' => wp_json_encode(
					array(
						'background-color'       => '#f5f5f5',
						'background-hover-color' => '#275cf6',
						'text-color'             => '#333',
						'text-hover-color'       => '#fff',
					)
				),
				'edd-product-navigation-styling'       => wp_json_encode(
					array(
						'border-style'     => 'none',
						'border-color'     => '',
						'box-shadow-color' => '',
						'border-width'     => array(),
						'box-shadow-css'   => array(),
						'border-radius'    => array(),
					)
				),
				'edd-cart-table-bg-color'              => wp_json_encode(
					array(
						'background-color'          => '#fff',
						'background-stripped-color' => '#fff',
					)
				),
				'edd-cart-table-border-color'          => wp_json_encode(
					array(
						'border-color' => '#ddd',
					)
				),
				'edd-cart-table-header-color-options'  => wp_json_encode(
					array(
						'background-color' => '#fff',
						'text-color'       => '#333',
					)
				),
				'edd-cart-remove-text-color-options'   => wp_json_encode(
					array(
						'button-color'           => '#fff',
						'button-hover-color'     => '#fff',
						'background-color'       => '#fff',
						'background-hover-color' => '#fff',
					)
				),
				/* error notice */
				'edd-notice-error-color-options'       => wp_json_encode(
					array(
						'background-color' => '#f2dede',
						'text-color'       => '#a94442',
						'border-color'     => '#ebccd1',
					)
				),

				/* info notice */
				'edd-notice-info-color-options'        => wp_json_encode(
					array(
						'background-color' => '#d9edf7',
						'text-color'       => '#31708f',
						'border-color'     => '#bce8f1',
					)
				),

				/* success notice */
				'edd-notice-success-color-options'     => wp_json_encode(
					array(
						'background-color' => '#dff0d8',
						'text-color'       => '#3c763d',
						'border-color'     => '#d6e9c6',
					)
				),

			);

			return array_merge( $default_options, $defaults );
		}

		/**
		 * Add Customizer options
		 *
		 * @param WP_Customize_Manager $wp_customize WordPress customizer object.
		 */
		public function customize_register( $wp_customize ) {
			$styling_defaults = $this->defaults();

			/*Woo Archive Elements Starts from here*/
			$wp_customize->add_section(
				new CosmosWP_WP_Customize_Section(
					$wp_customize,
					'cosmoswp_edd_panel_elements_separator',
					array(
						'title'    => esc_html__( 'EDD Option', 'cosmoswp' ),
						'priority' => 140,
					)
				)
			);
			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				'edd-setting-panel',
				array(
					'title'    => esc_html__( 'Easy Digital Downloads', 'cosmoswp' ),
					'priority' => 170,
				)
			);
			require_once COSMOSWP_PATH . '/inc/addons/edd/advanced-styling/cwp-edd-options.php';
		}

		/**
		 * Generate dynamic CSS
		 *
		 * @return array
		 */
		public function get_dynamic_css() {
			$edd_dynamic_css = array(
				'all'     => '',
				'tablet'  => '',
				'desktop' => '',
			);

			/* Product Box Styling */
			$product_box = cosmoswp_get_theme_options( 'edd-product-box' );
			$product_box = json_decode( $product_box, true );

			if ( is_array( $product_box ) ) {
				/* Title */
				$title_css   = '';
				$title_color = cosmoswp_ifset( $product_box['title-color'] );
				if ( $title_color ) {
					$title_css .= "color:{$title_color};";
				}
				$title_font_size = cosmoswp_ifset( $product_box['title-font-size'] );
				if ( $title_font_size ) {
					$title_css .= "font-size:{$title_font_size}px;";
				}
				if ( $title_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .edd-download .entry-title, .cwp-edd-active .edd-download .entry-title a{{$title_css}}";
				}

				/* Title Hover */
				$title_hover_color = cosmoswp_ifset( $product_box['title-hover-color'] );
				if ( $title_hover_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .edd-download .entry-title:hover, .cwp-edd-active .edd-download .entry-title:hover a{color:{$title_hover_color};}";
				}

				/* Price */
				$price_css   = '';
				$price_color = cosmoswp_ifset( $product_box['price-color'] );
				if ( $price_color ) {
					$price_css .= "color:{$price_color};";
				}
				$price_font_size = cosmoswp_ifset( $product_box['price-font-size'] );
				if ( $price_font_size ) {
					$price_css .= "font-size:{$price_font_size}px;";
				}
				if ( $price_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .cwp-edd-price, .cwp-edd-active .edd_download_purchase_form ul li, .cwp-edd-active .edd_download_purchase_form ul li label{{$price_css}}";
				}

				/* Price Hover */
				$price_hover_color = cosmoswp_ifset( $product_box['price-hover-color'] );
				if ( $price_hover_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .edd_download_purchase_form ul li:hover, .cwp-edd-active .edd_download_purchase_form ul li:hover label{color:{$price_hover_color};}";
				}

				/* Content */
				$content_css   = '';
				$content_color = cosmoswp_ifset( $product_box['content-color'] );
				if ( $content_color ) {
					$content_css .= "color:{$content_color};";
				}
				$content_font_size = cosmoswp_ifset( $product_box['content-font-size'] );
				if ( $content_font_size ) {
					$content_css .= "font-size:{$content_font_size}px;";
				}
				if ( $content_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .edd-download .entry-content, .cwp-edd-active .edd-download .entry-content p, .cwp-edd-active .edd-download .entry-excerpt, .cwp-edd-active .edd-download .entry-excerpt p{{$content_css}}";
				}

				/* Categories */
				$cat_css          = '';
				$categories_color = cosmoswp_ifset( $product_box['categories-color'] );
				if ( $categories_color ) {
					$cat_css .= "color:{$categories_color};";
				}
				$categories_font_size = cosmoswp_ifset( $product_box['categories-font-size'] );
				if ( $categories_font_size ) {
					$cat_css .= "font-size:{$categories_font_size}px;";
				}
				if ( $cat_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .cwp-edd-cat a{{$cat_css}}";
				}

				/* Categories Hover */
				$categories_hover_color = cosmoswp_ifset( $product_box['categories-hover-color'] );
				if ( $categories_hover_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .cwp-edd-cat a:hover{color:{$categories_hover_color};}";
				}

				/* Tags */
				$tag_css    = '';
				$tags_color = cosmoswp_ifset( $product_box['tag-color'] );
				if ( $tags_color ) {
					$tag_css .= "color:{$tags_color};";
				}
				$tags_font_size = cosmoswp_ifset( $product_box['tag-font-size'] );
				if ( $tags_font_size ) {
					$tag_css .= "font-size:{$tags_font_size}px;";
				}
				if ( $tag_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .cwp-edd-tag a{{$tag_css}}";
				}

				/* Tags Hover */
				$tags_hover_color = cosmoswp_ifset( $product_box['tag-hover-color'] );
				if ( $tags_hover_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .cwp-edd-tag a:hover{color:{$tags_hover_color};}";
				}
			}

			/* Product Button Styling */
			$button_styling = cosmoswp_get_theme_options( 'edd-product-button-styling' );
			$button_styling = json_decode( $button_styling, true );

			if ( is_array( $button_styling ) ) {
				/* Normal State */
				$button_css        = '';
				$normal_text_color = cosmoswp_ifset( $button_styling['normal-text-color'] );
				if ( $normal_text_color ) {
					$button_css .= "color:{$normal_text_color};";
				}

				$normal_bg_color = cosmoswp_ifset( $button_styling['normal-bg-color'] );
				if ( $normal_bg_color ) {
					$button_css .= "background:{$normal_bg_color};";
				} else {
					$button_css .= 'background:transparent;';
				}

				$normal_border_style = cosmoswp_ifset( $button_styling['normal-border-style'] );
				if ( $normal_border_style ) {
					$button_css .= "border-style:{$normal_border_style};";
				}

				$normal_border_color = cosmoswp_ifset( $button_styling['normal-border-color'] );
				if ( $normal_border_color ) {
					$button_css .= "border-color:{$normal_border_color};";
				}

				$normal_border_width = cosmoswp_cssbox_values_inline( cosmoswp_ifset( $button_styling['normal-border-width'] ), 'desktop' );
				if ( strpos( $normal_border_width, 'px' ) !== false ) {
					$button_css .= "border-width:{$normal_border_width};";
				}

				$normal_border_radius = cosmoswp_cssbox_values_inline( cosmoswp_ifset( $button_styling['normal-border-radius'] ), 'desktop' );
				if ( strpos( $normal_border_radius, 'px' ) !== false ) {
					$button_css .= "border-radius:{$normal_border_radius};";
				}

				$normal_shadow_css = cosmoswp_boxshadow_values_inline( cosmoswp_ifset( $button_styling['normal-box-shadow-css'] ), 'desktop' );
				if ( strpos( $normal_shadow_css, 'px' ) !== false ) {
					$shadow_color = cosmoswp_ifset( $button_styling['normal-box-shadow-color'] );
					$shadow       = "{$normal_shadow_css} {$shadow_color}";
					$button_css  .= "-webkit-box-shadow:{$shadow};-moz-box-shadow:{$shadow};box-shadow:{$shadow};";
				}

				if ( $button_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .edd-submit.button, .cwp-edd-active #edd-purchase-button, .cwp-edd-active .edd-submit, .cwp-edd-active .cwp-edd-cart-widget-wrapper .edd_checkout a{{$button_css}}";
				}

				/* Hover State */
				$button_hover_css = '';
				$hover_text_color = cosmoswp_ifset( $button_styling['hover-text-color'] );
				if ( $hover_text_color ) {
					$button_hover_css .= "color:{$hover_text_color};";
				}

				$hover_bg_color = cosmoswp_ifset( $button_styling['hover-bg-color'] );
				if ( $hover_bg_color ) {
					$button_hover_css .= "background-color:{$hover_bg_color};";
				}

				$hover_border_style = cosmoswp_ifset( $button_styling['hover-border-style'] );
				if ( $hover_border_style ) {
					$button_hover_css .= "border-style:{$hover_border_style};";
				}

				$hover_border_color = cosmoswp_ifset( $button_styling['hover-border-color'] );
				if ( $hover_border_color ) {
					$button_hover_css .= "border-color:{$hover_border_color};";
				}

				$hover_border_width = cosmoswp_cssbox_values_inline( cosmoswp_ifset( $button_styling['hover-border-width'] ), 'desktop' );
				if ( strpos( $hover_border_width, 'px' ) !== false ) {
					$button_hover_css .= "border-width:{$hover_border_width};";
				}

				$hover_border_radius = cosmoswp_cssbox_values_inline( cosmoswp_ifset( $button_styling['hover-border-radius'] ), 'desktop' );
				if ( strpos( $hover_border_radius, 'px' ) !== false ) {
					$button_hover_css .= "border-radius:{$hover_border_radius};";
				}

				$hover_shadow_css = cosmoswp_boxshadow_values_inline( cosmoswp_ifset( $button_styling['hover-box-shadow-css'] ), 'desktop' );
				if ( strpos( $hover_shadow_css, 'px' ) !== false ) {
					$shadow_color      = cosmoswp_ifset( $button_styling['hover-box-shadow-color'] );
					$shadow            = "{$hover_shadow_css} {$shadow_color}";
					$button_hover_css .= "-webkit-box-shadow:{$shadow};-moz-box-shadow:{$shadow};box-shadow:{$shadow};";
				}

				if ( $button_hover_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active .edd-submit.button:hover, .cwp-edd-active #edd-purchase-button:hover, .cwp-edd-active .edd-submit:hover, .cwp-edd-active .edd-submit.button:focus, .cwp-edd-active #edd-purchase-button:focus, .cwp-edd-active .edd-submit:focus, .cwp-edd-active .cwp-edd-cart-widget-wrapper .edd_checkout a:hover, .cwp-edd-active .cwp-edd-cart-widget-wrapper .edd_checkout a:focus{{$button_hover_css}}";
				}
			}

			/* Cart Table Styling */
			$table_bg = cosmoswp_get_theme_options( 'edd-cart-table-bg-color' );
			$table_bg = json_decode( $table_bg, true );

			if ( is_array( $table_bg ) ) {
				$bg_color = cosmoswp_ifset( $table_bg['background-color'] );
				if ( $bg_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active #edd_checkout_cart, .cwp-edd-active #edd_checkout_cart th, .cwp-edd-active #edd_checkout_cart td{background-color:{$bg_color};}";
				}
			}

			$table_border = cosmoswp_get_theme_options( 'edd-cart-table-border-color' );
			$table_border = json_decode( $table_border, true );

			if ( is_array( $table_border ) ) {
				$table_css    = '';
				$border_color = cosmoswp_ifset( $table_border['border-color'] );
				if ( $border_color ) {
					$table_css .= "border-color:{$border_color};";
				}
				if ( $table_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active #edd_checkout_cart th, .cwp-edd-active #edd_checkout_cart td{{$table_css}}";
				}
			}

			/* Table Header */
			$header_color = cosmoswp_get_theme_options( 'edd-cart-table-header-color-options' );
			$header_color = json_decode( $header_color, true );

			if ( is_array( $header_color ) ) {
				$header_css      = '';
				$header_bg_color = cosmoswp_ifset( $header_color['background-color'] );
				if ( $header_bg_color ) {
					$header_css .= "background:{$header_bg_color};";
				}

				$header_text_color = cosmoswp_ifset( $header_color['text-color'] );
				if ( $header_text_color ) {
					$header_css .= "color:{$header_text_color};";
				}

				if ( $header_css ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active #edd_checkout_cart .edd_cart_header_row th{{$header_css}}";
				}
			}

			/* Remove Button */
			$remove_color = cosmoswp_get_theme_options( 'edd-cart-remove-text-color-options' );
			$remove_color = json_decode( $remove_color, true );

			if ( is_array( $remove_color ) ) {
				$button_color = cosmoswp_ifset( $remove_color['button-color'] );
				if ( $button_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active #edd_checkout_cart .edd_cart_remove_item_btn{color:{$button_color} !important;}";
				}

				$button_hover_color = cosmoswp_ifset( $remove_color['button-hover-color'] );
				if ( $button_hover_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-active #edd_checkout_cart .edd_cart_remove_item_btn:hover{color:{$button_hover_color} !important;}";
				}
			}

			/* Notices */
			$this->add_notice_styles( $edd_dynamic_css, 'error', 'edd-notice-error-color-options' );
			$this->add_notice_styles( $edd_dynamic_css, 'info', 'edd-notice-info-color-options' );
			$this->add_notice_styles( $edd_dynamic_css, 'success', 'edd-notice-success-color-options' );

			/* Archive List Layout */
			$image_width = cosmoswp_get_theme_options( 'edd-archive-list-media-width' );
			$image_width = json_decode( $image_width, true );

			if ( is_array( $image_width ) ) {
				foreach ( $edd_dynamic_css as $media_query => $css ) {
					$device = ( 'all' === $media_query ) ? 'mobile' : $media_query;
					$width  = cosmoswp_ifset( $image_width[ $device ] );

					if ( $width ) {
						$width        .= '%';
						$content_width = ( 'all' === $media_query || 100 <= (int) $width )
							? '100%'
							: "calc(100% - {$width} - 30px)";

						$edd_dynamic_css[ $media_query ] .= "
                .cwp-edd-active .cosmoswp-edd-grid-row.cwp-list .edd-download .cwp-list-image-box.cwp-list-image-box {
                    width: {$width};
                }
                .cwp-edd-active .cosmoswp-edd-grid-row.cwp-list .edd-download .cwp-product-content {
                    width: {$content_width};
                }";
					}
				}
			}

			/* Toolbar */
			$toolbar = cosmoswp_get_theme_options( 'edd-product-toolbar' );
			$toolbar = json_decode( $toolbar, true );

			if ( is_array( $toolbar ) ) {
				$toolbar_bg_color = cosmoswp_ifset( $toolbar['background-color'] );
				if ( $toolbar_bg_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-archive-toolbar{background-color:{$toolbar_bg_color}!important;}";
				}

				$grid_list_color = cosmoswp_ifset( $toolbar['grid-list-color'] );
				if ( $grid_list_color ) {
					$edd_dynamic_css['all'] .= ".cwp-edd-archive-toolbar .cwp-edd-view-switcher span{color:{$grid_list_color};border-color:{$grid_list_color}!important;}";
				}

				$grid_list_hover_color = cosmoswp_ifset( $toolbar['grid-list-hover-color'] );
				if ( $grid_list_hover_color ) {
					$edd_dynamic_css['all'] .= "
                .cwp-edd-archive-toolbar .cwp-edd-view-switcher span.active,
                .cwp-edd-archive-toolbar .cwp-edd-view-switcher span:hover{
                    color:{$grid_list_hover_color}!important;
                    border-color:{$grid_list_hover_color}!important;
                }";
				}
			}

			/* Pagination */
			$pagination_color = cosmoswp_get_theme_options( 'edd-product-pagination-color-options' );
			$pagination_color = json_decode( $pagination_color, true );

			if ( is_array( $pagination_color ) ) {
				/* Normal State */
				$pagination_css      = '';
				$pagination_bg_color = cosmoswp_ifset( $pagination_color['background-color'] );
				if ( $pagination_bg_color ) {
					$pagination_css .= "background:{$pagination_bg_color};";
				}

				$pagination_text_color = cosmoswp_ifset( $pagination_color['text-color'] );
				if ( $pagination_text_color ) {
					$pagination_css .= "color:{$pagination_text_color};";
				}

				if ( $pagination_css ) {
					$edd_dynamic_css['all'] .= "
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers,
                .cwp-edd-active .edd_pagination .page-numbers{
                    {$pagination_css}
                }";
				}

				/* Hover State */
				$pagination_hover_css      = '';
				$pagination_bg_hover_color = cosmoswp_ifset( $pagination_color['background-hover-color'] );
				if ( $pagination_bg_hover_color ) {
					$pagination_hover_css   .= "background:{$pagination_bg_hover_color};";
					$edd_dynamic_css['all'] .= "
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers.current,
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers:hover,
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers:focus,
                .cwp-edd-active .edd_pagination .page-numbers.current,
                .cwp-edd-active .edd_pagination .page-numbers:focus,
                .cwp-edd-active .edd_pagination .page-numbers:hover {
                    border-color:{$pagination_bg_hover_color};
                }";
				}

				$pagination_text_hover_color = cosmoswp_ifset( $pagination_color['text-hover-color'] );
				if ( $pagination_text_hover_color ) {
					$pagination_hover_css .= "color:{$pagination_text_hover_color};";
				}

				if ( $pagination_hover_css ) {
					$edd_dynamic_css['all'] .= "
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers.current,
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers:hover,
                .cwp-edd-active .cwp-edd-pagination .pagination .nav-links .page-numbers:focus,
                .cwp-edd-active .edd_pagination .page-numbers.current,
                .cwp-edd-active .edd_pagination .page-numbers:focus,
                .cwp-edd-active .edd_pagination .page-numbers:hover {
                    {$pagination_hover_css}
                }";
				}
			}

			return $edd_dynamic_css;
		}

		/**
		 * Appends notice-specific CSS rules to the provided dynamic CSS array.
		 *
		 * This function generates CSS styles based on color options and adds them
		 * to the 'all' key of the passed-by-reference $dynamic_css array.
		 *
		 * @param array  &$dynamic_css The dynamic CSS array (modified by reference).
		 * @param string $type         The type of notice (e.g., 'success', 'error').
		 * @param string $option_name  The name of the theme options containing color settings.
		 *
		 * @return void (modifies $dynamic_css directly)
		 */
		private function add_notice_styles( &$dynamic_css, $type, $option_name ) {
			$colors_option = cosmoswp_get_theme_options( $option_name );
			$colors        = json_decode( $colors_option, true );

			if ( is_array( $colors ) ) {
				$css      = '';
				$bg_color = cosmoswp_ifset( $colors['background-color'] );
				if ( $bg_color ) {
					$css .= "background:{$bg_color};";
				}

				$text_color = cosmoswp_ifset( $colors['text-color'] );
				if ( $text_color ) {
					$css .= "color:{$text_color};";
				}

				$border_color = cosmoswp_ifset( $colors['border-color'] );
				if ( $border_color ) {
					$css .= "border-color:{$border_color};";
				}

				if ( $css ) {
					$dynamic_css['all'] .= ".cwp-edd-active .edd_form .edd-alert-{$type}{{$css}}";
				}
			}
		}

		/**
		 * Callback functions for dynamic_css,
		 * Add Woocommerce dynamic css
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param object $dynamic_css Dynamic CSS.
		 * @return array
		 */
		public function dynamic_css( $dynamic_css ) {

			$edd_dynamic_css = $this->get_dynamic_css();
			if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
				$all_css = array_merge_recursive( $dynamic_css, $edd_dynamic_css );
				return $all_css;
			} else {
				return $edd_dynamic_css;
			}
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
			$defaults_keys = array_keys( $this->defaults() );
			return array_unique( array_merge( $css_refresher, $defaults_keys ) );
		}
	}
endif;

/**
 * Create Instance for CosmosWP_Edd_Advanced_Styling
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_edd_advanced_styling' ) ) {

	function cosmoswp_edd_advanced_styling() {//phpcs:ignore
		return CosmosWP_Edd_Advanced_Styling::instance();
	}

	cosmoswp_edd_advanced_styling()->run();
}
