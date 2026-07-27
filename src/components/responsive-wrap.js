import React, { useEffect, useState } from 'react';
/* Atrc */
import { AtrcPanelRow } from 'atrc';
const ResponsiveWrapper = ({
	label,
	description,
	devices,
	children,
	fieldKey,
}) => {
	const [activeDevice, setActiveDevice] = useState(
		window.cosmosWPActiveDevice || 'desktop'
	);
	const handleDeviceChange = (device) => {
		if (typeof window.setCosmosWPActiveDevice === 'function') {
			window.setCosmosWPActiveDevice(device);

			// Sync footer UI
			document
				.querySelector(
					`#customize-footer-actions .devices button[data-device="${device}"]`
				)
				?.click();
		} else {
			setActiveDevice(device);
		}
	};

	useEffect(() => {
		// Define global state and device setter
		window.setCosmosWPActiveDevice = (device) => {
			window.cosmosWPActiveDevice = device;
			window.dispatchEvent(
				new CustomEvent('cosmosWPDeviceChange', { detail: device })
			);
		};

		const handleGlobalDeviceChange = (e) => {
			setActiveDevice(e.detail);
		};

		// Listen to device change
		window.addEventListener('cosmosWPDeviceChange', handleGlobalDeviceChange);

		// Hook into WP Customizer footer device buttons
		const $ = window.jQuery;
		$('#customize-footer-actions .devices button').on('click', function () {
			const device = $(this).data('device');
			if (typeof window.setCosmosWPActiveDevice === 'function') {
				window.setCosmosWPActiveDevice(device);
			}
		});

		return () => {
			window.removeEventListener(
				'cosmosWPDeviceChange',
				handleGlobalDeviceChange
			);
		};
	}, []);

	return (
		<AtrcPanelRow className={fieldKey}>
			<div className='cwp-czr-ctrl at-flx at-flx-col at-gap at-flx-grw-1'>
				<div className='cwp-czr-ctrl--wrp at-flx at-al-itm-ctr at-gap'>
					<span className='cwp-czr-ctrl--ttl at-txt'>{label}</span>
					<ul className='cwp-czr-ctrl--resp-swch at-flx at-al-itm-ctr at-gap'>
						{Object.entries(devices).map(([device, { icon }]) => (
							<li
								className='cwp-czr-ctrl--resp-swch-itm at-m'
								key={device}>
								<button
									type='button'
									className={`at-flx at-btn at-bdr-rad at-trs preview-${device} ${
										device === activeDevice ? 'active' : ''
									}`}
									onClick={() => handleDeviceChange(device)}
									data-device={device}>
									<i className={`at-h at-w dashicons ${icon}`}></i>
								</button>
							</li>
						))}
					</ul>
				</div>

				{description && (
					<span className='cwp-czr-ctrl--desc'>{description}</span>
				)}
				<div className='cwp-czr-ctrl--resp-swch-fld'>
					{children(activeDevice)}
				</div>
			</div>
		</AtrcPanelRow>
	);
};

export default ResponsiveWrapper;
