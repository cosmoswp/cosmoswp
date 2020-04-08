<?php
if (!defined('ABSPATH')) {
    exit;
}

/*Page Banner Options*/
$wp_customize->add_setting('cwp-banner-options-woo-archive', array(
    'default'           => $defaults['cwp-banner-options-woo-archive'],
    'sanitize_callback' => 'cosmoswp_sanitize_select'
));
$choices = cosmoswp_singular_post_page_banner_option();
$wp_customize->add_control('cwp-banner-options-woo-archive', array(
    'label'           => esc_html__('Banner Options', 'cosmoswp'),
    'choices'         => $choices,
    'section'         => $this->section,
    'settings'        => 'cwp-banner-options-woo-archive',
    'type'            => 'select'
));

/*Woo Single Sidebar*/
$wp_customize->add_setting('cwp-woo-archive-sidebar', array(
    'default'           => $defaults['cwp-woo-archive-sidebar'],
    'sanitize_callback' => 'cosmoswp_sanitize_select',
));
$wp_customize->add_control('cwp-woo-archive-sidebar', array(
    'label'       => esc_html__('Content/Sidebar', 'cosmoswp'),
    'choices'  => cosmoswp_sidebar_options(),
    'section'     => $this->section,
    'settings'    => 'cwp-woo-archive-sidebar',
    'type'        => 'select',
));

/*Feature Layout*/
$wp_customize->add_setting('cwc-archive-default-view', array(
    'default'           => $defaults['cwc-archive-default-view'],
    'sanitize_callback' => 'cosmoswp_sanitize_select'
));
$wp_customize->add_control('cwc-archive-default-view', array(
    'choices'  => array(
        'grid' => esc_html__('Grid', 'cosmoswp'),
        'list' => esc_html__('List', 'cosmoswp'),
    ),
    'label'    => esc_html__('Default View', 'cosmoswp'),
    'section'  => $this->section,
    'settings' => 'cwc-archive-default-view',
    'type'     => 'select'
));

/*Top Toolbar*/
$wp_customize->add_setting('cwc-archive-general-setting-msg', array(
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(
    new CosmosWP_Custom_Control_Heading(
        $wp_customize,
        'cwc-archive-general-setting-msg',
        array(
            'label'   => esc_html__('General Setting', 'cosmoswp'),
            'section' => $this->section,
        )
    )
);

/*Grid List*/
$wp_customize->add_setting('cwc-archive-show-grid-list', array(
    'default'           => $defaults['cwc-archive-show-grid-list'],
    'sanitize_callback' => 'cosmoswp_sanitize_checkbox'
));
$wp_customize->add_control('cwc-archive-show-grid-list', array(
    'label'    => esc_html__('Show Grid List', 'cosmoswp'),
    'section'  => $this->section,
    'settings' => 'cwc-archive-show-grid-list',
    'type'     => 'checkbox'
));

/*Number of result Bar*/
$wp_customize->add_setting('cwc-archive-show-result-number', array(
    'default'           => $defaults['cwc-archive-show-result-number'],
    'sanitize_callback' => 'cosmoswp_sanitize_checkbox'
));
$wp_customize->add_control('cwc-archive-show-result-number', array(
    'label'    => esc_html__('Show Result Number', 'cosmoswp'),
    'section'  => $this->section,
    'settings' => 'cwc-archive-show-result-number',
    'type'     => 'checkbox'
));

/*Sort Bar*/
$wp_customize->add_setting('cwc-archive-show-sort-bar', array(
    'default'           => $defaults['cwc-archive-show-sort-bar'],
    'sanitize_callback' => 'cosmoswp_sanitize_checkbox'
));
$wp_customize->add_control('cwc-archive-show-sort-bar', array(
    'label'    => esc_html__('Show Sort Bar', 'cosmoswp'),
    'section'  => $this->section,
    'settings' => 'cwc-archive-show-sort-bar',
    'type'     => 'checkbox'
));

/*Elements*/
$wp_customize->add_setting('cwc-archive-elements-msg', array(
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(
    new CosmosWP_Custom_Control_Heading(
        $wp_customize,
        'cwc-archive-elements-msg',
        array(
            'label'   => esc_html__('Elements', 'cosmoswp'),
            'section' => $this->section,
        )
    )
);

/*Woo Archive Elements*/
$wp_customize->add_setting('cwc-archive-elements', array(
    'default'           => $defaults['cwc-archive-elements'],
    'sanitize_callback' => 'cosmoswp_sanitize_multi_choices',
));
$choices = cosmoswp_woo_archive_elements_sorting();
$wp_customize->add_control(
    new CosmosWP_Custom_Control_Sortable(
        $wp_customize,
        'cwc-archive-elements',
        array(
            'choices'  => $choices,
            'section'  => $this->section,
            'settings' => 'cwc-archive-elements',
        )
    )
);

/*Align*/
$wp_customize->add_setting('cwc-archive-elements-align', array(
    'default'           => $defaults['cwc-archive-elements-align'],
    'sanitize_callback' => 'cosmoswp_sanitize_select',
));
$choices = cosmoswp_text_align();
$wp_customize->add_control(
    new CosmosWP_Custom_Control_Buttonset(
        $wp_customize,
        'cwc-archive-elements-align',
        array(
            'choices'  => $choices,
            'label'    => esc_html__('Elements Alignment', 'cosmoswp'),
            'section'  => $this->section,
            'settings' => 'cwc-archive-elements-align',
        )
    )
);

/*Content Length*/
$wp_customize->add_setting('cwc-archive-excerpt-length', array(
    'default'           => $defaults['cwc-archive-excerpt-length'],
    'sanitize_callback' => 'esc_attr'
));
$wp_customize->add_control('cwc-archive-excerpt-length', array(
    'label'       => esc_html__('Excerpt length (count words)', 'cosmoswp'),
    'description' => esc_html__('Please enter a number greater than 0.', 'cosmoswp'),
    'section'     => $this->section,
    'settings'    => 'cwc-archive-excerpt-length',
    'type'        => 'number'
));

/*Icon size*/
$wp_customize->add_setting('cwc-archive-list-media-width', array(
    'sanitize_callback' => 'cosmoswp_sanitize_slider_field',
    'default'           => $defaults['cwc-archive-list-media-width']
));
$wp_customize->add_control(
    new CosmosWP_Custom_Control_Slider(
        $wp_customize,
        'cwc-archive-list-media-width',
        array(
            'label'       => esc_html__('List View Image/Media Width (%)', 'cosmoswp'),
            'section'     => $this->section,
            'settings'    => 'cwc-archive-list-media-width',
            'input_attrs' => array(
                'min'  => 10,
                'max'  => 100,
                'step' => 1,
            ),
        )
    )
);