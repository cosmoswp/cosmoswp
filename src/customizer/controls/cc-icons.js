/**
 * Customizer Tabs Control - ReactJS
 */

/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';
import CustomField from '../../components/custom-field';

/* Lodash */

/* Atrc */

/* Inbuilt */

/* Local */
wp.customize.controlConstructor['cosmoswp-icons'] = wp.customize.Control.extend(
	{
		ready: function () {
			'use strict';

			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const { label = '', description = '' } = control.params || {};

			const handleChange = (newValue) => {
				// Update setting when value changes
				control.setting.set(newValue);
			};

			const mountControl = (currentValue) => {
				render(
					<div className='cwp-czr-ctrl cwp-czr-ctrl--icon-picker at-flx at-flx-col at-gap'>
						{label && <span className='cwp-czr-ctrl--ttl at-txt'>{label}</span>}
						{description && (
							<span className='cwp-czr-ctrl--desc'>{description}</span>
						)}

						<CustomField
							type='icons'
							label={label}
							description={description}
							value={currentValue}
							onChange={handleChange}
						/>
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
	}
);
