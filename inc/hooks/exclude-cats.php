<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('cosmoswp_exclude_category_in_blog_page')) :

    /**
     * Exclude category in blog page
     *
     * @since CosmosWP 1.0.0
     *
     * @param $query
     * @return int
     */
    function cosmoswp_exclude_category_in_blog_page($query) {

        if ($query->is_home && $query->is_main_query()) {
            $exclude_categories = cosmoswp_get_theme_options('blog-post-exclude-categories');
            if (!empty($exclude_categories) && is_array($exclude_categories)) {
                $exculde_cats = array_map(function ($val)
                {
                    return -$val;
                }, $exclude_categories);
                if (!empty($exculde_cats) && is_array($exculde_cats)) {
                    $query->set('cat', $exculde_cats);
                }
            }
        }
        return $query;
    }

    add_filter('pre_get_posts', 'cosmoswp_exclude_category_in_blog_page');

endif;
