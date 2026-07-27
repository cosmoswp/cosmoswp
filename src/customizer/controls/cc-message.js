/* WordPress */
import { render } from '@wordpress/element';

/* Library */

/* Atrc */

/*Inbuilt*/

/* Local */
wp.customize.controlConstructor['cosmoswp-message'] = wp.customize.Control.extend({
    ready: function () {
        'use strict';

        const control = this;
        const container = document.createElement('div');
        control.container.append(container);

        const {
            label = '',
            description = '',
        } = control.params || {};

        const mountControl = () => {
            render(
                <label className="customizer-text">
                    {label && <span className="customize-control-title">{label}</span>}
                    {description && (
                        <span
                            className="description customize-control-description"
                            dangerouslySetInnerHTML={{ __html: description }}
                        />
                    )}
                </label>,
                container
            );
        };

        // Initial render
        mountControl();
    },
});