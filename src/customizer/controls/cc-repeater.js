/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Library */

/* Atrc */

/* Inbuilt */
import CosmosWPRepeaterControl from '../../components/cosmoswp-repeater';

/* Local */
wp.customize.controlConstructor['cosmoswp-repeater'] =
	wp.customize.Control.extend({
		ready: function () {
			'use strict';

			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			// Safe destructuring with defaults
			const {
				label = '',
				description = '',
				fields = [],
				repeater_enable = false,
				repeater_main_label = '',
				repeater_add_control_field = '',
			} = control.params || {};

			const renderRepeater = (controlValue) => {
				let parsedValues = [];

				try {
					parsedValues = JSON.parse(controlValue);
				} catch (e) {
					console.log(
						'CosmosWP Repeater: Error parsing JSON value for control:',
						e
					);
					parsedValues = [];
				}

				const uniqueKeyProp = 'uniqueKey';

				// Function to add unique keys (index-based) if not already present
				const addUniqueKeys = (arr) => {
					return arr.map((item, index) => {
						if (item && typeof item === 'object' && !item[uniqueKeyProp]) {
							return {
								...item,
								[uniqueKeyProp]: `unique-${index}`,
							};
						}
						return item;
					});
				};

				const valuesWithUniqueKeys = addUniqueKeys(parsedValues);

				render(
					<CosmosWPRepeaterControl
						label={label}
						description={description}
						fields={fields}
						repeaterEnable={repeater_enable}
						repeaterMainLabel={repeater_main_label}
						addGroupLabel={repeater_add_control_field}
						value={valuesWithUniqueKeys}
						uniqueKeyProp={uniqueKeyProp}
						setValue={(newValue) => {
							control.setting.set(JSON.stringify(newValue));
						}}
					/>,
					container
				);
			};

			// Initial render
			renderRepeater(control.setting.get());

			// Re-render on setting change
			control.setting.bind((newControlValue) => {
				renderRepeater(newControlValue);
			});

			// Cleanup when control is removed
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	});
