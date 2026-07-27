/* WordPress */
import { __ } from '@wordpress/i18n';

/* Library */
import { cloneDeep, isPlainObject } from 'lodash';

/* Atrc */
import { AtrcControlToggle } from 'atrc';

/* Inbuilt */
import ResponsiveWrapper from './responsive-wrap';
import { Devices } from './utils';

/* Local */
const CssBox = ({
	value,
	fieldKey,
	onChange,
	devices = Devices,
	label,
	description,
	fields = {
		top: true,
		right: true,
		bottom: true,
		left: true,
	},
	min = 0,
	max = 1000,
	step = 1,
	link = 1,
	linkText = __('Link', 'cosmoswp'),
}) => {
	const handleChange = (device, key, newVal) => {
		const safeValue = isPlainObject(value) ? value : {};
		const newValue = cloneDeep(safeValue);

		const deviceValue = newValue[device] || {};

		const isLinked = !!deviceValue.cssbox_link;

		if (isLinked && ['top', 'right', 'bottom', 'left'].includes(key)) {
			['top', 'right', 'bottom', 'left'].forEach((field) => {
				if (fields[field]) {
					deviceValue[field] = parseFloat(newVal);
				}
			});
		} else {
			deviceValue[key] = key === 'cssbox_link' ? !!newVal : parseFloat(newVal);
		}

		newValue[device] = deviceValue;
		onChange(newValue);
	};

	return (
		<ResponsiveWrapper
			fieldKey={fieldKey}
			devices={devices}
			label={label}
			description={description}>
			{(device) => {
				const deviceValue = value?.[device] || {};
				return (
					<ul className={`${device} active at-flx at-al-itm-st at-gap`}>
						{Object.keys(fields).map((fieldKey) => (
							<li
								className={
									'cwp-czr-ctrl--resp-swch-fld-itms at-flx at-flx-col at-gap at-m'
								}
								key={fieldKey}>
								<label>
									<span>
										{fieldKey.charAt(0).toUpperCase() + fieldKey.slice(1)}
									</span>
								</label>
								<input
									min={min}
									max={max}
									step={step}
									value={deviceValue[fieldKey] || ''}
									onChange={(e) =>
										handleChange(device, fieldKey, e.target.value)
									}
									//className='cssbox-field'
									type='number'
								/>
							</li>
						))}

						{link ? (
							<li className='cwp-czr-ctrl--resp-swch-lnk at-flx at-flx-col at-gap at-m'>
								<label>{linkText}</label>
								<AtrcControlToggle
									wrapProps={{ className: 'at-m' }}
									checked={!!deviceValue.cssbox_link}
									onChange={(val) => handleChange(device, 'cssbox_link', val)}
								/>
							</li>
						) : null}
					</ul>
				);
			}}
		</ResponsiveWrapper>
	);
};

export default CssBox;
