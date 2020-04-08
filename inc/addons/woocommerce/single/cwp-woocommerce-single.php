<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * WooCommerce Single Customizer Options
 * @package CosmosWP
 */

if (!class_exists('CosmosWP_WooCommerce_Single')) :

    class CosmosWP_WooCommerce_Single {

        /**
         * Panel ID
         *
         * @var string
         * @access public
         * @since 1.0.0
         *
         */
        public $panel = 'cosmoswp-woocommerce-single';

        /**
         * Section ID
         *
         * @var string
         * @access public
         * @since 1.0.0
         *
         */
        public $section = 'cosmoswp-woocommerce-single';

        /**
         * Main Instance
         *
         * Insures that only one instance of CosmosWP_WooCommerce_Single exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since    1.0.0
         * @access   public
         *
         * @return object
         */
        public static function instance() {

            // Store the instance locally to avoid private static replication
            static $instance = null;

            // Only run these methods if they haven't been ran previously
            if (null === $instance) {
                $instance = new CosmosWP_WooCommerce_Single;
            }

            // Always return the instance
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

            add_filter('cosmoswp_default_theme_options', array($this, 'defaults'));
            add_action('customize_register', array($this, 'customize_register'), 100);

            add_action('cosmoswp_action_woocommerce_single', array($this, 'display_woo_single'), 110);
        }

        /**
         * Callback functions for cosmoswp_default_theme_options,
         * Add Header Builder defaults values
         *
         * @since    1.0.0
         * @access   public
         *
         * @param array $default_options
         * @return array
         */
        public function defaults($default_options = array()) {
            $defaults = array(

                /*Sidebar*/
                'cwp-woo-single-sidebar'    => 'ct-ps',

                'cwc-single-tab-show-content-heading' => '',
                'cwc-single-upsell-number'            => 4,
                'cwc-single-related-number'           => 4,
                'cwc-single-tab-design'               => 'default',
                'cwc-single-upsell-col'               => 4,
                'cwc-single-related-col'              => 4,
                'cwc-single-elements'                 => array('title', 'rating', 'price', 'excerpt', 'cart', 'metadata'),
                'cwc-single-media-width'              => json_encode(array(
                    'desktop' => '40',
                    'tablet'  => '40',
                    'mobile'  => '100',
                )),

            );

            return array_merge($default_options, $defaults);

        }

        /**
         * Callback functions for customize_register,
         * Add Panel Section control
         *
         * @since    1.0.0
         * @access   public
         *
         * @param object $wp_customize
         * @return void
         */
        public function customize_register($wp_customize) {
            $defaults = $this->defaults();

            /**
             * Panel
             */
            $wp_customize->add_panel($this->panel, array(
                'title'    => esc_html__('WooCommerce Single', 'cosmoswp'),
                'priority' => 120,
            ));

            /**
             * Section
             */
            $wp_customize->add_section( $this->section, array(
                'title'    => esc_html__(' Main Content', 'cosmoswp'),
                'priority' => 230,
                'panel'    => $this->panel,
            ));

            /* WOO Single Elements */
            require COSMOSWP_PATH.'/inc/addons/woocommerce/single/main-content.php';

        }

        /**
         * Callback Function for cosmoswp_action_woocommerce_single
         * Display WooCommerce Single Product
         *
         * @since    1.0.0
         * @access   public
         *
         * @return void
         */
        public function display_woo_single() {
            $sidebar = cosmoswp_get_theme_options('cwp-woo-single-sidebar');
            ?>
            <!-- Start of .blog-content-->
            <div class="cwp-page cwp-content-wrapper <?php echo esc_attr('cwp-'.$sidebar) ?> <?php cosmoswp_blog_main_wrap_classes(); ?>" id="cwp-blog-main-content-wrapper">
                <?php
                echo '<div class="grid-container"><div class="grid-row">';
                cosmoswp_sidebar_template($sidebar,'cwp-woo-single');
                echo '</div>';/*.grid-row*/
                echo '</div>';/*.grid-container*/
                ?>
            </div>
            <!-- End of .blog-content -->
            <?php
        }
    }
endif;

/**
 * Create Instance for CosmosWP_WooCommerce_Single
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if (!function_exists('cosmoswp_woocommerce_single')) {

    function cosmoswp_woocommerce_single() {

        return CosmosWP_WooCommerce_Single::instance();
    }

    cosmoswp_woocommerce_single()->run();
}