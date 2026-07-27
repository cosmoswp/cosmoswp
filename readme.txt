=== CosmosWP ===

Contributors: cosmoswp
Tags: blog, e-commerce, portfolio, grid-layout, one-column, two-columns, three-columns, four-columns, left-sidebar, right-sidebar, custom-background, custom-colors, custom-header, custom-logo, custom-menu, editor-style, featured-images, flexible-header, footer-widgets, full-width-template, microformats, post-formats, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 3.0.2
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CosmosWP is a multi-purpose new generation modern WordPress theme, super-fast, easily customizable, flexible, beautiful, perfect, and highly extendable theme.

== Description ==

CosmosWP is a multi-purpose new generation modern Gutenberg WordPress theme, super-fast, easily customizable, flexible, beautiful, perfect, and highly extendable theme. With a simple download of the CosmosWP, you will have a striking and awesome theme for your website. A great way to design your website with a unique blend of style and technique. It will let you build around several kinds of a website such as a blog, portfolio, business, photography, entertainment etc. Also, specialized sites like Restaurant, Spa, Charity, Meditation, Wedding, Dentist, Education, Medical and much more. Being integrated with WooCommerce and Easy Digital Download you can even build an e-commerce based website. Besides that, it works well with almost all page builders as Gutentor, Elementor, SiteOrigin, Beaver Builder, Visual Composer, Divi, etc. Furthermore, features like SEO friendly, Responsive, RTL Ready, Translation Ready, Gutenberg compatible, and many other WordPress plugins compatible are also included in the theme. Finally, the theme already has an instant demo setup so you can commence your elegant and phenomenal website right away.

== Translation ==

CosmosWP theme is translation ready.

== License ==

CosmosWP WordPress Theme, Copyright 2019-2025 AcmeIT
CosmosWP is distributed under the terms of the GNU General Public License v2
The exceptions to license are as follows:

* Based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2015 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
* Font Awesome Free 5 by @fontawesome - https://fontawesome.com, License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
* jQuery CSS Customizable Scrollbar Copyright 2015, Yuriy Khabarov, Dual licensed under the MIT or GPL Version 2 licenses.
* wpness-grid Licensed MIT, Copyright © 2020, AcmeIT

== Screenshots ==

Logo, Copyright © 2020, AcmeIT
License: GNU GPL, Version 3, https://www.gnu.org/licenses/gpl-3.0.html

Vectors, Copyright © 2020, AcmeIT
License: GNU GPL, Version 3, https://www.gnu.org/licenses/gpl-3.0.html

Font Awesome Svg are all licensed under CC BY 4.0 (https://fontawesome.com/license/free)
https://fontawesome.com/icons


=== Images ===

License: GNU GPL, Version 3, https://www.gnu.org/licenses/gpl-3.0.html
logo files (logo-1.png to logo-5.png)
Copyright © 2020, AcmeIT

License: CC0 https://creativecommons.org/publicdomain/zero/1.0/

https://pxhere.com/en/photo/1674976
https://pxhere.com/en/photo/1629588
https://pxhere.com/en/photo/1058103
https://pxhere.com/en/photo/38727
https://pxhere.com/en/photo/764654
https://pxhere.com/en/photo/910324
https://pxhere.com/en/photo/764428
https://pxhere.com/en/photo/868229
https://pxhere.com/en/photo/695270
https://pxhere.com/en/photo/1278242
https://pxhere.com/en/photo/1594675

=== Icons Images ===

https://fontawesome.com/icons

Font Awesome Icons
Fonticons, Inc. (https://fontawesome.com)
License: CC BY 4.0 (https://fontawesome.com/license/free)
Source: https://github.com/FortAwesome/Font-Awesome

== Frequently Asked Questions ==

= How to install theme? =

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

= How to set Front Page and Home page? =

1. In the admin area, go to Pages > Add New
3. Again In the admin area, go to Settings > Reading
4. In Front page displays choose 'A static page (select below)' and select page for homepage/frontpage
4. The sidebar "Home Main Content Area" will display in homepage

= How to Customization site? =

1. In the admin area, go to Appearance > Customize
2. You will find different options in customizer


== Changelog ==

= 3.0.2 - 2026-07-28 =
* Fixed: Icon picker not working when icons list is an array.

= 3.0.1 - 2026-06-10 =
* Fixed: Footer widget alignment CSS specificity issue causing layout conflicts.
* Fixed: Blog sticky post border styling not applying when set via Customizer.
* Updated: POT file for translation consistency.
* Updated: Requires PHP from 7.0 to 7.4.

= 3.0.0 - 2026-06-05 =
* Fixed: Parse error on PHP 7.0-7.2 — removed trailing comma in wp_json_encode() function call in starter-content/index.php.
* Fixed: $current_user used without wp_get_current_user() in 2 locations — replaced with get_current_user_id().
* Fixed: $wp_filesystem null dereference in 3 locations — added null checks after WP_Filesystem() calls.
* Fixed: Footer sidebar customizer sections incorrectly forced active due to strpos() falsy return on IDs starting with 'footer-sidebar-'.
* Fixed: Mobile site identity alignment never resetting to default due to copy-paste error comparing against 'cwp-default-tablet' instead of 'cwp-default-mobile'.
* Added: Nonce verification and capability checks for notice dismissal.
* Added: Sanitization for all $_GET and $_POST superglobal access.
* Added: Output escaping in templates (get_the_title, option values, class attributes).
* Added: Alt attributes to all pattern images.
* Added: Screen-reader labels to search forms.
* Fixed: Trailing space in EDD orderby query parameter.
* Fixed: Trailing semicolons in theme.json spacing values.
* Fixed: Loose comparisons throughout.
* Fixed: Escape submenu icon classes.
* Updated: Requires PHP from 5.6 to 7.0 in style.css and readme.txt.
* Updated: Tested up to: 7.0.
* Updated: Standardized Font Awesome version string to 5.12.0 across all enqueue calls.
* Removed: Viewport zoom restriction for WCAG 1.4.4 compliance.

= 2.0.3 - 2025-09-16 =
* Fixed : Site identify

= 2.0.2 - 2025-09-15 =
* Updated: Try to fix Starter content on wp-themes.com.

= 2.0.1 - 2025-09-15 =
* Updated: Starter content

= 2.0.0 - 2025-09-15 =
* Added: React-based customizer for performance
* Added: Hybrid theme foundation
* Updated: Screenshot with latest design
* Updated: CSS management for better consistency
* Updated: Customizer design for improved usability
* Updated: Header and footer builder for a modern look

= 1.4.2 - 2025-01-16 =
* Updated: Starter content
* Updated: Use of wp_json_encode.

= 1.4.1 - 2025-01-16 =
* Updated: Starter content
* Updated: Use of wp_json_encode.

= 1.4.0 - 2025-01-16 =
* Added: Theme json
* Added: Starter content

= 1.3.9 - 2025-01-11 =
* Added: Improved compatibility with the latest WordPress version.
* Added: Introduced new license management directly from our site, https://templateberg.com/.

= 1.3.8 - 2024-04-04 =
* Added:    WordPress 6.5 compatibility

= 1.3.7 - 2023-08-24 =
* Added:    Enhanced compatibility with the latest WordPress version.
* Updated:  Improved handling of deprecated WordPress functions.
* Updated:  Further optimization of built-in features.

= 1.3.6 - 2022-06-17 =
* Added: WordPress 6 compatibility
* Added: New Google Fonts
* Updated : Some customizer options
* Updated : Some CSS options
* Fixed : Remove image in group control
* Fixed : Theme Options > Scroll Top > Button Styling > Border width missing in dynamic CSS
* Fixed : Line-height issue in theme scroll top line height
* Fixed : WooCommerce Single Product Tab Click

= 1.3.5 - 2022-02-03 =
* Added: WordPress 5.9 compatibility
* Updated : Some customizer options
* Fixed : Customizer controls margin and paddings
* Fixed : Widgets link color

= 1.3.4 - 2021-07-19 =
* Added: WordPress 5.8 compatibility
* Added: remove_theme_support('widgets-block-editor');
* Added: remove_theme_support('block-templates');

= 1.3.3 - 2021-06-15 =
* Added : New Google Fonts
* Updated : More Compatibility with Gutentor
* Updated : Boxshadow allow negative value
* Updated : Sanitization
* Fixed : WooCommerce single product image width
* Fixed : Menu Icon Sidebar Dynamic CSS
* Fixed : Social Icon Dynamic CSS
* Fixed : Footer Menu Alignment CSS
* Fixed : Various Dynamic CSS

= 1.3.2 - 2021-03-02 =
* Fixed   : Customizer save
* Fixed   : Blog and Post CSS

= 1.3.1 - 2021-01-13 =
* Fixed   : Metabox sanitization

= 1.3.0 - 2021-01-07 =
* Added :  Link hide option on header contact information
* Added :  Header-Footer HTML now support shortcode
* Added :  Box shadow and border shadow
* Updated : Easy Digital Downloads Single Page
* Updated : Easy Digital Downloads tags design
* Updated : WordPress 5.6 compatibility
* Fixed   : Logo design issue
* Fixed   : Metabox sanitization
* Fixed   : Blog Design Template 4
* Fixed   : Customizer Repeater icon selection

= 1.2.0 - 2020-08-12 =
* Updated : WordPress 5.5 compatibility
* Updated : Footer Widget Dynamic CSS
* Updated : Smooth scroll
* Updated : One page menu
* Updated : Added Children classed sub menu CSS support
* Updated : Admin Dismiss button to match default dismiss
* Fixed   : Customizer Repeater Color

= 1.1.9 - 2020-07-21 =
* Fixed :  Menu location save

= 1.1.8 - 2020-07-21 =
* Updated :  Menu location

= 1.1.7 - 2020-07-21 =
* Added :  Wishlist element in header
* Added :  WooCommerce Product Responsive Grid
* Updated :  Site Identity Sorting with Logo Position
* Updated :  WooCommerce My Account page design
* Updated :  WooCommerce max column 6
* Updated :  Menu location
* Updated :  Max Mega Menu Compatibility
* Updated :  Menu icon/submenu icon now comes from PHP ( previous from JS )
* Fixed :  Customizing ▸ WooCommerce Advanced Styling > Product > Product Toolbar

= 1.1.6 - 2020-06-27 =
* Updated :  Keyboard Navigation on Header
* Updated :  Theme JavaScript
* Updated :  Footer vertical and horizontal CSS
* Updated :  Removed user_contactmethods and added it to pro plugin, since it is not allowed on theme
* Fixed :  Checkbox issue with checkbox wrap class
* Fixed :  EDD grid/list button design
* Fixed :  EDD default CSS
* Fixed :  Menu Hover Browser Compatibility On Older version of Microsoft Edge

= 1.1.5 - 2020-05-21 =
* Updated :  Major update specific to EDD
* Updated :  Edd Header Cart
* Updated :  Edd List/Grid
* Updated :  EDD Responsive Grid
* Updated :  EDD pagination-navigation
* Updated :  EDD Archive Options
* Updated :  EDD Single Options
* Updated :  EDD various layout, color and design options
* Fixed :  Customizer CSS Options on Customizer Refresh Values
* Fixed :  Menu Sidebar Close Issue When Resize
* Fixed :  Menu Sidebar Close Issue When Focus Input Search
* Fixed :  Menu Sidebar Dropdown Search

= 1.1.4 - 2020-05-08 =
* Fixed : Banner setting for Blog Page
* Fixed : Only show WooCommerce Popup primary sidebar on Small Device if there is Primary sidebar enabled
* Fixed : WooCommerce toolbar design
* Fixed : Meta box design on Classic Editor
* Fixed : Customizer-meta options relationship
* Fixed : Category hover

= 1.1.3 - 2020-04-30 =
* Updated : Screenshot
* Updated : Excerpt length and excerpt default on blog
* Updated : Renamed cosmoswp/inc/customizer/page-options/page-builder.php renamed to cosmoswp/inc/customizer/page-options/builder-page.php
* Updated : Renamed cosmoswp/template-parts/main-content/page-main-content.php to cosmoswp/template-parts/main-content/cpage-main-content.php
* Fixed : Parallax footer
* Fixed : New Theme Sniffer Issues

= 1.1.2 - 2020-04-21 =
* Added : wpml-config.xml
* Added : WooCommerce Responsive Primary Sidebar
* Added : Drop-down Search Alignment
* Updated : Optimization

= 1.1.1 - 2020-04-13 =
* Fixed : Missing builder added on Menu Icon Sidebar

= 1.1.0 - 2020-04-12 =
* Fixed : WooCommerce Product Catalog shop page and category page display
* Updated : Dynamic css and Typography
* Updated : Some optimization
* Removed : Unnecessary Library
* Fixed : Customizer slow loading
* Fixed : Site Identity missing on responsive
* Fixed : Site color hover color

= 1.0.9 - 2020-04-10 =
* Added : Typography cache
* Added : WooCommerce zoom, gallery, slider support
* Added : Rank Math breadcrumb
* Fixed : Site identity responsive
* Fixed : Banner-overlay-color
* Fixed : Customizer color picker design
* Fixed : WooCommerce single product width
* Fixed : EDD single download width
* Fixed : Icon issue with some plugins
* Fixed : Minor CSS

= 1.0.8 - 2020-04-03 =
* Fixed : WooCommerce Header Cart
* Updated : Screenshot
* Updated : Default values of some customizer options
* Fixed : Skip link focus
* Fixed : Minor CSS

= 1.0.7 - 2020-04-01 =
* Fixed : Sticky Sidebar
* Fixed : Easy Digital Downloads ( EDD ) Header Cart
* Updated : Dynamic CSS
* Fixed : Minor CSS

= 1.0.6 - 2020-03-27 =
* Added : Content Layout Appearance=>Customize =>General Setting=>Content Layout
* Added : Missing RTL CSS
* Added : wp_body_open
* Added : Editor Style Fonts
* Updated : Removed unused functions
* Fixed : Some broken links
* Fixed : Version of CSS and JS
* Fixed : Empty Breadcrumb Container
* Fixed : Minor CSS

= 1.0.5 - 2020-03-13 =
* Added : CosmosWP Pro link
* Fixed : Some broken links

= 1.0.4 =
* Fixed : Some Prefix Issue

= 1.0.3 =
* Added : Keyboard navigation
* Fixed : Some Minor Issue

= 1.0.2 =
* Added : Theme Intro Page
* Added : Different Demos
* Added : Theme Uri and Author Uri
* Fixed : Some Customizer Options Fixed
* Fixed : Some Design Issue

= 1.0.1 =
* Template Library API removed

= 1.0.0 =
* Initial release