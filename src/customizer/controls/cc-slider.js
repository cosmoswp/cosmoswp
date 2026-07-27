import React from 'react';

/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Atrc */
import { AtrcControlRange } from 'atrc';

/* Inbuilt */
import ResponsiveWrapper from '../../components/responsive-wrap';

/* Local */
wp.customize.controlConstructor['cosmoswp-slider'] =
	wp.customize.Control.extend({
		ready: function () {
			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const {
				label = '',
				description = '',
				devices = [],
				input_attrs = '',
			} = control.params || {};

			const parseInputAttrs = (attrs) => {
				// Check if attrs is a non-null, non-array object.
				if (
					typeof attrs === 'object' &&
					attrs !== null &&
					!Array.isArray(attrs)
				) {
					return attrs;
				}
				return {};
			};

			const SliderControl = ({ value, onChange }) => {
				const handleRangeChange = (device, newValue) => {
					const updatedValue = { ...value };
					updatedValue[device] = newValue;
					onChange(updatedValue);
				};

				return (
					<div className='cwp-czr-ctrl--range at-m'>
						<ResponsiveWrapper
							label={label}
							description={description}
							devices={devices}>
							{(device) => {
								const deviceValue = Number(value?.[device]) || null;
								return (
									<AtrcControlRange
										value={deviceValue}
										onChange={(newValue) => handleRangeChange(device, newValue)}
										{...parseInputAttrs(input_attrs)}
									/>
								);
							}}
						</ResponsiveWrapper>
					</div>
				);
			};

			const initialValue = (() => {
				try {
					return JSON.parse(control.setting.get() || '{}');
				} catch (error) {
					console.log(
						'CosmosWP Slider: Error parsing JSON value for control:',
						error
					);
					return {};
				}
			})();

			const updateSetting = (newValue) => {
				control.setting.set(JSON.stringify(newValue));
			};

			// Initial render
			render(
				<SliderControl
					value={initialValue}
					onChange={updateSetting}
				/>,
				container
			);

			// Re-render on setting update (e.g., via Reset button or external action)
			control.setting.bind((newVal) => {
				let parsed = {};
				try {
					parsed = JSON.parse(newVal || '{}');
				} catch {
					parsed = {};
				}
				render(
					<SliderControl
						value={parsed}
						onChange={updateSetting}
					/>,
					container
				);
			});

			// Cleanup
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	});
