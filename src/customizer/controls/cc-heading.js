/**
 * Customizer Group JS
 */
/* WordPress */
import { render } from '@wordpress/element';

/* Library */

/* Atrc */

/*Inbuilt*/

/* Local */
wp.customize.controlConstructor['cosmoswp-heading'] =
	wp.customize.Control.extend({
		ready: function () {
			'use strict';

			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const { label = '' } = control.params || {};

			const mountControl = () => {
				render(
					<h4 class='cwp-czr-ttl at-bg-cl at-bdr at-txt at-m at-p'>{label}</h4>,
					container
				);
			};

			// Initial render
			mountControl();
		},
	});
