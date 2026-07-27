/**
 * Customizer Group JS
 */
/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Library */
import { cloneDeep, isPlainObject, has, get } from 'lodash';

/* Atrc */
import { AtrcPanelBody } from 'atrc';

/*Inbuilt*/
import CustomFields from '../../components/custom-fields';

/* Local */
wp.customize.controlConstructor['cosmoswp-group'] = wp.customize.Control.extend(
	{
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
			} = control.params || {};

			const ensureValidValue = (rawValue) => {
				try {
					// Check for non-string, empty, or whitespace-only strings before parsing
					if (typeof rawValue !== 'string' || rawValue.trim() === '') {
						return {};
					}

					// Attempt to parse the string
					const parsed = JSON.parse(rawValue);

					// Ensure we always return a plain object
					return isPlainObject(parsed) ? parsed : {};
				} catch (e) {
					// Log the error for debugging, but prevent the crash
					console.log('Error parsing JSON in ensureValidValue:', e);
					return {};
				}
			};

			const GroupControl = ({ value }) => {
				const handleFieldChange = (fieldKey, newValue) => {
					const safeValue = isPlainObject(value) ? value : {};
					const newValues = cloneDeep(safeValue);

					const updatedValues = { ...newValues, [fieldKey]: newValue };

					control.setting.set(JSON.stringify(updatedValues));
				};

				// Filter fields based on font-type selection
				const filterFieldsByFontType = (allFields, currentValues) => {
					const filteredFields = cloneDeep(allFields);

					// Check if font-type field exists in the fields definition
					if (!has(filteredFields, 'font-type')) {
						return filteredFields;
					}

					// Get current font-type or default to 'google'
					const fontType = get(currentValues, 'font-type', 'google');

					// Define which fields to show/hide for each font type
					const fontTypeRules = {
						system: {
							show: ['system-font'],
							hide: ['google-font', 'custom-font'],
						},
						google: {
							show: ['google-font'],
							hide: ['system-font', 'custom-font'],
						},
						custom: {
							show: ['custom-font'],
							hide: ['system-font', 'google-font'],
						},
					};

					const rules = fontTypeRules[fontType] || fontTypeRules.google;

					// Create new ordered fields object with font-type first
					const orderedFields = {};

					// Add font-type first
					orderedFields['font-type'] = filteredFields['font-type'];

					// Process the remaining fields
					Object.keys(filteredFields).forEach((fieldKey) => {
						// Skip font-type as we've already added it
						if (fieldKey === 'font-type') return;

						// Hide fields that should be hidden for this font type
						if (!rules.hide.includes(fieldKey)) {
							orderedFields[fieldKey] = filteredFields[fieldKey];
						}
					});

					return orderedFields;
				};

				const filteredFields = filterFieldsByFontType(fields, value);
				return (
					<div className='cwp-czr-ctrl cwp-czr-ctrl--grp'>
						<AtrcPanelBody
							title={label}
							initialOpen={false}>
							<CustomFields
								fields={filteredFields}
								value={value}
								onChange={handleFieldChange}
							/>
						</AtrcPanelBody>
					</div>
				);
			};

			const getSanitizedValue = () => {
				const rawValue = control.setting.get();
				const cleanValue = ensureValidValue(rawValue);

				// Fix invalid initial values, but we won't set it here to avoid an infinite loop
				// if (typeof rawValue !== 'string' || rawValue === '[object Object]') {
				//   control.setting.set(JSON.stringify(cleanValue));
				// }

				return cleanValue;
			};
			const initialValue = getSanitizedValue();

			const mountControl = (val) => {
				render(<GroupControl value={val} />, container);
			};

			// Initial render
			mountControl(initialValue);

			// Re-render on setting update
			control.setting.bind((newVal) => {
				mountControl(ensureValidValue(newVal));
			});

			// Cleanup
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	}
);
