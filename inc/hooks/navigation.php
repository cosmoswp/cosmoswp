<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('cosmoswp_posts_navigation')) :

    /**
     * Posts navigation
     *
     * @since cosmoswp 1.0.0
     *
     * @return void
     */
    function cosmoswp_posts_navigation() {
        if ( $GLOBALS['wp_query']->max_num_pages <= 1 ){
            return;
        }

        $blog_navigation_options = cosmoswp_get_theme_options('blog-navigation-options');
        if ('disable' == $blog_navigation_options) {
            return;
        }
        $blog_navigation_align = cosmoswp_get_theme_options('blog-navigation-align');
        $blog_navigation_align = ($blog_navigation_options != 'default') ? $blog_navigation_align : '';

        echo "<div class='grid-row'>";
        echo "<div class='grid-12'>";
        echo "<div class='cwp-blog-pagination " . $blog_navigation_align . "' id='cwp-blog-pagination'>";
        if ('default' == $blog_navigation_options) {
            // Previous/next page navigation.
            the_posts_navigation();
        } else {
            // Previous/next page navigation.
            the_posts_pagination(array(
                'prev_text'          => '&laquo; ',
                'next_text'          => ' &raquo;',
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'cosmoswp') . ' </span>',
            ));
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    add_action('cosmoswp_action_posts_navigation', 'cosmoswp_posts_navigation');
endif;

if (!function_exists('cosmoswp_post_navigation')) :

    /**
     * Post navigation
     *
     * @since cosmoswp 1.0.0
     *
     * @return void
     */
    function cosmoswp_post_navigation() {

        $blog_navigation_options = cosmoswp_get_theme_options('post-navigation-options');
        if ('default' == $blog_navigation_options) {
            // Previous/next page navigation.
            $args = array(
                'prev_text' => '<span class="title"><i class="fas fa-arrow-left"></i>' . esc_html__('Previous Post', 'cosmoswp') . '</span><span class="post-title">%title</span>',
                'next_text' => '<span class="title"><i class="fas fa-arrow-right"></i>' . esc_html__('Next Post', 'cosmoswp') . '</span><span class="post-title">%title</span>',
            );
            the_post_navigation($args);
        }
    }

    add_action('cosmoswp_action_post_navigation', 'cosmoswp_post_navigation');
endif;
