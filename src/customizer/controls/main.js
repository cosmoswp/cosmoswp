/**
 * CosmosWP Customizer Control Manager
 *
 * Handles creation and management of WordPress customizer controls with extended functionality
 * including JS-based active callbacks.
 */

// Helper function to extract setting IDs from active callback functions
function getSettingsFromFunction(fnString) {
	if (typeof fnString !== 'string') return [];

	// Match wp.customize('setting_id') patterns
	const settingPattern = /wp\.customize\(['"]([^'"]+)['"]\)/g;
	const matches = [];
	let match;

	while ((match = settingPattern.exec(fnString)) !== null) {
		matches.push(match[1]);
	}

	return [...new Set(matches)]; // Return unique values
}

class CosmosWP_Customizer_Control {
	constructor(id, config) {
		if (!id || !config) {
			console.log('CosmosWP Control: Missing required parameters');
			return;
		}

		this.id = id;
		this.config = this.normalizeConfig(config);

		try {
			this.createControl();
		} catch (error) {
			console.log(`Error creating control ${id}:`, error);
		}
	}

	/**
	 * Normalize control configuration
	 */
	normalizeConfig(config) {
		const normalized = { ...config };

		// Handle settings/setting naming consistency
		if (normalized.settings) {
			normalized.setting =
				typeof normalized.settings === 'string'
					? normalized.settings
					: normalized.settings[0];
			delete normalized.settings;
		}

		// Set default type if not specified
		if (!normalized.type) {
			normalized.type = 'text';
			console.log(`Control ${this.id} missing type, defaulting to 'text'`);
		}

		return normalized;
	}

	/**
	 * Create and register the customizer control
	 */
	createControl() {
		if (!this.config.type) {
			throw new Error('Control type is required');
		}

		let control;
		const controlType = this.config.type.toLowerCase();

		// Handle cosmoswp- prefixed controls
		if (controlType.startsWith('cosmoswp-')) {
			if (!wp.customize.controlConstructor[controlType]) {
				throw new Error(`Unknown CosmosWP control type: ${controlType}`);
			}
			control = new wp.customize.controlConstructor[controlType](
				this.id,
				this.config
			);
		}
		// Handle standard WordPress controls
		else {
			const controlMap = {
				color: wp.customize.ColorControl,
				image: wp.customize.ImageControl,
				media: wp.customize.MediaControl,
				upload: wp.customize.UploadControl,
			};
			if ('image' === controlType) {
				console.log(this.config);
			}

			const ControlClass = controlMap[controlType] || wp.customize.Control;
			control = new ControlClass(this.id, this.config);
		}

		this.setupActiveCallback(control);
		wp.customize.control.add(this.id, control);
	}

	/**
	 * Setup active callback functionality if configured
	 */
	setupActiveCallback(control) {
		if (!this.config.active_callback || !window.cosmoswpActiveCallbacks) {
			return;
		}

		const callbackFn = cosmoswpActiveCallbacks[this.config.active_callback];
		if (typeof callbackFn !== 'function') {
			console.log(
				`Active callback function ${this.config.active_callback} not found`
			);
			return;
		}

		// Get settings first before doing anything
		const settings = getSettingsFromFunction(callbackFn.toString());
		if (!settings.length) {
			return;
		}

		// Initialize active state and bindings only if we have settings
		control.active.validate = callbackFn;
		this.updateActiveState(control, callbackFn);

		settings.forEach((setting) => {
			const settingObj = wp.customize(setting);
			if (settingObj) {
				// Properly bind the callback to the setting
				settingObj.bind(() => {
					this.updateActiveState(control, callbackFn);
				});
			} else {
				console.log(
					`Active callback setting ${setting} not found in customizer`
				);
			}
		});
	}

	/**
	 * Update the active state of the control
	 */
	updateActiveState(control, callbackFn) {
		try {
			control.active.set(callbackFn());
		} catch (error) {
			console.log(`Error in active callback for control ${this.id}:`, error);
		}
	}
}

// Initialize when customizer is ready
wp.customize.bind('ready', function () {
	if (
		typeof cosmoswpCustomizerData === 'undefined' ||
		!cosmoswpCustomizerData.controls
	) {
		console.log('No CosmosWP customizer controls data found');
		return;
	}

	Object.entries(cosmoswpCustomizerData.controls).forEach(([id, config]) => {
		try {
			new CosmosWP_Customizer_Control(id, config);
		} catch (error) {
			console.log(`Failed to initialize control ${id}:`, error);
		}
	});
});
