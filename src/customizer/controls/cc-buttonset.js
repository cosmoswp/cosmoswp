/**
 * Customizer ButtonSet Control - ReactJS
 */
/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Atrc */
import { AtrcButtonGroup, AtrcButton } from 'atrc';

/*Inbuilt*/
wp.customize.controlConstructor['cosmoswp-buttonset'] =
	wp.customize.Control.extend({
		ready: function () {
			'use strict';

			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const {
				label = '',
				description = '',
				choices = {},
				inputAttrs = '',
			} = control.params || {};

			const parseInputAttrs = (attrString = '') => {
				const attrs = {};
				attrString
					.trim()
					.split(/\s+/)
					.forEach((item) => {
						const [key, val] = item.split('=');
						if (key && val) {
							attrs[key] = val.replace(/"/g, '');
						}
					});
				return attrs;
			};

			const handleChange = (newValue) => {
				// Update setting when value changes
				control.setting.set(newValue);
			};
			const mountControl = (currentValue) => {
				render(
					<div className='cwp-czr-ctrl at-flx at-flx-col at-gap at-flx-grw-1'>
						{label && <span className='cwp-czr-ctrl--ttl at-txt'>{label}</span>}
						{description && (
							<span className='cwp-czr-ctrl--desc'>{description}</span>
						)}

						<AtrcButtonGroup className='cwp-czr-ctrl--btn-grp'>
							{Object.entries(choices).map(([key, labelText]) => (
								<AtrcButton
									className='cwp-czr-ctrl--btn-outln at-bdr-rad'
									key={key}
									variant='outline-light'
									isActive={key === currentValue}
									onClick={() => handleChange(key)}
									{...parseInputAttrs(inputAttrs)}>
									{labelText}
								</AtrcButton>
							))}
						</AtrcButtonGroup>
					</div>,
					container
				);
			};

			// Initial render
			mountControl(control.setting.get());

			// Re-render on setting update
			control.setting.bind((newVal) => {
				mountControl(newVal);
			});

			// Cleanup
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	});
