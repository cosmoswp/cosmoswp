jQuery(document).ready(function ($) {
    let cwp_window = $(window),
        cwp_body = $('body'),
        cwp_document = $(document),
        cwp_banner = $('.cwp-banner'),
        offcanvas_sidebar = $('.cwp-offcanvas-sidebar'),
        headermenu_sidebar = $('.cwp-header-menu-sidebar'),
        search_overlay_wrapper = $('.cwp-search-overlay-wrapper'),
        offcanvas_body_wrapper = $('.cwp-offcanvas-body-wrapper'),
        menu_wrapper = $('.cwp-menu-wrapper'),
        register = $('#register'),
        login = $('#login'),
        footer_wrapper = $('.cwp-footer-wrapper'),
        footer_wrapper_height = footer_wrapper.innerHeight(),
        dynamic_header = $('.cwp-dynamic-header'),
        overlay_fixed_header_height = dynamic_header.innerHeight(),
        main_body_wrapper = $('.cwp-body-main-wrap'),
        offcanvas_submenu_indicator = offcanvas_sidebar.data('submenu-icon'),
        scroll_top = $('.cwp-scroll-to-top');

    //Sticky Sidebar
    if (typeof $.fn.theiaStickySidebar !== 'undefined') {
        if (cwp_body.hasClass('add-sticky-sidebar')) {
            $('.cwp-ms-content-grid-column').theiaStickySidebar();
        }
    }
    /*Off Canvas*/
    function add_offcanvas_submenu_indicator() {
        offcanvas_sidebar.find('li').each(function () {
            let this_li = $(this);
            if (this_li.children('ul.sub-menu').length) {
                this_li
                    .children('a')
                    .prepend(
                        '<i class="submenu-icon ' + offcanvas_submenu_indicator + '"></i>'
                    );
            }
        });
        offcanvas_sidebar.find('.widget_nav_menu').each(function () {
            let this_nav = $(this);
            this_nav.addClass('navigation cwp-submenu-onclick');
        });
    }
    add_offcanvas_submenu_indicator();

    //Submenu icon click function
    cwp_document.on('click', '.submenu-icon', function (e) {
        e.preventDefault();
        let submenuIcon = $(this);
        submenuIcon.parent('a').siblings('.sub-menu').toggleClass('open');
    });

    function header_menu_sidebar_toggle() {
        $('.cwp-search-fullscreen-wrapper').removeClass('cwp-show-search');
        search_overlay_wrapper.removeClass('cwp-show-search');
        search_overlay_wrapper
            .closest('.grid-container')
            .removeClass('hide-elements');
        cwp_body.removeClass('cwp-show-menu-sidebar');
        cwp_body.removeClass('cwp-show-offcanvas-sidebar');
        cwp_body.removeClass('cwp-show-menu-slide');
    }

    cwp_document.on('click', '.cwp-popup-btn', function (e) {
        e.preventDefault();
        $('#cwp-popupModal').show();
        cwp_body.addClass('open-popup');
    });
    cwp_document.on('click', '#cwp-popupModal .cwp-close', function (e) {
        e.preventDefault();
        $('#cwp-popupModal').hide();
        cwp_body.removeClass('open-popup');
    });

    //fixed footer
    let bottom_value;
    function stickyFooter() {
        if (cwp_body.hasClass('cwp-sticky-footer')) {
            let footer_main = $('.cwp-dynamic-footer');
            if (cwp_window.width() > 768) {
                let footer_height = footer_main.innerHeight(),
                    fixed_footer_cwp_trigger_height = $(
                        '.cwp-sticky-footer-wrapper'
                    ).innerHeight();

                bottom_value = footer_height - fixed_footer_cwp_trigger_height;
                footer_main.css('bottom', -bottom_value);
            } else {
                footer_main.css('bottom', '');
            }
        }
    }
    $('.cwp-sticky-footer-btn').on('click', function (e) {
        e.preventDefault();
        if (!cwp_body.hasClass('cwp-sticky-footer')) {
            return;
        }
        if (cwp_window.width() <= 768) {
            return;
        }
        let footer_main = $('.cwp-dynamic-footer');
        footer_main.toggleClass('open-footer');
        if (footer_wrapper_height >= cwp_window.height() / 2) {
            footer_wrapper.addClass('scroll-footer');
            footer_wrapper.css('max-height', cwp_window.height() / 2);
            bottom_value = cwp_window.height() / 2;
            footer_main.css('bottom', -bottom_value);
            $('.cwp-scrollbar-inner').scrollbar();
        }
    });

    //footer parallax
    function parallaxFooter() {
        let win = cwp_window.height(),
            parallaxFooterHeight = win * 0.5;

        if (cwp_body.hasClass('cwp-parallax-footer')) {
            if (cwp_window.width() > 992) {
                let footer_height = $('.cwp-dynamic-footer').innerHeight();
                main_body_wrapper.css('margin-bottom', footer_height);
                if (footer_height > parallaxFooterHeight) {
                    let scrollbar_inner = $('.cwp-scrollbar-inner');
                    main_body_wrapper.css('margin-bottom', parallaxFooterHeight);
                    scrollbar_inner.css('max-height', parallaxFooterHeight);
                    scrollbar_inner.scrollbar();
                }
            } else {
                let main_body_wrapper_style = main_body_wrapper.attr('style');
                if (
                    typeof main_body_wrapper_style !== typeof undefined &&
                    main_body_wrapper_style !== false
                ) {
                    main_body_wrapper.removeAttr('style');
                }
            }
        }
    }
    parallaxFooter();

    //Blog grid convert in mobile devices
    function blogMainGridConvert() {
        if (cwp_window.width() < 992) {
            for (let i = 1; i <= 12; i++) {
                //$('.cwp-dynamic-footer .grid-'+i+'').removeClass('grid-'+i+'').addClass( 'grid-md-'+i+'');
                $(
                    '.cwp-body-main-wrap .cwp-grid-column.grid-' +
                    i +
                    ', .cwp-dynamic-footer .cwp-grid-column.grid-' +
                    i +
                    ''
                )
                    .removeClass('grid-' + i + '')
                    .addClass('grid-md-' + i + '');
            }
        }
    }
    blogMainGridConvert();

    //What happen on window scroll
    function stickyMenu() {
        let scrollTop = cwp_window.scrollTop();
        if (scrollTop > 250) {
            $('.cosmoswp-sticky').addClass('add-sticky');
            $('.scrollup').show();
            scroll_top.show();
        } else {
            $('.cosmoswp-sticky').removeClass('add-sticky');
            $('.scrollup').hide();
            scroll_top.hide();
        }
    }
    stickyMenu();

    // mobile devices sticky menu fix
    function menuStickyFix() {
        let scrollMobile = cwp_window.scrollTop();
        if (cwp_body.hasClass('admin-bar')) {
            if (cwp_window.width() < 768) {
                if (scrollMobile > 0) {
                    $('.cwp-header-sticky').css('top', '0');
                } else {
                    $('.cwp-header-sticky').css('top', '');
                }
            }
        }
    }

    /*scroll top*/
    scroll_top.click(function (e) {
        // When arrow is clicked
        $('body,html').animate(
            {
                scrollTop: 0, // Scroll to top of body
            },
            500
        );
        e.preventDefault();
    });

    //overlay fixed header top spacing
    function overlayFixedAndTransparentHeaderSpacing() {
        let added_height = 40;
        if (cwp_body.hasClass('gutentor-active')) {
            added_height = 0;
        }
        if (cwp_body.hasClass('cwp-overlay-fixed') && !cwp_body.hasClass('home')) {
            if (cwp_banner.length && dynamic_header.hasClass('cwp-header-sticky')) {
                main_body_wrapper.css('padding-top', '');
            } else if (cwp_banner.length) {
                main_body_wrapper.css('padding-top', '');
            } else {
                main_body_wrapper.css(
                    'padding-top',
                    overlay_fixed_header_height + added_height
                );
            }
        } else {
            if (
                cwp_body.hasClass('cwp-overlay-transparent') &&
                !cwp_body.hasClass('home')
            ) {
                if (cwp_banner.length) {
                    main_body_wrapper.css('padding-top', '');
                } else {
                    main_body_wrapper.css(
                        'padding-top',
                        overlay_fixed_header_height + added_height
                    );
                }
            }
        }
    }
    overlayFixedAndTransparentHeaderSpacing();

    function cosmoswpMasonry() {
        if (cwp_body.hasClass('cwp-masonry-blog')) {
            let $masonry_boxes = $('.cwp-dynamic-blog-content');
            $masonry_boxes.hide();

            let $container = $('.cwp-blog-grid-row');
            $container.imagesLoaded(function () {
                $masonry_boxes.fadeIn('slow');
                $container.masonry({
                    itemSelector: '.cwp-blog-grid',
                });
            });
            $masonry_boxes.show();

            $(window).resize(function () {
                $container.masonry('bindResize');
            });
        }
    }
    cosmoswpMasonry();

    /*Smooth Scroll with sticky header*/
    let cwp_header_wrap = $('#cwp-header-wrap'),
        cwp_main_wrap = $('#cwp-main-wrap'),
        cwp_scrolltype = cwp_main_wrap.data('scrolltype'),
        cwp_trigger_height = cwp_main_wrap.data('height-trigger-sticky'),
        cwp_sticky_color = cwp_main_wrap.data('sticky-color');
    function cosmosWPParallaxScroll(cwpHash) {
        let scrollTop = $(cwpHash).offset().top;
        if (typeof cwp_scrolltype !== 'undefined' || cwp_scrolltype !== null) {
            scrollTop = $(cwpHash).offset().top - cwp_header_wrap.height();
        }
        $('html, body').animate(
            {
                scrollTop: scrollTop,
            },
            800
        );
    }
    let locationHash = window.location.hash;
    if (
        locationHash !== '' &&
        document.getElementById(locationHash.substring(1, locationHash.length))
    ) {
        cosmosWPParallaxScroll(locationHash);
    }

    /*Load function used tobe here start*/
    /*Smooth Scroll*/
    $('a').on('click', function (e) {
        locationHash = this.hash;
        if (
            locationHash !== '' &&
            document.getElementById(locationHash.substring(1, locationHash.length)) &&
            $(locationHash).is(':visible') == true /*Fixed for tabs and hidden areas*/
        ) {
            cosmosWPParallaxScroll(locationHash);
            e.preventDefault();
        }
    });

    //sticky footer
    stickyFooter();

    //parallax footer
    parallaxFooter();

    //search click function
    cwp_document.on('click', '#search-icon', function (e) {
        e.preventDefault();
        $('.cwp-search-dropdown').toggleClass('is-active-dropdown');
    });

    //search full screen
    cwp_document.on('click', '#search-fullscreen-icon', function (e) {
        e.preventDefault();
        $('.cwp-search-fullscreen-wrapper').addClass('cwp-show-search');
    });

    //search overlay screen
    cwp_document.on('click', '#search-overlay-icon', function (e) {
        e.preventDefault();
        search_overlay_wrapper.addClass('cwp-show-search');
        search_overlay_wrapper.closest('.grid-container').addClass('hide-elements');
    });

    //Global Close Button
    cwp_document.on('click', '.cwp-close-btn', function (e) {
        e.preventDefault();
        header_menu_sidebar_toggle();
    });

    //login/register
    $('.login').on('click', '.login-icon-text', function (e) {
        e.preventDefault();
        $('.form-wrapper').toggleClass('show-form');
    });
    register.hide();
    $('#register-form').on('click', function (e) {
        e.preventDefault();
        login.hide();
        $register.show();
    });
    $('#login-form').on('click', function (e) {
        e.preventDefault();
        login.show();
        register.hide();
    });

    //Toggle Dropdown Menu
    cwp_document.on('click', '.cwp-toggle-dropdown-btn', function (e) {
        e.preventDefault();
        let btn_this = $(this);
        $('.cwp-header-menu-toggle-dropdown').animate(
            {
                height: 'toggle',
            },
            500
        );
        let clicks = btn_this.data('clicks');
        if (clicks) {
            btn_this.find('.cwp-open-icon').show();
            btn_this.find('.cwp-close-icon').hide();
        } else {
            btn_this.find('.cwp-open-icon').hide();
            btn_this.find('.cwp-close-icon').show();
        }
        btn_this.data('clicks', !clicks);
    });

    //Sidebar Slide/Push Menu
    if (headermenu_sidebar.hasClass('cwp-left-menu-push')) {
        menu_wrapper.addClass('cwp-left-push');
    }
    if (headermenu_sidebar.hasClass('cwp-right-menu-push')) {
        menu_wrapper.addClass('cwp-right-push');
    }

    cwp_document.on('click', '#cwp-menu-icon-btn-text', function (e) {
        e.preventDefault();
        cwp_body.addClass('cwp-show-menu-sidebar');
        e.stopPropagation();
    });

    //Offcanvas Sidebar
    if (offcanvas_sidebar.hasClass('cwp-offcanvas-left')) {
        offcanvas_body_wrapper.addClass('cwp-offcanvas-left-push');
    }
    if (offcanvas_sidebar.hasClass('cwp-offcanvas-right')) {
        offcanvas_body_wrapper.addClass('cwp-offcanvas-right-push');
    }

    cwp_document.on('click', '.cwp-offcanvas-btn', function (e) {
        e.preventDefault();
        cwp_body.addClass('cwp-show-offcanvas-sidebar');
    });

    // Scrollup & Scrolldown sticky header
    let previousscroll = 0,
        scrollup = false,
        scrolldown = true,
        prevhighestdownscroll = 0;

    cwp_window.scroll(function () {
        let scrolltop = $(this).scrollTop();
        if (typeof cwp_scrolltype !== 'undefined' || cwp_scrolltype !== null) {
            if (previousscroll > scrolltop) {
                scrollup = true;
                scrolldown = false;
            } else {
                scrolldown = true;
                scrollup = false;
                prevhighestdownscroll = scrolltop;
            }
            if (scrollup) {
                if (Math.abs(prevhighestdownscroll - cwp_trigger_height) > scrolltop) {
                    if (cwp_scrolltype === 'cwp-scroll-up-sticky') {
                        cwp_header_wrap.addClass('cwp-scroll-up-sticky');
                        if (cwp_sticky_color === 'enable') {
                            cwp_header_wrap.addClass('sticky-color');
                        }
                    }
                    if (scrolltop === 0) {
                        if (cwp_scrolltype === 'cwp-scroll-up-sticky') {
                            cwp_header_wrap.removeClass('cwp-scroll-up-sticky');
                        } else if (cwp_scrolltype === 'cwp-scroll-down-sticky') {
                            cwp_header_wrap.removeClass('cwp-scroll-down-sticky');
                        }
                        cwp_header_wrap.removeClass('sticky-color');
                    }
                }
            }
            if (scrolldown) {
                if (scrolltop > cwp_trigger_height) {
                    if (cwp_scrolltype === 'cwp-scroll-down-sticky') {
                        cwp_header_wrap.addClass('cwp-scroll-down-sticky');
                        if (cwp_sticky_color === 'enable') {
                            cwp_header_wrap.addClass('sticky-color');
                        }
                    }
                }
            }
            previousscroll = scrolltop;
        }
        if (scrolltop >= 100) {
            if (cwp_scrolltype === 'normal') {
                if (cwp_sticky_color === 'enable') {
                    cwp_header_wrap.addClass('sticky-color');
                }
            }
        } else {
            cwp_header_wrap.removeClass('sticky-color');
        }

        // mobile devices sticky menu fix
        menuStickyFix();
    });
    /* add global widget title and content align class */
    let cosmoswp_sidebar = $('.cwp-sidebar'),
        global_widget_title_align = cosmoswp_sidebar.data('widget-title'),
        global_widget_content_align = cosmoswp_sidebar.data('widget-content');

    add_widget_element_align_class(
        cosmoswp_sidebar,
        'widget-title',
        global_widget_title_align
    );
    add_widget_element_align_class(
        cosmoswp_sidebar,
        'widget',
        global_widget_content_align
    );

    /*add footer widget title and  content align class*/
    //top footer
    let footer_sidebar = $('.cwp-footer-sidebar'),
        footer_top = $('.cwp-top-footer'),
        top_footer_widget_title_align = footer_top.data('widget-title'),
        top_footer_widget_content_align = footer_top.data('widget-content');

    add_widget_element_align_class(
        footer_top,
        'widget-title',
        top_footer_widget_title_align
    );
    add_widget_element_align_class(
        footer_top,
        'widget',
        top_footer_widget_content_align
    );

    //main footer
    let main_top = $('.cwp-main-footer'),
        main_footer_widget_title_align = main_top.data('widget-title'),
        main_footer_widget_content_align = main_top.data('widget-content');
    add_widget_element_align_class(
        main_top,
        'widget-title',
        main_footer_widget_title_align
    );
    add_widget_element_align_class(
        main_top,
        'widget',
        main_footer_widget_content_align
    );

    //bottom footer
    let bottom_top = $('.cwp-bottom-footer'),
        bottom_footer_widget_title_align = bottom_top.data('widget-title'),
        bottom_footer_widget_content_align = bottom_top.data('widget-content');
    add_widget_element_align_class(
        bottom_top,
        'widget-title',
        bottom_footer_widget_title_align
    );
    add_widget_element_align_class(
        bottom_top,
        'widget',
        bottom_footer_widget_content_align
    );

    footer_sidebar.each(function () {
        let this_footer_sidebar = $(this);
        if (
            this_footer_sidebar.hasClass('cwp-text-left') ||
            this_footer_sidebar.hasClass('cwp-text-right') ||
            this_footer_sidebar.hasClass('cwp-text-center')
        ) {
            this_footer_sidebar
                .find('.widget')
                .removeClass('cwp-text-left cwp-text-right cwp-text-center');
            this_footer_sidebar
                .find('.widget-title')
                .removeClass('cwp-text-left cwp-text-right cwp-text-center');
        }
    });
    /*Load function used tobe here end*/

    function add_widget_element_align_class(
        widget_wrapper,
        widget_elemet,
        align_class
    ) {
        widget_wrapper.find('.' + widget_elemet).each(function () {
            $(this).addClass(align_class);
        });
    }

    cwp_window.resize(function () {
        parallaxFooter();
        stickyFooter();
        blogMainGridConvert();
    });

    cwp_window.on('scroll', function (e) {
        setTimeout(function () {
            stickyMenu();
        }, 300);
    });

    function toggleMenu() {
        $('.main-navigation').slideToggle();
    }
    cwp_body.on('click', '.navbar-toggle', function (e) {
        e.preventDefault();
        toggleMenu();
    });

    //webTicker
    if (typeof $.fn.webTicker !== 'undefined') {
        $('#webTicker').show().webTicker({
            startEmpty: false,
            hoverpause: true,
            direction: 'left',
            transition: 'linear',
        });
    }

    /*Ajax pagination style*/
    let paged = parseInt(cosmoswp.paged) + 1,
        max_num_pages = parseInt(cosmoswp.max_num_pages),
        next_posts = cosmoswp.next_posts;

    cwp_document.on('click', '.cwp-ajax-show-more', function (e) {
        e.preventDefault();
        let show_more = $(this),
            click = show_more.attr('data-click'),
            page = parseInt(show_more.attr('data-number'));

        if (paged - 1 >= max_num_pages) {
            show_more.html(cosmoswp.no_more_posts);
        }

        if (click === 0 || paged - 1 >= max_num_pages) {
            return false;
        }
        show_more.html('<img src=' + cosmoswp.loadMoreGif + ' alt=”animated” />');
        show_more.attr('data-click', 0);

        $('#cwp-ajax-temp-post').load(
            next_posts + ' .cwp-article-ajax',
            function () {
                /*http://stackoverflow.com/questions/17780515/append-ajax-items-to-masonry-with-infinite-scroll*/
                paged++; /*next page number*/
                next_posts = next_posts.replace(
                    /(\/?)page(\/|d=)[0-9]+/,
                    '$1page$2' + paged
                );
                let cwp_temp_post = $('#cwp-ajax-temp-post'),
                    html = cwp_temp_post.html();

                cwp_temp_post.html('');

                // Make jQuery object from HTML string
                let $moreBlocks = $(html).filter('.cwp-article-ajax');

                // Append new blocks to container
                $('.cwp-blog-grid-row').append($moreBlocks);

                show_more.attr('data-number', page + 1);
                show_more.attr('data-click', 1);
                show_more.html(cosmoswp.show_more);
            }
        );
        return false;
    });

    /*auto ajax*/
    if ('auto-ajax' === cosmoswp.pagination_option) {
        let $content = $('body #cwp-main');
        cwp_window.scroll(function () {
            let content_offset = $content.offset();
            if (
                cwp_window.scrollTop() + cwp_window.height() >
                $content.scrollTop() + $content.height() + content_offset.top
            ) {
                $('.cwp-ajax-show-more').trigger('click');
            }
        });
    }

    /*Woo Grid List*/
    function cwp_woo_view_switcher() {
        let cwp_woo_view_switcher = $('.cwp-woo-view-switcher'),
            cosmoswp_woo_archive_grid_row = $('.cosmoswp-woo-archive-grid-row');

        cwp_woo_view_switcher.on('click', '.cwp-trigger-grid', function () {
            cosmoswp_woo_archive_grid_row.addClass('cwp-grid');
            cosmoswp_woo_archive_grid_row.removeClass('cwp-list');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });

        cwp_woo_view_switcher.on('click', '.cwp-trigger-list', function () {
            cosmoswp_woo_archive_grid_row.addClass('cwp-list');
            cosmoswp_woo_archive_grid_row.removeClass('cwp-grid');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });
    }
    cwp_woo_view_switcher();

    /*Edd Grid List*/
    function cwp_edd_view_switcher() {
        let cwp_edd_view_switcher = $('.cwp-edd-view-switcher'),
            cosmoswp_edd_archive_grid_row = $('.cosmoswp-edd-grid-row');

        if (cosmoswp_edd_archive_grid_row.hasClass('cwp-grid')) {
            $('.cwp-trigger-grid').addClass('active');
        }
        cwp_edd_view_switcher.on('click load', '.cwp-trigger-grid', function (e) {
            e.preventDefault();
            cosmoswp_edd_archive_grid_row.addClass('cwp-grid');
            cosmoswp_edd_archive_grid_row.removeClass('cwp-list');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });

        cwp_edd_view_switcher.on('click', '.cwp-trigger-list', function (e) {
            e.preventDefault();
            cosmoswp_edd_archive_grid_row.addClass('cwp-list');
            cosmoswp_edd_archive_grid_row.removeClass('cwp-grid');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });
    }
    cwp_edd_view_switcher();
    cwp_document.on('change', '#cosmoswp-edd-select-filter', function (e) {
        e.preventDefault();
        let orderby = $('#cosmoswp-edd-select-filter').val(),
            modified_href = '?sortby=' + orderby;

        modified_href = encodeURI(modified_href);
        window.history.pushState(null, null, modified_href);
        location.reload();
    });
    /*WooCommerce Responsive Primary Sidebar*/
    cwp_document.on('click', '.cwc-archive-psp-sm-toggle', function (e) {
        e.preventDefault();
        $(cwp_body).toggleClass('cwc-archive-psp-responsive-popup');
    });
    cwp_window.resize(function () {
        if (cwp_window.width() > 767) {
            $(cwp_body).removeClass('cwc-archive-psp-responsive-popup');
        }
    });
});
