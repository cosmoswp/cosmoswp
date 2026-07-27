/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Library */

/* Atrc */

/* Inbuilt */
import CssBox from '../../components/css-box';

/* Local */
wp.customize.controlConstructor['cosmoswp-cssbox'] =
	wp.customize.Control.extend({
		ready: function () {
			const control = this;
			const container = document.createElement('div');
			control.container.append(container);

			const {
				label = '',
				description = '',
				fields = {
					top: true,
					right: true,
					bottom: true,
					left: true,
				},
				attr = {},
			} = control.params || {};

			const {
				min = 0,
				max = 1000,
				step = 1,
				link = 1,
				devices = {
					desktop: { icon: 'dashicons-laptop' },
					tablet: { icon: 'dashicons-tablet' },
					mobile: { icon: 'dashicons-smartphone' },
				},
				link_text = 'Link',
			} = attr;

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
				render(
					<CssBox
						value={val}
						devices={devices}
						label={label}
						description={description}
						fields={fields}
						min={min}
						max={max}
						step={step}
						link={link}
						linkText={link_text}
						onChange={(updated) => {
							control.setting.set(JSON.stringify(updated));
						}}
					/>,
					container
				);
			};

			// Initial render
			mountControl(initialValue);

			// Re-render on setting update (e.g., via Reset button or external action)
			control.setting.bind((newVal) => {
				try {
					const parsed =
						typeof newVal === 'string' ? JSON.parse(newVal) : newVal;
					mountControl(parsed);
				} catch (e) {
					console.log('Invalid JSON for cosmoswp-cssbox:', newVal);
				}
			});

			// Cleanup
			control.container.on('remove', () => {
				unmountComponentAtNode(container);
			});
		},
	});
