/* WordPress */
import { useEffect, useRef } from '@wordpress/element';

/* Library */

/* Atrc */
import { AtrcControlCheckbox, AtrcPanelRow } from 'atrc';

/**
 * CwpCheckbox Component
 *
 * This component extends AtrcControlCheckbox to add specific DOM manipulation
 * for the 'enable-overlay' functionality. It will add/remove the 'cwp-bg-ovl-show'
 * class to its closest ancestor with the 'cwp-czr-ctrl--grp' class.
 *
 * @param {object} props - Component props.
 * @param {string} props.label - The label for the checkbox.
 * @param {string} [props.description] - The description for the checkbox.
 * @param {boolean} props.checked - The checked state of the checkbox.
 * @param {function} props.onChange - Callback function when the checkbox state changes.
 * @param {boolean} props.enableOverlay - If true, enables the overlay class logic.
 */
const CwpCheckbox = ({
	label,
	description,
	checked,
	onChange,
	enableOverlay,
	fieldKey,
}) => {
	const checkboxWrapperRef = useRef(null);

	const applyOverlayClass = (currentCheckedState) => {
		if (enableOverlay && checkboxWrapperRef.current) {
			// Find the closest ancestor with the class "cwp-czr-ctrl--grp"
			const closestGroup =
				checkboxWrapperRef.current.closest('.cwp-czr-ctrl--grp');

			if (closestGroup) {
				if (currentCheckedState) {
					closestGroup.classList.add('cwp-bg-ovl-show');
				} else {
					closestGroup.classList.remove('cwp-bg-ovl-show');
				}
			}
		}
	};

	useEffect(() => {
		if (checkboxWrapperRef.current) {
			applyOverlayClass(checked);
		}
		return () => {
			if (enableOverlay && checkboxWrapperRef.current) {
				const closestGroup =
					checkboxWrapperRef.current.closest('.cwp-czr-ctrl--grp');
				if (closestGroup) {
					closestGroup.classList.remove('cwp-bg-ovl-show');
				}
			}
		};
	}, [checked, enableOverlay]);

	const handleInternalChange = (newValue) => {
		applyOverlayClass(newValue); // Apply class based on new value
		if (onChange) {
			onChange(newValue); // Call the original onChange prop
		}
	};

	return (
		<div
			ref={checkboxWrapperRef}
			className={'components-panel__row at-pnl-row ' + fieldKey}>
			<AtrcControlCheckbox
				label={label}
				description={description}
				checked={checked}
				onChange={handleInternalChange}
			/>
		</div>
	);
};

export default CwpCheckbox;
