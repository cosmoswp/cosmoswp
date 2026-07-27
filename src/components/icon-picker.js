/* WordPress */
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/* Local */
function IconPicker({ value, onChange }) {
	const [isOpen, setIsOpen] = useState(false);
	const [searchTerm, setSearchTerm] = useState('');
	const { icons = [], hasGutentor, faVersion } = cosmoswpCustomizerData || {};
	const toggleOpen = () => {
		setIsOpen(!isOpen);
	};

	const handleIconClick = (iconClass) => {
		onChange(iconClass);
		setIsOpen(false);
	};

	const handleSearch = (event) => {
		setSearchTerm(event.target.value);
	};

	const filteredIcons = (Array.isArray(icons) ? icons : []).filter((icon) =>
    icon.toLowerCase().includes(searchTerm.toLowerCase())
  );

	const getCorrectFaFont = (iconClass) => {
		if (!hasGutentor) {
			if (icons && icons[iconClass]) {
				return icons[iconClass];
			}
		} else if (faVersion == 4) {
			return iconClass.replace('fas', 'fa');
		}
		return iconClass;
	};

	return (
		<div className='cwp-czr-ctrl--icon-wrp at-flx-grw-1'>
			<div className='at-flx at-al-itm-ctr at-flx-grw-1 at-gap at-w'>
				<span
					className={`cwp-czr-ctrl--icon-tog at-flx-grw-1 at-flx at-jfy-cont-btw at-p at-bdr at-bdr-rad at-bg-cl at-cl at-cur ${
						isOpen ? 'isOpen' : ''
					}`}
					onClick={toggleOpen}
					role='button'
					tabIndex='0'
					onKeyDown={(e) => e.key === 'Enter' && toggleOpen()}>
					{value ? __('Replace Icon', 'cosmoswp') : __('Add Icon', 'cosmoswp')}
					<span
						className={`dashicons ${
							isOpen ? 'dashicons-arrow-up' : 'dashicons-arrow-down'
						}`}></span>
				</span>
				<span className='cwp-czr-ctrl--icon-view at-flx at-jfy-cont-ctr at-al-itm-ctr at-w at-h at-bdr at-bdr-rad at-bg-cl at-cl icon-preview'>
					{value && <i className={getCorrectFaFont(value)}></i>}
				</span>
			</div>
			<div
				style={{ display: isOpen ? 'block' : 'none' }}
				className='cwp-czr-ctrl--icon-itm-cont at-p at-h at-w at-bdr at-bg-cl at-ovf-y at-bdr-rad at-m'>
				<input
					className='cwp-czr-ctrl--icon-search'
					type='text'
					placeholder={__('Search Icon', 'cosmoswp')}
					value={searchTerm}
					onChange={handleSearch}
				/>
				<div className='cwp-czr-ctrl--icon-itms at-m at-flx at-flx-wrp at-jfy-cont-evnly at-gap'>
					{filteredIcons.map((icon, index) => (
						<span
							key={`${icon}-${index}`}
							className={`cwp-czr-ctrl--icon-itm at-w at-h at-bdr-rad at-p at-bg-cl at-cl at-cur at-trs at-flx at-jfy-cont-ctr at-al-itm-ctr ${
								value === icon ? 'is-selected' : ''
							}`}
							onClick={() => handleIconClick(icon)}>
							<i
								data-class={icon}
								className={getCorrectFaFont(icon)}></i>
						</span>
					))}
				</div>
			</div>
		</div>
	);
}

export default IconPicker;
