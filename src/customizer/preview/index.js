(function ($) {
	'use strict';

	// Initialize configuration
	const config = {
		ajaxurl: cosmoswpCustomizerData.ajaxurl,
		nonce: cosmoswpCustomizerData.wpnonce,
		controlGroups: cosmoswpCustomizerData.controlGroups,
		elements: {},
	};

	// Cache DOM elements
	Object.keys(cosmoswpCustomizerData.elements).forEach((key) => {
		config.elements[key] = $(cosmoswpCustomizerData.elements[key]);
	});

	/* Reusable AJAX Handler */
	const createAjaxHandler = (action, loadingElement, options = {}) => {
		let refreshCount = 0;
		const {
			updateCss = false,
			updateFonts = false,
			updateClasses = false,
		} = options;

		return (controlId) => {
			wp.customize(controlId, (value) => {
				value.bind(() => {
					$.ajax({
						type: 'POST',
						url: config.ajaxurl,
						data: {
							action: action,
							control_id: controlId,
							security: config.nonce,
						},
						beforeSend: () => {
							refreshCount++;
							loadingElement.addClass('customize-partial-refreshing');
						},
					})
						.done((data) => {
							if (updateFonts && data.data.google_font_url) {
								config.elements.googleFonts.attr(
									'href',
									data.data.google_font_url
								);
							}
							if (updateClasses && data.data) {
								updateElementClasses(data.data);
							}
							if (updateCss && data.data) {
								config.elements.dynamicCSS.html(
									data.data.dynamic_css || data.data
								);
							}
						})
						.fail((jqXHR, textStatus, errorThrown) => {
							console.log('AJAX Error:', textStatus, errorThrown);
						})
						.always(() => {
							refreshCount--;
							if (refreshCount === 0) {
								loadingElement.removeClass('customize-partial-refreshing');
							}
						});
				});
			});
		};
	};

	/* Helper Functions */
	const updateElementClasses = (classesData) => {
		if (classesData.body_class) {
			config.elements.body.removeClass().addClass(classesData.body_class);
		}
		if (classesData.cosmoswp_main_wrap_classes) {
			config.elements.mainWrap
				.removeClass()
				.addClass(classesData.cosmoswp_main_wrap_classes);
		}
		if (classesData.cosmoswp_header_wrap_classes) {
			config.elements.headerWrap
				.removeClass()
				.addClass(classesData.cosmoswp_header_wrap_classes);
		}
		if (classesData.cosmoswp_vertical_header_main_wrap_classes) {
			config.elements.verticalHeader
				.removeClass()
				.addClass(classesData.cosmoswp_vertical_header_main_wrap_classes);
		}
	};

	/* Initialize Handlers */
	const cssRefreshHandler = createAjaxHandler(
		'cosmoswp_head_ajax_dynamic_css',
		config.elements.body,
		{ updateCss: true }
	);

	const typographyRefreshHandler = createAjaxHandler(
		'general_partial_ajax_typography',
		config.elements.body,
		{ updateCss: true, updateFonts: true }
	);

	const headerClassRefreshHandler = createAjaxHandler(
		'general_header_multiple_class_refresh',
		config.elements.headerWrap,
		{ updateClasses: true }
	);

	/* Bind Control Groups */

	// CSS Refresh Controls
	if (config.controlGroups.css_refresh) {
		config.controlGroups.css_refresh.forEach(cssRefreshHandler);
	}

	// Typography Refresh Controls
	if (config.controlGroups.typography_refresh) {
		config.controlGroups.typography_refresh.forEach(typographyRefreshHandler);
	}

	// Header Class Refresh Controls
	if (config.controlGroups.header_class_refresh) {
		config.controlGroups.header_class_refresh.forEach(
			headerClassRefreshHandler
		);
	}

	// Class Toggle Controls
	if (config.controlGroups.class_toggles) {
		Object.entries(config.controlGroups.class_toggles).forEach(
			([controlId, settings]) => {
				wp.customize(controlId, (value) => {
					value.bind((to) => {
						const target =
							settings.target === 'body'
								? config.elements.body
								: $(settings.target);
						target.removeClass(settings.classes.join(' ')).addClass(to);
					});
				});
			}
		);
	}

	// Text Update Controls
	if (config.controlGroups.text_updates) {
		Object.entries(config.controlGroups.text_updates).forEach(
			([controlId, selector]) => {
				wp.customize(controlId, (value) => {
					value.bind((to) => $(selector).text(to));
				});
			}
		);
	}

	// Special Cases
	if (config.controlGroups.special_cases) {
		Object.entries(config.controlGroups.special_cases).forEach(
			([pattern, settings]) => {
				if (pattern === 'footer-sidebar-*-content-align') {
					// Handle footer widget alignment
					for (let i = 1; i <= settings.count; i++) {
						const controlId = `footer-sidebar-${i}-content-align`;
						wp.customize(controlId, (value) => {
							value.bind((to) => {
								$(`.cwp-footer-sidebar-${i}`)
									.removeClass('cwp-text-left cwp-text-center cwp-text-right')
									.addClass(to);
							});
						});
					}
				} else if (settings.type === 'toggle_class') {
					// Handle simple class toggles
					wp.customize(pattern, (value) => {
						value.bind((to) => {
							$(settings.selector).toggleClass(
								settings.class,
								to === settings.value
							);
						});
					});
				} else if (settings.type === 'menu_sidebar') {
					// Handle menu sidebar special case
					wp.customize(pattern, (value) => {
						value.bind((to) => {
							const menu = $('.cwp-header-menu-sidebar');
							const wrapper = config.elements.menuWrapper;

							menu
								.removeClass(
									'cwp-left-menu-slide cwp-right-menu-slide cwp-left-menu-push cwp-right-menu-push'
								)
								.addClass(to);

							wrapper.removeClass('cwp-left-push cwp-right-push');

							if (to === 'cwp-left-menu-push') {
								wrapper.addClass('cwp-left-push');
							} else if (to === 'cwp-right-menu-push') {
								wrapper.addClass('cwp-right-push');
							}
						});
					});
				}
			}
		);
	}

	/* Error Handling for Missing Groups */
	if (!config.controlGroups.css_refresh) {
		console.log(
			'cosmoswpCustomizerData.controlGroups.css_refresh is not defined'
		);
	}
	if (!config.controlGroups.typography_refresh) {
		console.log(
			'cosmoswpCustomizerData.controlGroups.typography_refresh is not defined'
		);
	}
})(jQuery);

(function ($) {
	// When the customizer preview is ready
	wp.customize.bind('preview-ready', function () {
		// Listen for partial content rendered events
		wp.customize.selectiveRefresh.bind(
			'partial-content-rendered',
			function (placement) {
				// Check if this is the partial we're interested in
				if ('cwp_popupmodal' === placement.partial.id) {
					// Toggle class on body
					document.body.classList.remove('open-popup');
				}
			}
		);
	});
})(jQuery);
