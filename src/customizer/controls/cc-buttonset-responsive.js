/**
 * Customizer Control: cosmoswp-responsive-buttonset
 */

/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Library */
import { cloneDeep, isPlainObject } from 'lodash';

/* Atrc */
import { AtrcButtonGroup, AtrcButton } from 'atrc';

/* Inbuilt */
import ResponsiveWrapper from '../../components/responsive-wrap';

/* Local */
wp.customize.controlConstructor['cosmoswp-responsive-buttonset'] =
	wp.customize.Control.extend({
		ready: function () {
			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const {
				label = '',
				description = '',
				choices = {},
				devices = [],
			} = control.params || {};

			const handleButtonClick = (device, key) => {
				const safeValue = isPlainObject(value) ? value : {};
				const newValues = cloneDeep(safeValue);
				newValues[device] = key;
				updateSetting(newValues);
			};

			const ResponsiveButtonSet = ({ value }) => {
				return (
					<ResponsiveWrapper
						label={label}
						description={description}
						devices={devices}>
						{(device) => {
							const deviceValue = value?.[device] || '';
							return (
								<AtrcButtonGroup className='cwp-czr-ctrl--btn-grp'>
									{Object.entries(choices).map(([key, labelText]) => (
										<AtrcButton
											className='cwp-czr-ctrl--btn-outln at-bdr-rad'
											key={key}
											variant='outline-light'
											isActive={key === deviceValue}
											onClick={() => handleButtonClick(device, key)}>
											{labelText}
										</AtrcButton>
									))}
								</AtrcButtonGroup>
							);
						}}
					</ResponsiveWrapper>
				);
			};
			const initialValue = (() => {
				try {
					return JSON.parse(control.setting.get() || '{}');
				} catch (error) {
					console.log(
						'CosmosWP Repeater: Error parsing JSON value for control:',
						error
					);
					console.log('Control ID:', control.id);
					console.log('Setting Value:', control.setting.get());
					console.log('Control Params:', control.params);
					return {};
				}
			})();

			const updateSetting = (newValue) => {
				control.setting.set(JSON.stringify(newValue));
			};

			// Initial render
			render(<ResponsiveButtonSet value={initialValue} />, container);

			// Re-render on setting update (e.g., via Reset button or external action)
			control.setting.bind((newVal) => {
				let parsed = {};
				try {
					parsed = JSON.parse(newVal || '{}');
				} catch {
					parsed = {};
				}
				render(<ResponsiveButtonSet value={parsed} />, container);
			});

			// Cleanup
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	});
