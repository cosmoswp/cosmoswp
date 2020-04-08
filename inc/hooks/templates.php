<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package CosmosWP
 */

if (!function_exists('cosmoswp_filter_get_search_form')) :

    /**
     * Customize search form.
     *
     * @since 1.0.0
     *
     * @return string The search form HTML output.
     */
    function cosmoswp_filter_get_search_form($form) {

        $template = cosmoswp_get_theme_options('search-template-options');
        if($template == 'cwp-search-2'){
                $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
            <label>
                <span class="screen-reader-text">' . _x('Search for:', 'label', 'cosmoswp') . '</span>
                <input type="search" class="search-field" placeholder="' . esc_attr__('Search&hellip;', 'cosmoswp') . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x('Search for:', 'label', 'cosmoswp') . '" />
            </label>
            <input type="submit" class="search-submit" value="&#xf002;" /></form>';
        }

        return $form;

    }
    add_filter('get_search_form', 'cosmoswp_filter_get_search_form', 15);
endif;

if (!function_exists('cosmoswp_filter_excerpt_length')) :

    /**
     * Implement excerpt length
     *
     * @since 1.0.0
     *
     * @param int $length The number of words.
     * @return int Excerpt length.
     */
    function cosmoswp_filter_excerpt_length($length) {

        $excerpt_length = cosmoswp_get_theme_options('blog-excerpt-length');

        if (empty($excerpt_length) || ($excerpt_length <= 0)) {
            $excerpt_length = $length;
        }
        return apply_filters('cosmoswp_filter_excerpt_length', absint($excerpt_length));

    }

endif;

if (!function_exists('cosmoswp_filter_excerpt_more')) :

    /**
     * Implement read more in excerpt
     *
     * @since 1.0.0
     *
     * @param string $more The string shown within the more link.
     * @return string The excerpt.
     */
    function cosmoswp_filter_excerpt_more($more) {

        $flag_apply_excerpt_read_more = apply_filters('cosmoswp_filter_excerpt_read_more', true);
        if (true !== $flag_apply_excerpt_read_more) {
            return $more;
        }
        $output         = '&hellip;';
        $read_more_text = cosmoswp_get_theme_options('blog-read-more-text');
        if (!empty($read_more_text)) {
            $output .= ' <a href="' . esc_url(get_permalink()) . '" class="cosmoswp-btn">' . esc_html($read_more_text) . '</a>';
            $output = apply_filters('cosmoswp_filter_read_more_link', $output);
        }
        return $output;

    }

endif;

if (!function_exists('cosmoswp_filter_the_content_more_link')) :

    /**
     * Implement read more in content.
     *
     * @since 1.0.0
     *
     * @param string $more_link Read More link element.
     * @param string $more_link_text Read More text.
     * @return string Link.
     */
    function cosmoswp_filter_the_content_more_link($more_link, $more_link_text) {

        $flag_apply_excerpt_read_more = apply_filters('cosmoswp_filter_excerpt_read_more', true);

        if (true !== $flag_apply_excerpt_read_more) {
            return $more_link;
        }

        $read_more_text = cosmoswp_get_theme_options('blog-read-more-text');
        if (!empty($read_more_text)) {
            $more_link = str_replace($more_link_text, esc_html($read_more_text), $more_link);
            $more_link = str_replace('more-link', 'cosmoswp-btn', $more_link);

        }
        return $more_link;

    }

endif;

if (!function_exists('cosmoswp_featured_image_instruction')) :

    /**
     * Message to show in the Featured Image Meta box.
     *
     * @since 1.0.0
     *
     * @param string $content Admin post thumbnail HTML markup.
     * @param int    $post_id Post ID.
     * @return string HTML.
     */
    function cosmoswp_featured_image_instruction($content, $post_id) {

        $allowed = array('page');

        if (in_array(get_post_type($post_id), $allowed)) {
            $content .= '<strong>' . __('Recommended Image Sizes', 'cosmoswp') . ':</strong><br/>';
            $content .= __('Slider Image', 'cosmoswp') . ' : 1920px X 800px';
        }

        return $content;

    }

    add_filter('admin_post_thumbnail_html', 'cosmoswp_featured_image_instruction', 10, 2);
endif;

if (!function_exists('cosmoswp_hook_read_more_filters')) :

    /**
     * Hook read more filters.
     *
     * @since 1.0.0
     */
    function cosmoswp_hook_read_more_filters() {
        if (is_home() || is_category() || is_tag() || is_author() || is_date()) {

            add_filter('excerpt_length', 'cosmoswp_filter_excerpt_length', 999);
            add_filter('the_content_more_link', 'cosmoswp_filter_the_content_more_link', 10, 2);
            add_filter('excerpt_more', 'cosmoswp_filter_excerpt_more');
        }
    }

    add_action('wp', 'cosmoswp_hook_read_more_filters');
endif;

