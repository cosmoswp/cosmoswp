import ResponsiveWrapper from './responsive-wrap';
import { AtrcControlText } from 'atrc';
import { Devices } from './utils';

const ResponsiveNumber = ({
	value = {},
	onChange,
	label,
	description,
	min = 0,
	max = 1000,
	step = 1,
	defaultValues = {},
	fieldKey,
}) => {
	const handleValueChange = (device, newValue) => {
		const newValues = {
			...value,
			[device]: newValue !== '' ? Number(newValue) : '',
		};
		onChange(newValues);
	};

	return (
		<ResponsiveWrapper
			fieldKey={fieldKey}
			devices={Devices}
			label={label}
			description={description}>
			{(device) => {
				const deviceValue = Number(value?.[device]) || null;
				const defaultValue = Number(defaultValues?.[device]) || null;

				return (
					<AtrcControlText
						type='number'
						className={`group-${device} responsive-range`}
						min={min}
						max={max}
						step={step}
						value={deviceValue !== undefined ? deviceValue : defaultValue}
						label=''
						onChange={(newValue) => handleValueChange(device, newValue)}
					/>
				);
			}}
		</ResponsiveWrapper>
	);
};

export default ResponsiveNumber;
