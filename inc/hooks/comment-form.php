<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('cosmoswp_alter_comment_form')) :

    /**
     * Comment Form
     *
     * @since CosmosWP 1.0.0
     *
     * @param array $form
     * @return array $form
     *
     */
    function cosmoswp_alter_comment_form($form) {

        $cosmoswp_comment_title       = esc_html(cosmoswp_get_theme_options('cosmoswp-comment-title'));
        $cosmoswp_comment_title       = ($cosmoswp_comment_title) ? $cosmoswp_comment_title : esc_html__('Leave a Reply', 'cosmoswp');
        $cosmoswp_comment_button_text = esc_html(cosmoswp_get_theme_options('cosmoswp-comment-button-text'));
        $cosmoswp_comment_button_text = ($cosmoswp_comment_button_text) ? $cosmoswp_comment_button_text : esc_html__('Post Comment', 'cosmoswp');
        $cosmoswp_comment_notes_after = esc_html(cosmoswp_get_theme_options('cosmoswp-comment-notes-after'));

        if (!empty ($cosmoswp_comment_notes_after)) {
            $form['comment_notes_after'] = $cosmoswp_comment_notes_after;
        }
        $required = get_option('require_name_email');
        $req      = $required ? 'aria-required="true"' : '';

        $form['fields']['author']     = '<p class="comment-form-author"><label for="author"></label><input id="author" name="author" type="text" placeholder="' . esc_attr__('Name', 'cosmoswp') . '" value="" size="30" ' . $req . '/></p>';
        $form['fields']['email']      = '<p class="comment-form-email"><label for="email"></label> <input id="email" name="email" type="email" value="" placeholder="' . esc_attr__('Email', 'cosmoswp') . '" size="30" ' . $req . ' /></p>';
        $form['fields']['url']        = '<p class="comment-form-url"><label for="url"></label> <input id="url" name="url" placeholder="' . esc_attr__('Website URL', 'cosmoswp') . '" type="url" value="" size="30" /></p>';
        $form['comment_field']        = '<p class="comment-form-comment"><label for="comment"></label> <textarea id="comment" name="comment" placeholder="' . esc_attr__('Comment', 'cosmoswp') . '" cols="45" rows="8" aria-required="true"></textarea></p>';
        $form['comment_notes_before'] = '';
        $form['label_submit']         = $cosmoswp_comment_button_text;
        $form['title_reply']          = '<span>' . $cosmoswp_comment_title . '</span>';

        return $form;
    }

    add_filter('comment_form_defaults', 'cosmoswp_alter_comment_form');
endif;

if (!function_exists('cosmoswp_move_comment_field_to_bottom')) {

    /* *
     *  re-order comment form e.g move comment to bottom
     *  @since CosmosWP 1.0.0
     *  @param array $fields
     */
    function cosmoswp_move_comment_field_to_bottom($fields) {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        $fields['comment'] = $comment_field;
        return $fields;
    }

    add_filter('comment_form_fields', 'cosmoswp_move_comment_field_to_bottom');
}