/**
 * Global JS
 * */

jQuery(document).ready(function ($) {
    var customize_theme_controls = $(document);
    /*focus selected panel or section customize */
    var cwp_body = $('body');
    cwp_body.on('click', '.cosmoswp-customizer', function (evt) {
        evt.preventDefault();
        var section = $(this).data('section'),
            panel = $(this).data('panel');

        if (section) {
            wp.customize.section(section).focus();
        }
        if (panel) {
            wp.customize.panel(panel).focus();
        }
    });
});
