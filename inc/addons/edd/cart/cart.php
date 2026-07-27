<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.
/**
 * Edd Header Cart Header Customizer Options
 *
 * @package CosmosWP
 */

if ( ! class_exists( 'CosmosWP_Edd_Cart_Header' ) ) :

	/**
	 * Edd Header Cart Header Customizer Options
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Edd_Cart_Header {

		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.2
		 */
		public $element = 'cosmoswp_edd_cart_header';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_Edd_Cart_Header exists in memory at any one
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
				$instance = new CosmosWP_Edd_Cart_Header();
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
			add_filter( 'cosmoswp_header_builder_item', array( $this, 'add_cosmoswp_header_builder_item' ) );
			add_filter( 'customize_register', array( $this, 'customize_register' ), 99 );
			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ) );
			add_filter( 'cosmoswp_get_template_part', array( $this, 'get_template_part' ), 10, 2 );

			add_filter( 'cosmoswp_customize_partial_header_setting', array( $this, 'customize_header_partial' ) );
			add_filter( 'cosmoswp_customize_css_refresher', array( $this, 'add_css_refresher' ) );
		}

		/**
		 * Callback functions for cosmoswp_default_theme_options,
		 * Add Header Builder defaults values
		 *
		 * @since    1.0.2
		 * @access   public
		 *
		 * @param array $default_options Default options.
		 * @return array
		 */
		public function defaults( $default_options = array() ) {
			$defaults = array(
				'cwp-enable-edd-cart'       => 1,
				'cwp-edd-cart-icon'         => 'fas fa-shopping-cart', /*changed on get*/
				'cwp-edd-cart-icon-align'   => 'cwp-flex-align-right',

				'cwp-edd-cart-icon-size'    => '18',
				'cwp-edd-cart-icon-padding' => '',
				'cwp-edd-cart-icon-margin'  => '',
				'cwp-edd-cart-icon-styling' => wp_json_encode(
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
			);

			return array_merge( $default_options, $defaults );
		}


		/**
		 * Add Item on Header Builder.
		 *
		 * @param array $cosmoswp_header_builder_item Header builder item.
		 * @since    1.0.2
		 */
		public function add_cosmoswp_header_builder_item( $cosmoswp_header_builder_item ) {
			$cosmoswp_header_builder_item[ $this->element ] = array(
				'icon'    => 'dashicons dashicons-cart',
				'name'    => esc_html__( 'Edd Cart', 'cosmoswp' ),
				'id'      => $this->element,
				'col'     => 0,
				'width'   => '2',
				'section' => $this->element,
			);

			return $cosmoswp_header_builder_item;
		}

		/**
		 * Callback functions for customize_register,
		 * Add control for Dropdown_Menu
		 *
		 * @since    1.0.2
		 * @access   public
		 *
		 * @param WP_Customize_Manager $wp_customize WordPress customizer.
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			global $cosmoswp_customize_control;

			$header_defaults = $this->defaults( array() );

			/*button two section*/
			$wp_customize->add_section(
				$this->element,
				array(
					'title' => esc_html__( 'Edd Cart', 'cosmoswp' ),
					'panel' => cosmoswp_header_builder()->panel,
				)
			);

			/*Enable Icon */
			$wp_customize->add_setting(
				'cwp-enable-edd-cart',
				array(
					'default'           => $header_defaults['cwp-enable-edd-cart'],
					'sanitize_callback' => 'cosmoswp_sanitize_checkbox',
					'transport'         => 'postMessage',
				)
			);

			$cosmoswp_customize_control->add(
				'cwp-enable-edd-cart',
				array(
					'label'    => esc_html__( 'Enable Cart', 'cosmoswp' ),
					'section'  => $this->element,
					'settings' => 'cwp-enable-edd-cart',
					'type'     => 'checkbox',
				)
			);

			/*Icon*/
			$wp_customize->add_setting(
				'cwp-edd-cart-icon',
				array(
					'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
					'default'           => $header_defaults['cwp-edd-cart-icon'],
					'transport'         => 'postMessage',
				)
			);
			$cosmoswp_customize_control->add(
				new CosmosWP_Customize_Icons_Control(
					$wp_customize,
					'cwp-edd-cart-icon',
					array(
						'label'           => esc_html__( 'Icon', 'cosmoswp' ),
						'section'         => $this->element,
						'settings'        => 'cwp-edd-cart-icon',
						'active_callback' => 'cosmoswp_is_enable_edd_cart',
					)
				)
			);

			/*Icon align*/
			$wp_customize->add_setting(
				'cwp-edd-cart-icon-align',
				array(
					'default'           => $header_defaults['cwp-edd-cart-icon-align'],
					'sanitize_callback' => 'cosmoswp_sanitize_select',
					'transport'         => 'postMessage',
				)
			);
			$choices = cosmoswp_flex_align();
			$cosmoswp_customize_control->add(
				new CosmosWP_Custom_Control_Buttonset(
					$wp_customize,
					'cwp-edd-cart-icon-align',
					array(
						'choices'         => $choices,
						'label'           => esc_html__( 'Icon Alignment', 'cosmoswp' ),
						'section'         => $this->element,
						'settings'        => 'cwp-edd-cart-icon-align',
						'active_callback' => 'cosmoswp_is_enable_edd_cart',
					)
				)
			);

			/*Icon Size*/
			$wp_customize->add_setting(
				'cwp-edd-cart-icon-size',
				array(
					'default'           => $header_defaults['cwp-edd-cart-icon-size'],
					'sanitize_callback' => 'cosmoswp_sanitize_number',
					'transport'         => 'postMessage',
				)
			);
			$cosmoswp_customize_control->add(
				'cwp-edd-cart-icon-size',
				array(
					'label'           => esc_html__( 'Icon Size (px)', 'cosmoswp' ),
					'section'         => $this->element,
					'settings'        => 'cwp-edd-cart-icon-size',
					'type'            => 'number',
					'input_attrs'     => array(
						'min'  => 8,
						'max'  => 400,
						'step' => 1,
					),
					'active_callback' => 'cosmoswp_is_enable_edd_cart',
				)
			);

			/*Margin*/
			$wp_customize->add_setting(
				'cwp-edd-cart-icon-margin',
				array(
					'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
					'default'           => $header_defaults['cwp-edd-cart-icon-margin'],
					'transport'         => 'postMessage',
				)
			);
			$cosmoswp_customize_control->add(
				new CosmosWP_Custom_Control_Cssbox(
					$wp_customize,
					'cwp-edd-cart-icon-margin',
					array(
						'label'           => esc_html__( 'Margin (px)', 'cosmoswp' ),
						'section'         => $this->element,
						'settings'        => 'cwp-edd-cart-icon-margin',
						'active_callback' => 'cosmoswp_is_enable_edd_cart',
					),
					array(),
					array()
				)
			);

			/*Padding*/
			$wp_customize->add_setting(
				'cwp-edd-cart-icon-padding',
				array(
					'sanitize_callback' => 'cosmoswp_sanitize_field_default_css_box',
					'default'           => $header_defaults['cwp-edd-cart-icon-padding'],
					'transport'         => 'postMessage',
				)
			);
			$cosmoswp_customize_control->add(
				new CosmosWP_Custom_Control_Cssbox(
					$wp_customize,
					'cwp-edd-cart-icon-padding',
					array(
						'label'           => esc_html__( 'Padding (px)', 'cosmoswp' ),
						'section'         => $this->element,
						'settings'        => 'cwp-edd-cart-icon-padding',
						'active_callback' => 'cosmoswp_is_enable_edd_cart',
					),
					array(),
					array()
				)
			);
			/*Tabs*/
			$wp_customize->add_setting(
				'cwp-edd-cart-icon-styling',
				array(
					'sanitize_callback' => 'cosmoswp_sanitize_field_tabs',
					'default'           => $header_defaults['cwp-edd-cart-icon-styling'],
					'transport'         => 'postMessage',
				)
			);
			$border_style_choices = cosmoswp_header_border_style();
			$cosmoswp_customize_control->add(
				new CosmosWP_Custom_Control_Tabs(
					$wp_customize,
					'cwp-edd-cart-icon-styling',
					array(
						'label'           => esc_html__( 'Icon Styling', 'cosmoswp' ),
						'section'         => $this->element,
						'settings'        => 'cwp-edd-cart-icon-styling',
						'active_callback' => 'cosmoswp_is_enable_edd_cart',
					),
					array(
						'tabs'   => array(
							'cwp-edd-cart-icon-normal-style' => array(
								'label' => esc_html__( 'Normal', 'cosmoswp' ),
							),
							'cwp-edd-cart-icon-hover-style'  => array(
								'label' => esc_html__( 'Hover', 'cosmoswp' ),
							),
						),
						'fields' => array(
							'normal-text-color'       => array(
								'type'  => 'color',
								'label' => esc_html__( 'Text Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-normal-style',
							),
							'normal-bg-color'         => array(
								'type'  => 'color',
								'label' => esc_html__( 'Background Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-normal-style',
							),
							'normal-border-style'     => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Border Style', 'cosmoswp' ),
								'options' => $border_style_choices,
								'tab'     => 'cwp-edd-cart-icon-normal-style',
							),
							'normal-border-width'     => array(
								'type'  => 'cssbox',
								'label' => esc_html__( 'Border Width (px)', 'cosmoswp' ),
								'class' => 'cwp-element-show',
								'tab'   => 'cwp-edd-cart-icon-normal-style',
								'attr'  => array(
									'min'       => 0,
									'max'       => 1000,
									'step'      => 1,
									'link'      => 1,
									'devices'   => array(
										'desktop' => array(
											'icon' => 'dashicons-laptop',
										),
									),
									'link_text' => esc_html__( 'Link', 'cosmoswp' ),
								),
							),
							'normal-border-color'     => array(
								'type'  => 'color',
								'label' => esc_html__( 'Border Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-normal-style',
							),
							'normal-border-radius'    => array(
								'type'  => 'cssbox',
								'label' => esc_html__( 'Border Radius (px)', 'cosmoswp' ),
								'class' => 'cwp-element-show',
								'tab'   => 'cwp-edd-cart-icon-normal-style',
								'attr'  => array(
									'min'       => 0,
									'max'       => 1000,
									'step'      => 1,
									'link'      => 1,
									'devices'   => array(
										'desktop' => array(
											'icon' => 'dashicons-laptop',
										),
									),
									'link_text' => esc_html__( 'Link', 'cosmoswp' ),
								),
							),
							'normal-box-shadow-color' => array(
								'type'  => 'color',
								'label' => esc_html__( 'Box Shadow Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-normal-style',
							),
							'normal-box-shadow-css'   => array(
								'type'       => 'cssbox',
								'label'      => esc_html__( 'Box Shadow', 'cosmoswp' ),
								'tab'        => 'cwp-edd-cart-icon-normal-style',
								'class'      => 'cwp-element-show',
								'box_fields' => array(
									'x'      => true,
									'Y'      => true,
									'BLUR'   => true,
									'SPREAD' => true,
								),
								'attr'       => array(
									'min'         => 0,
									'max'         => 1000,
									'step'        => 1,
									'link'        => 1,
									'link_toggle' => false,
									'devices'     => array(
										'desktop' => array(
											'icon' => 'dashicons-laptop',
										),
									),
									'link_text'   => esc_html__( 'INSET', 'cosmoswp' ),
								),
							),
							'hover-text-color'        => array(
								'type'  => 'color',
								'label' => esc_html__( ' Text Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-hover-style',
							),
							'hover-bg-color'          => array(
								'type'  => 'color',
								'label' => esc_html__( 'Background Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-hover-style',
							),
							'hover-border-style'      => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Border Style', 'cosmoswp' ),
								'options' => $border_style_choices,
								'tab'     => 'cwp-edd-cart-icon-hover-style',
							),
							'hover-border-width'      => array(
								'type'  => 'cssbox',
								'label' => esc_html__( 'Border Width (px)', 'cosmoswp' ),
								'class' => 'cwp-element-show',
								'tab'   => 'cwp-edd-cart-icon-hover-style',
								'attr'  => array(
									'min'       => 0,
									'max'       => 1000,
									'step'      => 1,
									'link'      => 1,
									'devices'   => array(
										'desktop' => array(
											'icon' => 'dashicons-laptop',
										),
									),
									'link_text' => esc_html__( 'Link', 'cosmoswp' ),
								),
							),
							'hover-border-color'      => array(
								'type'  => 'color',
								'label' => esc_html__( 'Border Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-hover-style',
							),
							'hover-border-radius'     => array(
								'type'  => 'cssbox',
								'label' => esc_html__( 'Border Radius (px)', 'cosmoswp' ),
								'class' => 'cwp-element-show',
								'tab'   => 'cwp-edd-cart-icon-hover-style',
								'attr'  => array(
									'min'       => 0,
									'max'       => 1000,
									'step'      => 1,
									'link'      => 1,
									'devices'   => array(
										'desktop' => array(
											'icon' => 'dashicons-laptop',
										),
									),
									'link_text' => esc_html__( 'Link', 'cosmoswp' ),
								),
							),
							'hover-box-shadow-color'  => array(
								'type'  => 'color',
								'label' => esc_html__( 'Box Shadow Color', 'cosmoswp' ),
								'tab'   => 'cwp-edd-cart-icon-hover-style',
							),
							'hover-box-shadow-css'    => array(
								'type'       => 'cssbox',
								'label'      => esc_html__( 'Box Shadow', 'cosmoswp' ),
								'class'      => 'cwp-element-show',
								'tab'        => 'cwp-edd-cart-icon-hover-style',
								'box_fields' => array(
									'x'      => true,
									'Y'      => true,
									'BLUR'   => true,
									'SPREAD' => true,
								),
								'attr'       => array(
									'min'         => 0,
									'max'         => 1000,
									'step'        => 1,
									'link'        => 1,
									'link_toggle' => false,
									'devices'     => array(
										'desktop' => array(
											'icon' => 'dashicons-laptop',
										),
									),
									'link_text'   => esc_html__( 'INSET', 'cosmoswp' ),
								),
							),
						),
					)
				)
			);
		}

		/**
		 * Add Dynamic CS.
		 *
		 * @param array $dynamic_css Dynamic CSS.
		 * @since 1.0.2
		 */
		public function dynamic_css( $dynamic_css ) {

			$local_dynamic_css = array(
				'all'     => '',
				'tablet'  => '',
				'desktop' => '',
			);

			$cwp_edd_icon_css         = '';
			$cwp_edd_icon_hover_css   = '';
			$cwp_edd_icon_tablet_css  = '';
			$cwp_edd_icon_desktop_css = '';

			// Get theme options.
			$size    = cosmoswp_get_theme_options( 'cwp-edd-cart-icon-size' );
			$styling = json_decode( cosmoswp_get_theme_options( 'cwp-edd-cart-icon-styling' ), true );
			$margin  = json_decode( cosmoswp_get_theme_options( 'cwp-edd-cart-icon-margin' ), true );
			$padding = json_decode( cosmoswp_get_theme_options( 'cwp-edd-cart-icon-padding' ), true );

			// Font Size.
			if ( $size ) {
				$cwp_edd_icon_css .= 'font-size:' . $size . 'px;';
			}

			// Margin.
			$margin_desktop = cosmoswp_cssbox_values_inline( $margin, 'desktop' );
			if ( $margin_desktop ) {
				$cwp_edd_icon_desktop_css .= 'margin:' . $margin_desktop . ';';
			}
			$margin_tablet = cosmoswp_cssbox_values_inline( $margin, 'tablet' );
			if ( $margin_tablet ) {
				$cwp_edd_icon_tablet_css .= 'margin:' . $margin_tablet . ';';
			}
			$margin_mobile = cosmoswp_cssbox_values_inline( $margin, 'mobile' );
			if ( $margin_mobile ) {
				$cwp_edd_icon_css .= 'margin:' . $margin_mobile . ';';
			}

			// Padding.
			$padding_desktop = cosmoswp_cssbox_values_inline( $padding, 'desktop' );
			if ( $padding_desktop ) {
				$cwp_edd_icon_desktop_css .= 'padding:' . $padding_desktop . ';';
			}
			$padding_tablet = cosmoswp_cssbox_values_inline( $padding, 'tablet' );
			if ( $padding_tablet ) {
				$cwp_edd_icon_tablet_css .= 'padding:' . $padding_tablet . ';';
			}
			$padding_mobile = cosmoswp_cssbox_values_inline( $padding, 'mobile' );
			if ( $padding_mobile ) {
				$cwp_edd_icon_css .= 'padding:' . $padding_mobile . ';';
			}

			// Normal Styling.
			if ( is_array( $styling ) ) {
				$cwp_edd_icon_css .= cosmoswp_maybe_add_css( 'color', cosmoswp_ifset( $styling['normal-text-color'] ) );
				$cwp_edd_icon_css .= cosmoswp_maybe_add_css( 'background', cosmoswp_ifset( $styling['normal-bg-color'], 'transparent' ) );
				$cwp_edd_icon_css .= cosmoswp_maybe_add_css( 'border-style', cosmoswp_ifset( $styling['normal-border-style'] ) );
				$cwp_edd_icon_css .= cosmoswp_maybe_add_css( 'border-color', cosmoswp_ifset( $styling['normal-border-color'] ) );
				$cwp_edd_icon_css .= cosmoswp_maybe_add_css( 'border-width', cosmoswp_cssbox_values_inline( cosmoswp_ifset( $styling['normal-border-width'] ), 'desktop' ) );
				$cwp_edd_icon_css .= cosmoswp_maybe_add_css( 'border-radius', cosmoswp_cssbox_values_inline( cosmoswp_ifset( $styling['normal-border-radius'] ), 'desktop' ) );
				$box_shadow_normal = cosmoswp_boxshadow_values_inline( cosmoswp_ifset( $styling['normal-box-shadow-css'] ), 'desktop' );
				if ( $box_shadow_normal ) {
					$cwp_edd_icon_css .= cosmoswp_generate_box_shadow_css( $box_shadow_normal, cosmoswp_ifset( $styling['normal-box-shadow-color'] ) );
				}

				// Hover Styling.
				$cwp_edd_icon_hover_css .= cosmoswp_maybe_add_css( 'color', cosmoswp_ifset( $styling['hover-text-color'] ) );
				$cwp_edd_icon_hover_css .= cosmoswp_maybe_add_css( 'background-color', cosmoswp_ifset( $styling['hover-bg-color'] ) );
				$cwp_edd_icon_hover_css .= cosmoswp_maybe_add_css( 'border-style', cosmoswp_ifset( $styling['hover-border-style'] ) );
				$cwp_edd_icon_hover_css .= cosmoswp_maybe_add_css( 'border-color', cosmoswp_ifset( $styling['hover-border-color'] ) );
				$cwp_edd_icon_hover_css .= cosmoswp_maybe_add_css( 'border-width', cosmoswp_cssbox_values_inline( cosmoswp_ifset( $styling['hover-border-width'] ), 'desktop' ) );
				$cwp_edd_icon_hover_css .= cosmoswp_maybe_add_css( 'border-radius', cosmoswp_cssbox_values_inline( cosmoswp_ifset( $styling['hover-border-radius'] ), 'desktop' ) );
				$box_shadow_hover        = cosmoswp_boxshadow_values_inline( cosmoswp_ifset( $styling['hover-box-shadow-css'] ), 'desktop' );
				if ( $box_shadow_hover ) {
					$cwp_edd_icon_hover_css .= cosmoswp_generate_box_shadow_css( $box_shadow_hover, cosmoswp_ifset( $styling['hover-box-shadow-color'] ) );
				}
			}

			// Generate CSS rules.
			if ( ! empty( $cwp_edd_icon_css ) ) {
				$local_dynamic_css['all'] .= '.cwp-edd-icon{' . $cwp_edd_icon_css . '}';
			}
			if ( ! empty( $cwp_edd_icon_hover_css ) ) {
				$local_dynamic_css['all'] .= '.cwp-edd-icon:hover{' . $cwp_edd_icon_hover_css . '}';
			}
			if ( ! empty( $cwp_edd_icon_tablet_css ) ) {
				$local_dynamic_css['tablet'] .= '.cwp-edd-icon{' . $cwp_edd_icon_tablet_css . '}';
			}
			if ( ! empty( $cwp_edd_icon_desktop_css ) ) {
				$local_dynamic_css['desktop'] .= '.cwp-edd-icon{' . $cwp_edd_icon_desktop_css . '}';
			}

			// Merge with global dynamic CSS.
			if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
				return array_merge_recursive( $dynamic_css, $local_dynamic_css );
			} else {
				return $local_dynamic_css;
			}
		}

		/**
		 * Load template part
		 *
		 * @since    1.0.2
		 *
		 * @param string $template The template path.
		 * @param string $id       The template ID.
		 *
		 * @return string The template path.
		 */
		public function get_template_part( $template, $id ) {
			if ( ! $template && file_exists( COSMOSWP_PATH . "/edd/templates/{$id}.php" ) ) {
				$template = COSMOSWP_PATH . "/edd/templates/{$id}.php";
			}
			return $template;
		}

		/**
		 * Customize Partial Header.
		 *
		 * @param array $output Partially controls.
		 * @since    1.0.2
		 */
		public function customize_header_partial( $output ) {

			$all_settings = array_keys( $this->defaults() );

			$cosmoswp_header_settings = cosmoswp_get_settings_by_type( $all_settings, 'header-partial' );

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
 * Create Instance for CosmosWP_Edd_Cart_Header
 *
 * @since    1.0.2
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_edd_cart_header' ) ) {

	function cosmoswp_edd_cart_header() {//phpcs:ignore
		return CosmosWP_Edd_Cart_Header::instance();
	}

	cosmoswp_edd_cart_header()->run();
}
