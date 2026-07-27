/* WordPress */
import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';

/* Library */
import { map, forEach } from 'lodash';

/* Atrc */
import { AtrcRepeater, AtrcRepeaterGroup, AtrcRepeaterGroupAdd } from 'atrc';

/*Inbuilt*/
import CustomFields from './custom-fields';

/* Local */
function RepeaterFields({
	fields,
	item,
	itemIndex,
	handleFieldChange,
	repeaterEnable,
}) {
	let updatedFields = { ...fields };

	if (repeaterEnable && !updatedFields.enabled) {
		updatedFields = {
			enabled: {
				key: 'enabled',
				type: 'toggle',
				label: __('Enable this field', 'cosmoswp'),
			},
			...updatedFields,
		};
	}

	return (
		<CustomFields
			fields={updatedFields}
			value={item}
			onChange={(fieldKey, newValue) =>
				handleFieldChange(itemIndex, fieldKey, newValue)
			}
		/>
	);
}
function CosmosWPRepeaterControl({
	label,
	description,
	fields,
	repeaterEnable,
	repeaterMainLabel,
	addGroupLabel,
	uniqueKeyProp,
	value = [],
	setValue,
}) {
	const handleFieldChange = (itemIndex, fieldKey, newValue) => {
		const updatedValue = value.map((item, index) =>
			index === itemIndex ? { ...item, [fieldKey]: newValue } : item
		);
		setValue(updatedValue);
	};

	const handleDeleteGroup = (itemIndex) => {
		const updatedValue = value.filter((_, index) => index !== itemIndex);
		setValue(updatedValue);
	};

	const handleAddGroup = () => {
		const newItem = {};
		forEach(fields, (field, key) => {
			newItem[key] = field.default ?? '';
		});
		if (repeaterEnable) {
			newItem.enabled = true;
		}
		setValue([...value, newItem]);
	};

	useEffect(() => {
		if (repeaterEnable) {
			const updatedValue = value.map((item) => {
				if (typeof item.enabled === 'undefined') {
					return { ...item, enabled: true };
				}
				return item;
			});
			setValue(updatedValue);
		}
	}, [repeaterEnable, value, setValue]);

	const renderGroups = () =>
		map(value, (item, itemIndex) => (
			<AtrcRepeaterGroup
				sortableValue={item[uniqueKeyProp]}
				useDragHandle={true}
				key={`group-${itemIndex}`}
				groupIndex={itemIndex}
				deleteGroup={() => handleDeleteGroup(itemIndex)}
				groupTitle={repeaterMainLabel}
				deleteTitle={__('Remove item', 'cosmoswp')}>
				<RepeaterFields
					fields={fields}
					item={item}
					itemIndex={itemIndex}
					handleFieldChange={handleFieldChange}
					repeaterEnable={repeaterEnable}
				/>
			</AtrcRepeaterGroup>
		));

	return (
		<div className='cwp-czr-ctrl cwp-czr-ctrl--rpt'>
			<div className='cwp-czr-ctrl--wrp at-flx at-flx-col at-gap'>
				<span className='cwp-czr-ctrl--ttl at-txt'>{label}</span>
				{description ? (
					<span
						className='cwp-czr-ctrl--desc at-txt at-m at-blk'
						dangerouslySetInnerHTML={{ __html: description }}
					/>
				) : (
					''
				)}
			</div>
			<AtrcRepeater
				isSortable={true}
				sortableProp={uniqueKeyProp}
				value={value}
				onChange={setValue}
				groups={renderGroups}
				addGroup={() => (
					<AtrcRepeaterGroupAdd
						addGroup={handleAddGroup}
						tooltipText={addGroupLabel || __('Add item', 'cosmoswp')}
						label={addGroupLabel || __('Add item', 'cosmoswp')}
					/>
				)}
			/>
		</div>
	);
}

export default CosmosWPRepeaterControl;
