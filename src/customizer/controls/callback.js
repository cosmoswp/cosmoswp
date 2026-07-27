// Central repository for all active callback functions
window.cosmoswpActiveCallbacks = {
  // EDD Cart Callbacks
  cosmoswp_is_enable_edd_cart: function () {
    return wp.customize("cwp-enable-edd-cart").get();
  },
  // WooCommerce Cart Callbacks
  cosmoswp_is_enable_woo_cart: function () {
    return wp.customize("cwp-enable-woo-cart").get();
  },
  // WooCommerce Wishlist
  cosmoswp_is_enable_woo_wishlist: function () {
    return wp.customize("cwp-enable-woo-wishlist").get();
  },

  // Header Layout Callbacks
  cosmoswp_header_layout_if_horizontal: function () {
    const options = ["normal", "cwp-overlay-fixed"];
    return options.includes(wp.customize("header-position-options").get());
  },

  cosmoswp_header_layout_if_vertical: function () {
    return wp.customize("header-position-options").get() === "vertical-header";
  },

  cosmoswp_header_layout_if_horizontal_and_sticky_enable: function () {
    const headerLayout = wp.customize("header-position-options").get();
    const stickyHeader = wp.customize("sticky-header-options").get();
    return (
      ["normal", "cwp-overlay-fixed"].includes(headerLayout) &&
      stickyHeader !== "disable"
    );
  },

  cosmoswp_sticky_header_color_options_enable: function () {
    const headerLayout = wp.customize("header-position-options").get();
    const stickyHeader = wp.customize("sticky-header-options").get();
    const stickyColor = wp
      .customize("enable-sticky-header-color-options")
      .get();
    return (
      ["normal", "cwp-overlay-fixed"].includes(headerLayout) &&
      stickyHeader !== "disable" &&
      stickyColor
    );
  },

  cosmoswp_header_layout_if_horizontal_and_scrollup_down: function () {
    const headerLayout = wp.customize("header-position-options").get();
    const stickyHeader = wp.customize("sticky-header-options").get();
    return (
      ["normal", "cwp-overlay-fixed"].includes(headerLayout) &&
      ["scroll-down", "scroll-up"].includes(stickyHeader)
    );
  },

  // Sticky Header Callbacks
  cosmoswp_sticky_header_if_scroll_down_up: function () {
    const stickyHeader = wp.customize("sticky-header-options").get();
    return (
      ["scroll-down", "scroll-up"].includes(stickyHeader) &&
      stickyHeader !== "disable"
    );
  },

  // Footer Callbacks
  cosmoswp_footer_sidebar_1_custom_widget_setting: function () {
    return (
      wp.customize("footer-sidebar-1-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_main_height_if_custom: function () {
    return wp.customize("footer-main-height-option").get() === "custom";
  },

  // Typography Callbacks
  cosmoswp_footer_top_widget_title_typography_if_custom: function () {
    return (
      wp.customize("footer-top-widget-title-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_footer_menu_title_typography_if_custom: function () {
    return (
      wp.customize("footer-menu-title-typography-options").get() === "custom"
    );
  },

  cosmoswp_footer_top_widget_content_typography_if_custom: function () {
    return (
      wp.customize("footer-top-widget-content-typography-options").get() ===
      "custom"
    );
  },

  // Background Callbacks
  cosmoswp_footer_general_bg_option_color: function () {
    return wp.customize("footer-general-bg-options").get() === "color";
  },

  cosmoswp_footer_general_bg_option_image: function () {
    return wp.customize("footer-general-bg-options").get() === "image";
  },

  cosmoswp_footer_general_bg_enable_overlay: function () {
    return (
      wp.customize("enable-footer-general-bg-overlay-color").get() === true
    );
  },

  // Menu Indicator Callbacks
  cosmoswp_menu_indicator_if_text_or_both: function () {
    const options = ["text", "both"];
    return options.includes(wp.customize("menu-icon-open-icon-options").get());
  },

  cosmoswp_menu_close_indicator_if_text_or_both: function () {
    const options = ["text", "both"];
    return options.includes(wp.customize("menu-icon-close-icon-options").get());
  },

  cosmoswp_menu_indicator_if_icon_or_both: function () {
    const options = ["icon", "both"];
    return options.includes(wp.customize("menu-icon-open-icon-options").get());
  },

  cosmoswp_menu_close_indicator_if_icon_or_both: function () {
    const options = ["icon", "both"];
    return options.includes(wp.customize("menu-icon-close-icon-options").get());
  },

  cosmoswp_menu_indicator_if_both: function () {
    return wp.customize("menu-icon-open-icon-options").get() === "both";
  },

  cosmoswp_menu_close_indicator_if_both: function () {
    return wp.customize("menu-icon-close-icon-options").get() === "both";
  },

  // Menu Typography Callbacks
  cosmoswp_menu_icon_typography_if_custom: function () {
    return (
      wp.customize("menu-open-icon-typography-options").get() === "custom" &&
      wp.customize("menu-icon-open-icon-options").get() !== "icon"
    );
  },

  cosmoswp_menu_close_typography_if_custom: function () {
    return (
      wp.customize("menu-icon-close-text-typography-options").get() ===
        "custom" &&
      wp.customize("menu-icon-close-icon-options").get() !== "icon"
    );
  },

  // Off Canvas Callbacks
  cosmoswp_off_canvas_indicator_if_text_or_both: function () {
    const options = ["text", "both"];
    return options.includes(wp.customize("off-canvas-open-icon-options").get());
  },

  cosmoswp_off_canvas_close_indicator_if_text_or_both: function () {
    const options = ["text", "both"];
    return options.includes(
      wp.customize("off-canvas-close-icon-options").get(),
    );
  },

  cosmoswp_off_canvas_indicator_if_icon_or_both: function () {
    const options = ["icon", "both"];
    return options.includes(wp.customize("off-canvas-open-icon-options").get());
  },

  cosmoswp_off_canvas_close_indicator_if_icon_or_both: function () {
    const options = ["icon", "both"];
    return options.includes(
      wp.customize("off-canvas-close-icon-options").get(),
    );
  },

  cosmoswp_off_canvas_indicator_if_both: function () {
    return wp.customize("off-canvas-open-icon-options").get() === "both";
  },

  // Search Typography Callbacks
  cosmoswp_dd_search_typography_if_custom: function () {
    return wp.customize("dd-search-typography-options").get() === "custom";
  },

  cosmoswp_normal_search_typography_if_custom: function () {
    return wp.customize("normal-search-typography-options").get() === "custom";
  },

  // Header Background Callbacks
  cosmoswp_top_header_bg_if_color: function () {
    return wp.customize("top-header-background-options").get() === "color";
  },

  cosmoswp_top_header_bg_if_image: function () {
    return wp.customize("top-header-background-options").get() === "image";
  },

  cosmoswp_main_header_bg_if_color: function () {
    return wp.customize("main-header-background-options").get() === "color";
  },

  cosmoswp_main_header_bg_if_image: function () {
    return wp.customize("main-header-background-options").get() === "image";
  },

  cosmoswp_bottom_header_bg_if_color: function () {
    return wp.customize("bottom-header-background-options").get() === "color";
  },

  cosmoswp_bottom_header_bg_if_image: function () {
    return wp.customize("bottom-header-background-options").get() === "image";
  },

  // Responsive Menu Callbacks
  cosmoswp_responsive_menu_if_custom_breakpoints: function () {
    return wp.customize("responsive-menu-breakpoints").get() === "custom";
  },

  cosmoswp_responsive_menu_style_if_off_canvas: function () {
    return wp.customize("responsive-menu-style").get() === "off-canvas";
  },

  cosmoswp_responsive_menu_style_if_dropdown: function () {
    return wp.customize("responsive-menu-style").get() === "dropdown";
  },

  cosmoswp_responsive_menu_style_if_full_screen: function () {
    return wp.customize("responsive-menu-style").get() === "full-screen";
  },

  // Header Top Callbacks
  cosmoswp_if_default_header_top: function () {
    return wp.customize("header-top-options").get() === "default";
  },

  cosmoswp_if_html_header_top: function () {
    return wp.customize("header-top-options").get() === "html";
  },

  cosmoswp_if_not_hide_header_top: function () {
    return wp.customize("header-top-options").get() !== "hide";
  },

  cosmoswp_if_display_header_top_post: function () {
    return (
      wp.customize("header-top-options").get() === "default" &&
      wp.customize("header-top-posts-display-options").get() !== "hide"
    );
  },

  // Copyright Callbacks
  cosmoswp_if_not_hide_copyright_layout: function () {
    return wp.customize("footer-copyright-layout-option").get() !== "hide";
  },

  cosmoswp_if_custom_power_text: function () {
    return (
      wp.customize("footer-copyright-layout-option").get() !== "hide" &&
      wp.customize("footer-power-text-option").get() === "custom"
    );
  },

  // Front Page Callbacks
  cosmoswp_active_callback_front_page_header: function () {
    return wp.customize("front-page-hide-content").get() !== 1;
  },

  // Background Custom Callbacks
  cosmoswp_header_top_bg_if_custom: function () {
    return wp.customize("header-top-bg-options").get() === "custom";
  },

  cosmoswp_global_sidebar_widget_bg_if_custom: function () {
    return wp.customize("global-sidebar-widget-bg-options").get() === "custom";
  },

  cosmoswp_footer_top_bg_if_custom: function () {
    return wp.customize("footer-top-bg-options").get() === "custom";
  },

  // Height Custom Callbacks
  cosmoswp_header_top_height_if_custom: function () {
    return wp.customize("header-top-height-option").get() === "custom";
  },

  cosmoswp_footer_top_height_if_custom: function () {
    return wp.customize("footer-top-height-option").get() === "custom";
  },

  cosmoswp_header_main_height_if_custom: function () {
    return wp.customize("header-main-height-option").get() === "custom";
  },

  cosmoswp_header_main_bg_if_custom: function () {
    return wp.customize("header-main-bg-options").get() === "custom";
  },

  cosmoswp_footer_main_bg_if_custom: function () {
    return wp.customize("footer-main-bg-options").get() === "custom";
  },

  cosmoswp_header_bottom_height_if_custom: function () {
    return wp.customize("header-bottom-height-option").get() === "custom";
  },

  cosmoswp_footer_bottom_height_if_custom: function () {
    return wp.customize("footer-bottom-height-option").get() === "custom";
  },

  cosmoswp_header_bottom_bg_if_custom: function () {
    return wp.customize("header-bottom-bg-options").get() === "custom";
  },

  cosmoswp_footer_bottom_bg_if_custom: function () {
    return wp.customize("footer-bottom-bg-options").get() === "custom";
  },

  // Secondary Menu Callbacks
  cosmoswp_secondary_menu_if_custom_menu: function () {
    return (
      wp.customize(cosmoswp_header_builder().secondary_menu).get() === "custom"
    );
  },

  // Footer Menu Typography
  cosmoswp_footer_menu_typography_if_custom_selected: function () {
    return wp.customize("footer-menu-typography-options").get() === "custom";
  },

  // Site Identity Callbacks
  cosmoswp_site_title_typography_if_custom: function () {
    return wp.customize("site-identity-typography-options").get() === "custom";
  },

  cosmoswp_site_identity_with_logo_only: function () {
    return !!wp.customize("site-identity-sorting").get();
  },

  // Secondary Menu Typography
  cosmoswp_secondary_menu_typography_if_custom: function () {
    return wp.customize("secondary-menu-typography-options").get() === "custom";
  },

  cosmoswp_secondary_submenu_typography_if_custom: function () {
    return (
      wp.customize("secondary-menu-submenu-typography-options").get() ===
      "custom"
    );
  },

  // Primary Menu Typography
  cosmoswp_primary_menu_typography_if_custom: function () {
    return wp.customize("primary-menu-typography-options").get() === "custom";
  },

  cosmoswp_primary_submenu_typography_if_custom: function () {
    return (
      wp.customize("primary-menu-submenu-typography-options").get() === "custom"
    );
  },

  // Button Typography
  cosmoswp_button_one_typography_if_custom: function () {
    return wp.customize("button-one-typography-options").get() === "custom";
  },

  cosmoswp_site_button_typography_if_custom: function () {
    return wp.customize("site-button-typography-options").get() === "custom";
  },

  // Copyright Typography
  cosmoswp_copyright_typography_if_custom: function () {
    return (
      wp.customize("footer-copyright-typography-options").get() === "custom"
    );
  },

  // Contact Info Typography
  cosmoswp_contact_info_title_typography_if_custom: function () {
    return (
      wp.customize("contact-info-title-typography-options").get() === "custom"
    );
  },

  cosmoswp_contact_info_subtitle_typography_if_custom: function () {
    return (
      wp.customize("contact-info-subtitle-typography-options").get() ===
      "custom"
    );
  },

  // HTML Typography
  cosmoswp_html_typography_if_custom: function () {
    return wp.customize("html-typography-options").get() === "custom";
  },

  cosmoswp_footer_html_typography_if_custom: function () {
    return wp.customize("footer-html-typography-options").get() === "custom";
  },

  // Widget Typography
  cosmoswp_global_widget_title_typography_if_custom: function () {
    return (
      wp.customize("global-widget-title-typography-options").get() === "custom"
    );
  },

  cosmoswp_global_widget_content_typography_if_custom: function () {
    return (
      wp.customize("global-widget-content-typography-options").get() ===
      "custom"
    );
  },

  // Footer Display Style
  cosmoswp_footer_display_style_fixed: function () {
    return wp.customize("footer-display-style").get() === "fixed-footer";
  },

  // Button Icon
  cosmoswp_button_one_enable_icon: function () {
    return wp.customize("button-one-enable-icon").get();
  },

  // Banner Section
  cosmoswp_banner_section_display_enable: function () {
    const display = wp.customize("banner-section-display").get();
    return display !== "hide" && display !== "";
  },

  cosmoswp_single_custom_banner_title_display_enable: function () {
    const display = wp.customize("banner-section-display").get();
    const titleOption = wp.customize("single-banner-section-title").get();
    return display !== "hide" && titleOption === "custom-title";
  },

  cosmoswp_single_custom_banner_title_tag_active: function () {
    const display = wp.customize("banner-section-display").get();
    const titleOption = wp.customize("single-banner-section-title").get();
    return (
      display !== "hide" &&
      (titleOption === "custom-title" || titleOption === "default")
    );
  },

  cosmoswp_banner_section_display_color: function () {
    return wp.customize("banner-section-display").get() === "color";
  },

  cosmoswp_banner_section_display_image: function () {
    const display = wp.customize("banner-section-display").get();
    return ["normal-image", "bg-image", "video"].includes(display);
  },

  cosmoswp_enable_banner_image_option_bg_image: function () {
    return wp.customize("banner-section-display").get() === "bg-image";
  },

  cosmoswp_enable_overlay_active: function () {
    const display = wp.customize("banner-section-display").get();
    return ["color"].includes(display);
  },

  cosmoswp_enable_overlay_active_color_active: function () {
    const display = wp.customize("banner-section-display").get();
    const enableOverlay = wp.customize("enable-banner-overlay-color").get();
    return (
      enableOverlay && ["normal-image", "bg-image", "video"].includes(display)
    );
  },

  cosmoswp_banner_height_active_callback: function () {
    const display = wp.customize("banner-section-display").get();
    return ["video", "color", "bg-image"].includes(display);
  },

  // Breadcrumb
  cosmoswp_breadcrumb_active_callback: function () {
    return wp.customize("cosmoswp-breadcrumb-options").get() !== "disable";
  },

  cosmoswp_breadcrumb_with_banner_active_callback: function () {
    return wp.customize("cosmoswp-breadcrumb-options").get() !== "disable";
  },

  // Pagination
  cosmoswp_post_pagination_activecallback: function () {
    return wp.customize("post-navigation-options").get() === "default";
  },

  cosmoswp_blog_pagination_active: function () {
    const option = wp.customize("blog-navigation-options").get();
    return !["disable", "default"].includes(option);
  },

  cosmoswp_blog_numeric_pagination_active_callback: function () {
    return wp.customize("blog-navigation-options").get() === "numeric";
  },

  cosmoswp_blog_default_pagination_active_callback: function () {
    return wp.customize("blog-navigation-options").get() === "default";
  },

  // Blog Layout
  cosmoswp_blog_layout_column: function () {
    return wp.customize("blog-post-view-layout").get() === "column-layout";
  },

  // Footer Sidebar Alignment
  cosmoswp_footer_sidebar_2_align: function () {
    return (
      wp.customize("footer-sidebar-2-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_sidebar_3_align: function () {
    return (
      wp.customize("footer-sidebar-3-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_sidebar_4_align: function () {
    return (
      wp.customize("footer-sidebar-4-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_sidebar_5_align: function () {
    return (
      wp.customize("footer-sidebar-5-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_sidebar_6_align: function () {
    return (
      wp.customize("footer-sidebar-6-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_sidebar_7_align: function () {
    return (
      wp.customize("footer-sidebar-7-widget-setting-option").get() === "custom"
    );
  },

  cosmoswp_footer_sidebar_8_align: function () {
    return (
      wp.customize("footer-sidebar-8-widget-setting-option").get() === "custom"
    );
  },

  // Scroll Top Indicator
  cosmoswp_scroll_top_indicator_if_text_or_both: function () {
    const options = ["text", "both"];
    return options.includes(wp.customize("scroll-top-icon-options").get());
  },

  cosmoswp_scroll_top_indicator_if_both: function () {
    return wp.customize("scroll-top-icon-options").get() === "both";
  },

  cosmoswp_scroll_top_indicator_if_icon_or_both: function () {
    const options = ["icon", "both"];
    return options.includes(wp.customize("scroll-top-icon-options").get());
  },

  cosmoswp_scroll_top_indicator_if_custom: function () {
    return (
      wp.customize("scroll-top-icon-typography-options").get() === "custom" &&
      wp.customize("scroll-top-icon-options").get() !== "icon"
    );
  },

  // Advertisement
  cosmoswp_check_if_advertisment_image: function () {
    return wp.customize("advertisement-options").get() === "image";
  },

  cosmoswp_check_if_advertisment_custom: function () {
    return wp.customize("advertisement-options").get() === "custom";
  },

  // Woocommerce
  cosmoswp_is_wc_archive_psp_sm: function () {
    return wp.customize("cwc-archive-psp-sm").get();
  },

  // Footer Typography Callbacks
  cosmoswp_footer_main_widget_title_typography_if_custom: function () {
    return (
      wp.customize("footer-main-widget-title-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_footer_main_widget_content_typography_if_custom: function () {
    return (
      wp.customize("footer-main-widget-content-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_footer_bottom_widget_title_typography_if_custom: function () {
    return (
      wp.customize("footer-bottom-widget-title-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_footer_bottom_widget_content_typography_if_custom: function () {
    return (
      wp.customize("footer-bottom-widget-content-typography-options").get() ===
      "custom"
    );
  },

  // Pro
  cosmoswp_header_sidebar_widget_title_typography_if_custom: function () {
    return (
      wp.customize("header-sidebar-widget-title-typography-options").get() ===
      "custom"
    );
  },
  cosmoswp_off_canvas_widget_title_typography_if_custom: function () {
    return (
      wp.customize("off-canvas-widget-title-typography-options").get() ===
      "custom"
    );
  },
  cosmoswp_off_canvas_widget_content_typography_if_custom: function () {
    return (
      wp.customize("off-canvas-widget-content-typography-options").get() ===
      "custom"
    );
  },

  // Banner Callbacks
  cosmoswp_is_page_banner_custom: function () {
    return wp.customize("cosmoswp-banner-options-page").get() === "custom";
  },

  cosmoswp_is_post_banner_custom: function () {
    return wp.customize("cosmoswp-banner-options-post").get() === "custom";
  },

  cosmoswp_is_post_banner_image: function () {
    const postBannerOptions = wp
      .customize("cosmoswp-banner-options-post")
      .get();
    const postBannerCustomOptions = wp
      .customize("cosmoswp-custom-banner-options-post")
      .get();
    return (
      postBannerOptions === "custom" &&
      (postBannerCustomOptions === "bg-image" ||
        postBannerCustomOptions === "normal-image")
    );
  },

  cosmoswp_is_page_banner_image: function () {
    const pageBannerOptions = wp
      .customize("cosmoswp-banner-options-page")
      .get();
    const pageBannerCustomOptions = wp
      .customize("cosmoswp-custom-banner-options-page")
      .get();
    return (
      pageBannerOptions === "custom" &&
      (pageBannerCustomOptions === "bg-image" ||
        pageBannerCustomOptions === "normal-image")
    );
  },

  cosmoswp_is_post_banner_color: function () {
    const postBannerOptions = wp
      .customize("cosmoswp-banner-options-post")
      .get();
    const postBannerCustomOptions = wp
      .customize("cosmoswp-custom-banner-options-post")
      .get();
    return (
      postBannerOptions === "custom" && postBannerCustomOptions === "color"
    );
  },

  cosmoswp_is_page_banner_color: function () {
    const pageBannerOptions = wp
      .customize("cosmoswp-banner-options-page")
      .get();
    const pageBannerCustomOptions = wp
      .customize("cosmoswp-custom-banner-options-page")
      .get();
    return (
      pageBannerOptions === "custom" && pageBannerCustomOptions === "color"
    );
  },

  cosmoswp_is_page_banner_video: function () {
    const pageBannerOptions = wp
      .customize("cosmoswp-banner-options-page")
      .get();
    const pageBannerCustomOptions = wp
      .customize("cosmoswp-custom-banner-options-page")
      .get();
    return (
      pageBannerOptions === "custom" && pageBannerCustomOptions === "video"
    );
  },

  cosmoswp_is_post_banner_video: function () {
    const postBannerOptions = wp
      .customize("cosmoswp-banner-options-post")
      .get();
    const postBannerCustomOptions = wp
      .customize("cosmoswp-custom-banner-options-post")
      .get();
    return (
      postBannerOptions === "custom" && postBannerCustomOptions === "video"
    );
  },

  // Blog Meta Typography Callbacks
  cosmoswp_blog_primary_meta_typography_active: function () {
    return (
      wp.customize("blog-primary-meta-data-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_blog_secondary_meta_typography_active: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const secondary_typography_active = wp
      .customize("blog-secondary-meta-data-typography-options")
      .get();
    return (
      secondary_typography_active === "custom" &&
      design_template !== "blog-template3"
    );
  },

  // Post Meta Typography Callbacks
  cosmoswp_post_primary_meta_typography_active: function () {
    return (
      wp.customize("post-primary-meta-data-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_post_secondary_meta_typography_active: function () {
    return (
      wp.customize("post-secondary-meta-data-typography-options").get() ===
      "custom"
    );
  },

  // Blog Template Callbacks
  cosmoswp_design1_template_active: function () {
    return wp.customize("adv-blog-template-option").get() === "blog-template1";
  },

  cosmoswp_design2_template_active: function () {
    return wp.customize("adv-blog-template-option").get() === "blog-template2";
  },

  cosmoswp_design3_template_inactive: function () {
    return wp.customize("adv-blog-template-option").get() !== "blog-template3";
  },

  cosmoswp_design3_template_active: function () {
    return wp.customize("adv-blog-template-option").get() === "blog-template3";
  },

  // Blog Element Callbacks
  cosmoswp_disable_blog_element_sorting: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = [
      "blog-template1",
      "blog-template2",
      "blog-template3",
      "blog-template4",
      "blog-template5",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_enable_blog_element_checkbox: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = [
      "blog-template1",
      "blog-template2",
      "blog-template3",
      "blog-template4",
      "blog-template5",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_blog_element_categories_bg_color: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_blog_element_category_color_options: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_element_category_color_options: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template3"];
    return list_template.includes(design_template);
  },

  // Blog Meta Element Callbacks
  cosmoswp_enable_primary_meta_element_checkbox: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = [
      "blog-template1",
      "blog-template3",
      "blog-template4",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_disable_blog_primary_meta_sorting: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = [
      "blog-template1",
      "blog-template3",
      "blog-template4",
      "blog-template5",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_disable_blog_secondary_meta_sorting: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = [
      "blog-template1",
      "blog-template3",
      "blog-template4",
      "blog-template5",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_disable_blog_secondary_meta_properties: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template3"];
    return !list_template.includes(design_template);
  },

  cosmoswp_enable_blog_secondary_meta_bg_color: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template2"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_blog_secondary_meta_checkbox: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template1", "blog-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_blog_element_secondary_meta_checkbox: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = [
      "blog-template1",
      "blog-template2",
      "blog-template4",
      "blog-template5",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_primary_meta_categories_bg_color: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template1", "blog-template5"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_primary_meta_categories_text_color: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template1", "blog-template5"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_primary_meta_categories_border_color: function () {
    const design_template = wp.customize("adv-blog-template-option").get();
    const list_template = ["blog-template1", "blog-template5"];
    return list_template.includes(design_template);
  },

  cosmoswp_blog_button_typography_active: function () {
    return wp.customize("blog-button-typography-options").get() === "custom";
  },

  // Post Element Callbacks
  cosmoswp_enable_post_primary_meta_element_checkbox: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template3",
      "post-template4",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_primary_meta_categories_bg_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_primary_meta_categories_text_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_primary_meta_categories_border_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_primary_meta_bg_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template2"];
    return list_template.includes(design_template);
  },

  cosmoswp_disable_post_element_sorting: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template2",
      "post-template3",
      "post-template4",
      "post-template5",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_disable_post_primary_meta_sorting: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template3",
      "post-template4",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_disable_post_secondary_meta_sorting: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template3",
      "post-template4",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_enable_post_element_checkbox: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template2",
      "post-template3",
      "post-template4",
      "post-template5",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_element_secondary_meta_checkbox: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template3",
      "post-template4",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_element_secondary_element: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "post-template1",
      "post-template2",
      "post-template3",
      "post-template4",
      "post-template5",
    ];
    return list_template.includes(design_template);
  },

  cosmoswp_disable_post_element_secondary_element_categories: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = [
      "default",
      "post-template1",
      "post-template2",
      "post-template5",
    ];
    return !list_template.includes(design_template);
  },

  cosmoswp_disable_post_element_secondary_element_comment: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template1"];
    return !list_template.includes(design_template);
  },

  cosmoswp_enable_post_secondary_meta_categories_bg_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_secondary_meta_categories_text_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template4"];
    return list_template.includes(design_template);
  },

  cosmoswp_enable_post_secondary_meta_categories_border_color: function () {
    const design_template = wp.customize("adv-post-template-option").get();
    const list_template = ["post-template4"];
    return list_template.includes(design_template);
  },

  /**
   * Check if pagination is ajax or auto ajax
   *
   * @return boolean
   */
  cosmoswp_is_posts_navigation_ajax: function () {
    const blog_navigation_options = wp
      .customize("blog-navigation-options")
      .get();
    return (
      blog_navigation_options === "ajax" ||
      blog_navigation_options === "auto-ajax"
    );
  },

  /**
   * Check if button two typography is custom
   * @return boolean
   */
  cosmoswp_button_two_typography_if_custom: function () {
    return wp.customize("button-two-typography-options").get() === "custom";
  },

  /**
   * Enable Button two icon
   * @return boolean
   */
  cosmoswp_button_two_enable_icon: function () {
    return wp.customize("button-two-enable-icon").get();
  },

  // Dropdown Menu Indicator Callbacks
  cosmoswp_dropdown_menu_indicator_if_text_or_both: function () {
    const option_list = ["text", "both"];
    const choosed_option = wp.customize("dropdown-menu-icon-options").get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_dropdown_menu_close_indicator_if_text_or_both: function () {
    const option_list = ["text", "both"];
    const choosed_option = wp
      .customize("dropdown-menu-close-icon-options")
      .get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_dropdown_menu_indicator_if_icon_or_both: function () {
    const option_list = ["icon", "both"];
    const choosed_option = wp.customize("dropdown-menu-icon-options").get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_dropdown_menu_close_indicator_if_icon_or_both: function () {
    const option_list = ["icon", "both"];
    const choosed_option = wp
      .customize("dropdown-menu-close-icon-options")
      .get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_dropdown_menu_indicator_if_both: function () {
    return wp.customize("dropdown-menu-icon-options").get() === "both";
  },

  cosmoswp_dropdown_menu_close_indicator_if_both: function () {
    return wp.customize("dropdown-menu-close-icon-options").get() === "both";
  },

  // Dropdown Menu Customization Callbacks
  cosmoswp_dropdown_menu_if_custom_menu: function () {
    return wp.customize("dropdown-menu-selector").get() === "custom";
  },

  cosmoswp_dropdown_menu_typography_if_custom: function () {
    return wp.customize("dropdown-menu-typography-options").get() === "custom";
  },

  dropdown_menu_open_text_typography_if_custom: function () {
    const text_options = wp
      .customize("dropdown-menu-open-text-typography-options")
      .get();
    const icon_options = wp.customize("dropdown-menu-icon-options").get();
    return text_options === "custom" && icon_options !== "icon";
  },

  dropdown_menu_close_text_typography_if_custom: function () {
    const text_options = wp
      .customize("dropdown-menu-close-text-typography-options")
      .get();
    const icon_options = wp.customize("dropdown-menu-close-icon-options").get();
    return text_options === "custom" && icon_options !== "icon";
  },

  cosmoswp_dropdown_submenu_typography_if_custom: function () {
    return (
      wp.customize("dropdown-submenu-typography-options").get() === "custom"
    );
  },

  /**
   * Check if global form is enabled
   * @return boolean
   */
  cosmoswp_enable_global_form: function () {
    return Boolean(wp.customize("enable-global-form").get());
  },

  /**
   * Check if fullscreen search typography is custom
   * @return boolean
   */
  cosmoswp_fullscreen_search_typography_if_custom: function () {
    return (
      wp.customize("fullscreen-search-typography-options").get() === "custom"
    );
  },

  /**
   * Check if header sidebar widget title typography is custom
   * @return boolean
   */
  cosmoswp_header_sidebar_widget_title_typography_if_custom: function () {
    return (
      wp.customize("header-sidebar-widget-title-typography-options").get() ===
      "custom"
    );
  },

  /**
   * Check if header sidebar widget content typography is custom
   * @return boolean
   */
  cosmoswp_header_sidebar_widget_content_typography_if_custom: function () {
    return (
      wp.customize("header-sidebar-widget-content-typography-options").get() ===
      "custom"
    );
  },

  /**
   * Check if blog layout is column layout
   * @return boolean
   */
  cosmoswp_blog_layout_is_column: function () {
    return wp.customize("blog-post-view-layout").get() === "column-layout";
  },

  /**
   * Check if newscroller content is from category
   * @return boolean
   */
  is_cosmoswp_news_ticker_from_category: function () {
    return wp.customize("news-ticker-select-options").get() === "from-category";
  },

  /**
   * Check if news-scroller typography is custom
   * @return boolean
   */
  is_cosmoswp_news_ticker_typography_custom: function () {
    return wp.customize("news-ticker-typography-options").get() === "custom";
  },

  /**
   * Check if off-canvas icon typography is custom
   * @return boolean
   */
  cosmoswp_offcanvas_icon_typography_if_custom: function () {
    return (
      wp.customize("off-canvas-open-text-typography-options").get() === "custom"
    );
  },

  /**
   * Check if off-canvas widget title typography is custom
   * @return boolean
   */
  cosmoswp_off_canvas_widget_title_typography_if_custom: function () {
    return (
      wp.customize("off-canvas-widget-title-typography-options").get() ===
      "custom"
    );
  },

  /**
   * Check if off-canvas widget content typography is custom
   * @return boolean
   */
  cosmoswp_off_canvas_widget_content_typography_if_custom: function () {
    return (
      wp.customize("off-canvas-widget-content-typography-options").get() ===
      "custom"
    );
  },

  /**
   * Check if overlay search typography is custom
   * @return boolean
   */
  cosmoswp_overlay_search_typography_if_custom: function () {
    return wp.customize("overlay-search-typography-options").get() === "custom";
  },

  // Popup Indicator Callbacks
  cosmoswp_popup_indicator_if_text_or_both: function () {
    const option_list = ["text", "both"];
    const choosed_option = wp
      .customize("popup-sidebar-open-icon-options")
      .get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_popup_close_indicator_if_text_or_both: function () {
    const option_list = ["text", "both"];
    const choosed_option = wp
      .customize("popup-sidebar-close-icon-options")
      .get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_popup_indicator_if_icon_or_both: function () {
    const option_list = ["icon", "both"];
    const choosed_option = wp
      .customize("popup-sidebar-open-icon-options")
      .get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_popup_close_indicator_if_icon_or_both: function () {
    const option_list = ["icon", "both"];
    const choosed_option = wp
      .customize("popup-sidebar-close-icon-options")
      .get();
    return option_list.includes(choosed_option);
  },

  cosmoswp_popup_indicator_if_both: function () {
    return wp.customize("popup-sidebar-open-icon-options").get() === "both";
  },

  cosmoswp_popup_close_indicator_if_both: function () {
    return wp.customize("popup-sidebar-close-icon-options").get() === "both";
  },

  // Popup Typography Callbacks
  cosmoswp_popup_icon_typography_if_custom: function () {
    const text_options = wp
      .customize("popup-open-text-typography-options")
      .get();
    const icon_options = wp.customize("popup-sidebar-open-icon-options").get();
    return text_options === "custom" && icon_options !== "icon";
  },

  cosmoswp_popup_close_icon_typography_if_custom: function () {
    const text_options = wp
      .customize("popup-close-text-typography-options")
      .get();
    const icon_options = wp.customize("popup-sidebar-close-icon-options").get();
    return text_options === "custom" && icon_options !== "icon";
  },

  cosmoswp_popup_sidebar_widget_title_typography_if_custom: function () {
    return (
      wp.customize("popup-sidebar-widget-title-typography-options").get() ===
      "custom"
    );
  },

  cosmoswp_popup_sidebar_widget_content_typography_if_custom: function () {
    return (
      wp.customize("popup-sidebar-widget-content-typography-options").get() ===
      "custom"
    );
  },

  /**
   * Check if related posts are enabled (not set to 'disable')
   * @return boolean
   */
  cosmoswp_enable_related_post: function () {
    return wp.customize("cosmoswp-related-post-from").get() !== "disable";
  },

  /**
   * Check if sticky footer menu typography is custom
   * @return boolean
   */
  cosmoswp_sticky_footer_menu_typography_if_custom_selected: function () {
    return (
      wp.customize("sticky-footer-menu-typography-options").get() === "custom"
    );
  },

  /**
   * Check if sticky footer HTML typography is custom
   * @return boolean
   */
  cosmoswp_sticky_footer_html_typography_if_custom: function () {
    return (
      wp.customize("sticky-footer-html-typography-options").get() === "custom"
    );
  },

  cosmoswp_off_canvas_icon_typography_if_custom: function () {
    return (
      "custom" ===
        wp.customize("off-canvas-open-text-typography-options").get() &&
      "icon" !== wp.customize("off-canvas-open-icon-options").get()
    );
  },

  cosmoswp_off_canvas_close_icon_typography_if_custom: function () {
    return (
      "custom" ===
        wp.customize("off-canvas-close-text-typography-options").get() &&
      "icon" !== wp.customize("off-canvas-close-icon-options").get()
    );
  },
};
