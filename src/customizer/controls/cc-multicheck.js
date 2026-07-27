/* WordPress */
import { render, unmountComponentAtNode } from '@wordpress/element';

/* Atrc */
import { AtrcControlCheckbox } from 'atrc';

/* Local */
wp.customize.controlConstructor['cosmoswp-multicheck'] = wp.customize.Control.extend({
    ready: function () {
        'use strict';

        const control = this;
        const container = document.createElement('div');
        control.container.append(container);

        const {
            label = '',
            description = '',
            choices = {},
        } = control.params || {};

        const handleCheckboxChange = (value, key) => (checked) => {
            let newValue = [...(value || [])];

            if (checked) {
                newValue.push(key);
            } else {
                newValue = newValue.filter((item) => item !== key);
            }

            control.setting.set(newValue);
        };

        const mountControl = (currentValue) => {
            render(
                <div className="cosmoswp-multicheck-control">
                    {label && <span className="customize-control-title">{label}</span>}
                    {description && <span className="customize-control-description">{description}</span>}

                    <ul>
                        {Object.keys(choices).map((key) => (
                            <li key={key}>
                                <AtrcControlCheckbox
                                    label={choices[key]}
                                    checked={currentValue && currentValue.includes(key)}
                                    onChange={handleCheckboxChange(currentValue, key)} // Pass currentValue
                                />
                            </li>
                        ))}
                    </ul>
                </div>,
                container
            );
        };

        // Initial render
        mountControl(control.setting.get());

        // Re-render on setting update
        control.setting.bind((newVal) => {
            mountControl(newVal);
        });

        // Cleanup
        control.container.on('remove', () => {
            unmountComponentAtNode(container);
        });
    },
});