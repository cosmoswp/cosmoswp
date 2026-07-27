<?php // phpcs:ignore WordPress.NamingConventions.ValidClassName.Prefix -- Class filename does not follow standard, but this is intentional.

/**
 * EDD Single Customizer Options
 *
 * @package CosmosWP
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CosmosWP_Edd_Single' ) ) :

	/**
	 * EDD Single Customizer Options
	 *
	 * @package CosmosWP
	 */
	class CosmosWP_Edd_Single {

		/**
		 * Panel ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $panel = 'cosmoswp-edd-single';

		/**
		 * Section ID
		 *
		 * @var string
		 * @access public
		 * @since 1.0.0
		 */
		public $section = 'cosmoswp-edd-single';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of CosmosWP_Edd_Single exists in memory at any one
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
				$instance = new CosmosWP_Edd_Single();
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

			/*add class in single download class*/
			add_filter( 'post_class', array( $this, 'single_download_class' ), 10, 3 );

			add_action( 'cosmoswp_action_edd_single', array( $this, 'display_edd_single' ), 100 );
			add_action( 'cosmoswp_action_after_edd_single', array( $this, 'display_edd_related' ), 100, 1 );

			add_filter( 'cosmoswp_dynamic_css', array( $this, 'dynamic_css' ), 100 );

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

				/*Sidebar*/
				'edd-img-size'              => 'full',
				'cwp-edd-single-sidebar'    => 'ct-ps',

				'edd-single-content-length' => 20,
				'edd-related-item-from'     => 'edd-categories',
				'edd-single-related-number' => 4,
				'edd-single-related-col'    => 4,
				'edd-single-elements'       => array( 'title', 'content' ),
				'edd-single-side-elements'  => array( 'price', 'cart', 'author', 'cats', 'tags' ),
				'edd-single-content-width'  => wp_json_encode(
					array(
						'desktop' => '40',
						'tablet'  => '40',
						'mobile'  => '100',
					)
				),

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
		 * @param object $wp_customize WordPress customizer object.
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
					'title'    => esc_html__( 'Edd Single', 'cosmoswp' ),
					'priority' => 160,
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

			/* EDD Single Elements */
			require COSMOSWP_PATH . '/inc/addons/edd/single/main-content.php';
		}

		/**
		 * Edd Post Class filter.
		 *
		 * @since 3.6.2
		 *
		 * @param array  $classes Array of CSS classes.
		 * @param string $class   Array of CSS classes.
		 * @param string $post_id Post ID.
		 *
		 * @return array Modified array of CSS classes.
		 */
		public function single_download_class( $classes, $class, $post_id ) {

			if ( ! is_singular( 'download' ) ) {
				return $classes;
			}
			$edd_single_media_width = cosmoswp_get_theme_options( 'edd-single-content-width' );
			$edd_single_media_width = json_decode( $edd_single_media_width, true );
			if ( isset( $edd_single_media_width['mobile'] ) ) {
				if ( 100 === $edd_single_media_width['mobile'] ) {
					// Add new class.
					$classes[] = 'cwp-single-img-full-m';
				}
			}
			if ( isset( $edd_single_media_width['tablet'] ) ) {
				if ( 100 === $edd_single_media_width['tablet'] ) {
					// Add new class.
					$classes[] = 'cwp-single-img-full-t';
				}
			}
			if ( isset( $edd_single_media_width['desktop'] ) ) {
				if ( 100 === $edd_single_media_width['desktop'] ) {
					// Add new class.
					$classes[] = 'cwp-single-img-full-d';
				}
			}
			return $classes;
		}

		/**
		 * Callback Function for cosmoswp_action_edd_single
		 * Display WooCommerce Single Product
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function display_edd_single() {
			$sidebar = cosmoswp_get_theme_options( 'cwp-edd-single-sidebar' );
			?>
			<!-- Start of .blog-content-->
			<div class="cwp-page cwp-content-wrapper <?php echo esc_attr( 'cwp-' . $sidebar ); ?> <?php cosmoswp_blog_main_wrap_classes(); ?>" id="cwp-edd-single-main-content-wrapper">
				<?php
				echo '<div class="grid-container"><div class="grid-row">';
				cosmoswp_sidebar_template( $sidebar, 'cwp-edd-single' );
				echo '</div>';/*.grid-row*/
				echo '</div>';/*.grid-container*/
				?>
			</div>
			<!-- End of .blog-content -->
			<?php
		}

		/**
		 * Callback Function for cosmoswp_action_after_edd_single
		 * Display EDD Related Post
		 *
		 * @since    1.0.0
		 * @access   public
		 * @param integer $post_id Post ID.
		 * @return boolean||void
		 */
		public function display_edd_related( $post_id ) {

			$edd_related_item_from_options = cosmoswp_get_theme_options( 'edd-related-item-from' );
			if ( empty( $edd_related_item_from_options ) ) {
				return false;
			}

			/* edd single element with sorting */
			$edd_archive_list_elements = cosmoswp_get_theme_options( 'edd-archive-grid-elements' );
			$edd_archive_list_elements = apply_filters( 'cosmoswp_edd_archive_list_elements', $edd_archive_list_elements );
			if ( ! is_array( $edd_archive_list_elements ) || empty( $edd_archive_list_elements ) ) {
				return false;
			}
			$edd_related_post_number = cosmoswp_get_theme_options( 'edd-single-related-number' );
			if ( 0 === absint( $edd_related_post_number ) ) {
				return false;
			}
			$cosmoswp_cat_post_args = array(
				'post__not_in'        => array( $post_id ),
				'post_type'           => 'download',
				'posts_per_page'      => absint( $edd_related_post_number ),
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			);
			if ( 'edd-categories' === $edd_related_item_from_options ) {
				$product_categories_terms = wp_get_object_terms( $post_id, 'download_category' );
				$category_ids             = array();
				if ( ! empty( $product_categories_terms ) ) {
					if ( ! is_wp_error( $product_categories_terms ) ) {
						foreach ( $product_categories_terms as $term ) {
							$category_ids[] = $term->term_id;
						}
					}
				}
				$cosmoswp_cat_post_args['tax_query'] = array(
					array(
						'taxonomy'         => 'download_category',
						'field'            => 'id',
						'terms'            => $category_ids,
						'include_children' => true,
						'operator'         => 'IN',
					),
				);
			} elseif ( 'edd-tags' === $edd_related_item_from_options ) {
				$tag_ids            = array();
				$product_tags_terms = wp_get_object_terms( $post_id, 'download_tag' );
				$category_ids       = array();
				if ( ! empty( $product_tags_terms ) ) {
					if ( ! is_wp_error( $product_tags_terms ) ) {
						foreach ( $product_tags_terms as $term ) {
							$tag_ids[] = $term->term_id;
						}
					}
				}
				$cosmoswp_cat_post_args['tax_query'] = array(
					array(
						'taxonomy'         => 'download_tag',
						'field'            => 'id',
						'terms'            => $tag_ids,
						'include_children' => true,
						'operator'         => 'IN',
					),
				);

			}
			$related_post_query = new WP_Query( $cosmoswp_cat_post_args );
			if ( $related_post_query->have_posts() ) {
				echo '<div id="related_posts"><div class="grid-container"><h2>' . esc_html__( 'Related Posts', 'cosmoswp' ) . '</h2><div class="grid-row">';
				while ( $related_post_query->have_posts() ) {
					$related_post_query->the_post();
					$columns = absint( cosmoswp_get_theme_options( 'edd-single-related-col' ) );
					if ( 1 === $columns ) {
						$grid = 'grid-12';
					} elseif ( 2 === $columns ) {
						$grid = 'grid-lg-6 grid-md-6 grid-12';
					} elseif ( 3 === $columns ) {
						$grid = 'grid-lg-4 grid-md-4 grid-12';
					} elseif ( 4 === $columns ) {
						$grid = 'grid-lg-3 grid-sm-4 grid-12';
					} elseif ( 5 === $columns ) {
						$grid = 'grid-lg-2m3 grid-md-4 grid-12';
					} else {
						$grid = 'grid-lg-3 grid-12';
					}

					?>
					<div id="download-<?php the_ID(); ?>" <?php post_class( $grid ); ?>>
						<?php
						echo "<div class='cwp-product-content'>";
						foreach ( $edd_archive_list_elements as $element ) {
							if ( 'image' === $element ) {
								?>
								<div class="cwp-image-box cwp-elements">
									<a href="<?php the_permalink(); ?>">
										<?php
										the_post_thumbnail( 'full' );
										?>
									</a>
								</div>
								<?php
							} elseif ( 'cats' === $element ) {
								echo wp_kses_post( get_the_term_list( get_the_ID(), 'download_category', '<div class="cwp-edd-cat cwp-elements">', ',', '</div>' ) );
							} elseif ( 'tags' === $element ) {
								echo wp_kses_post( get_the_term_list( get_the_ID(), 'download_tag', '<div class="cwp-edd-tag cwp-elements">', ',', '</div>' ) );
							} elseif ( 'author' === $element ) {
								echo "<div class='cwp-elements'>";
								echo esc_html( get_the_author() );
								echo '</div>';
							} elseif ( 'published-date' === $element ) {
								echo "<div class='cwp-elements'>";
								echo esc_html( get_the_date() );
								echo '</div>';
							} elseif ( 'title' === $element ) {
								?>
								<header class="entry-header cwp-elements">
									<?php
									the_title( '<h2 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">', '</a></h2>' );
									?>
								</header><!-- .entry-header -->
								<?php
							} elseif ( 'price' === $element ) {
								if ( ! edd_has_variable_prices( get_the_ID() ) ) {
									echo esc_html( edd_get_download_price( get_the_ID() ) );
								}
							} elseif ( 'cart' === $element ) {
								echo edd_get_purchase_link();//phpcs:ignore

							} elseif ( 'excerpt' === $element ) {
								?>
								<div class="entry-excerpt">
									<?php
									global $post;
									$length = cosmoswp_get_theme_options( 'edd-archive-content-length' );
									if ( ! $length ) {
										echo wp_kses_post( strip_shortcodes( $post->post_excerpt ) );
									} else {
										echo wp_kses_post( wp_trim_words( strip_shortcodes( $post->post_excerpt ), $length ) );
									}
									?>
								</div><!-- .entry-content -->
								<?php
							} elseif ( 'content' === $element ) {
								?>
								<div class="entry-content">
									<?php
									the_content();
									wp_link_pages(
										array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'cosmoswp' ),
											'after'  => '</div>',
										)
									);
									?>
								</div><!-- .entry-content -->
								<?php
							}
						}
						echo '</div>';
						?>
					</div><!---->
					<?php
				}
				echo '</div></div></div>';
			}
			wp_reset_postdata();
		}

		/**
		 * Callback functions for cosmoswp_dynamic_css,
		 * Add Dynamic Css
		 *
		 * @since    1.0.9
		 * @access   public
		 *
		 * @param array $dynamic_css Dynamic CSS.
		 * @return array
		 */
		public function dynamic_css( $dynamic_css ) {
			$edd_dynamic_css = array(
				'all'     => '',
				'tablet'  => '',
				'desktop' => '',
			);

			$edd_single_media_width = json_decode( cosmoswp_get_theme_options( 'edd-single-content-width' ), true );
			$device_types           = array_keys( $edd_dynamic_css );

			foreach ( $device_types as $device ) {
				if ( isset( $edd_single_media_width[ $device ] ) ) {
					$width_value        = $edd_single_media_width[ $device ];
					$main_content_css   = 'width:' . $width_value . '%;';
					$sidebar_width_calc = ( 100 === $width_value ) ? '100%' : 'calc(100% - ' . $width_value . '%';
					$sidebar_css        = 'width:' . $sidebar_width_calc . ( 'tablet' === $device || 'desktop' === $device ? ' - 40px)' : ')' ) . ';';

					$edd_dynamic_css[ $device ] .= "
				.cosmoswp-edd-single-grid-row .cwp-edd-download-gallery-content {
					{$main_content_css}
				}
				.cosmoswp-edd-single-sidebar {
					{$sidebar_css}
				}
			";
				}
			}

			/* Return */
			return is_array( $dynamic_css ) && ! empty( $dynamic_css ) ? array_merge_recursive( $dynamic_css, $edd_dynamic_css ) : $edd_dynamic_css;
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
			$this->display_edd_single();
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
				'selector'            => '#cwp-edd-single-main-content-wrapper',
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

			$css_settings = cosmoswp_get_settings_by_type( $all_settings, 'css', array( 'width' ) );
			return array_unique( array_merge( $css_refresher, $css_settings ) );
		}
	}
endif;

/**
 * Create Instance for CosmosWP_Edd_Single
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'cosmoswp_edd_single' ) ) {

	function cosmoswp_edd_single() {//phpcs:ignore
		return CosmosWP_Edd_Single::instance();
	}

	cosmoswp_edd_single()->run();
}
