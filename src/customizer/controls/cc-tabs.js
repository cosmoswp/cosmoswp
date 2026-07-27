/**
 * Customizer Tabs Control - ReactJS
 */

/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Lodash */
import { cloneDeep, isPlainObject } from 'lodash';

/* Atrc */
import { AtrcTabPanel, AtrcPanelBody } from 'atrc';

/* Inbuilt */
import CustomFields from '../../components/custom-fields';

/* Local */
wp.customize.controlConstructor['cosmoswp-tabs'] = wp.customize.Control.extend({
	ready: function () {
		'use strict';

		const control = this;
		const container = document.createElement('div');
		control.container.append(container);

		const { label = '', description = '', fields = {} } = control.params || {};

		const { tabs = {}, fields: allFields = {} } = fields;

		const handleFieldChange = (fieldKey, newValue, currentValue) => {
			const safeValue = isPlainObject(currentValue) ? currentValue : {};
			const newValues = cloneDeep(safeValue);
			newValues[fieldKey] = newValue;
			control.setting.set(JSON.stringify(newValues));
		};

		const TabsControl = ({ value }) => {
			const tabItems = Object.keys(tabs).map((tabKey) => ({
				name: tabKey,
				title: tabs[tabKey]?.label || tabKey,
				fields: Object.fromEntries(
					Object.entries(allFields).filter(
						([_, fieldData]) => fieldData.tab === tabKey
					)
				),
			}));

			return (
				<div className='cwp-czr-ctrl cwp-czr-ctrl--tab-pnl'>
					<AtrcPanelBody
						title={label}
						initialOpen={true}>
						{description && (
							<span className='cwp-czr-ctrl--desc at-txt at-m at-blk'>
								{description}
							</span>
						)}

						<AtrcTabPanel
							className='cwp-czr-ctrl--tab-pnl-tabs'
							tabs={tabItems}>
							{(tab) => {
								const tabFields = tab.fields || {};

								return (
									<div
										key={tab.name}
										className='cwp-czr-ctrl--tab-pnl-tabs-cont at-p at-bg-cl at-bdr'>
										<CustomFields
											fields={tabFields}
											value={value}
											onChange={(fieldKey, newVal) =>
												handleFieldChange(fieldKey, newVal, value)
											}
										/>
									</div>
								);
							}}
						</AtrcTabPanel>
					</AtrcPanelBody>
				</div>
			);
		};

		// Parse and safely initialize the current value
		const parseInitialValue = () => {
			try {
				return typeof control.setting.get() === 'string'
					? JSON.parse(control.setting.get())
					: control.setting.get();
			} catch (e) {
				return {};
			}
		};
		const initialValue = parseInitialValue();

		const mountControl = (val) => {
			render(<TabsControl value={val} />, container);
		};

		// Initial render
		mountControl(initialValue);

		// Re-render on setting update (e.g., reset button)
		control.setting.bind((newVal) => {
			try {
				const parsed = typeof newVal === 'string' ? JSON.parse(newVal) : newVal;
				mountControl(parsed);
			} catch (e) {
				console.log('Invalid JSON for cosmoswp-tabs:', newVal);
			}
		});

		// Cleanup
		control.container.on('remove', () => {
			unmountComponentAtNode(container);
		});
	},
});
