/**
 * Customizer Alpha Color Control - ReactJS
 */

/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Atrc */
import { AtrcControlDropdownColor } from 'atrc';

/*Inbuilt*/
wp.customize.controlConstructor['cosmoswp-color'] = wp.customize.Control.extend(
	{
		ready: function () {
			'use strict';

			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const {
				label = '',
				description = '',
				default: defaultColor = '',
				value = '',
			} = control.params || {};

			const handleChange = (newValue) => {
				// Update setting when value changes
				control.setting.set(newValue);
			};

			const renderControl = (currentValue) => {
				render(
					<div className='cwp-czr-ctrl cwp-czr-ctrl--color at-flx at-flx-col at-gap'>
						<div className='cwp-czr-ctrl--wrp at-flx at-flx-col at-gap'>
							{label && (
								<span className='cwp-czr-ctrl--ttl at-txt'>{label}</span>
							)}
							{description && (
								<span className='cwp-czr-ctrl--desc at-txt at-m at-blk'>
									{description}
								</span>
							)}
						</div>
						<AtrcControlDropdownColor
							value={currentValue}
							onChange={handleChange}
							defaultColor={defaultColor}
						/>
					</div>,
					container
				);
			};

			// Initial render
			renderControl(value || control.setting.get());

			// Re-render on value change
			control.setting.bind((newVal) => {
				renderControl(newVal);
			});

			// Cleanup
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	}
);
