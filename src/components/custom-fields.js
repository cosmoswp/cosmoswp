/* Library */
import { map } from 'lodash';

/* Inbuilt */
import CustomField from './custom-field';

/* Local */
function CustomFields({ fields, value, onChange }) {
	return map(fields, (field, fieldKey) => {
		const fieldValue = value?.[fieldKey] ?? field.default ?? '';
		const { label = '', description = '', type } = field;

		return (
			<CustomField
				fieldKey={fieldKey}
				type={type}
				label={label}
				description={description}
				value={fieldValue}
				field={field}
				onChange={(newValue) => onChange(fieldKey, newValue)}
			/>
		);
	});
}

export default CustomFields;
