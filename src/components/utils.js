/**
 * Utility function to parse input attributes string into an object.
 * It first checks if the attributes are serialized and then parses them accordingly.
 * @param {string} inputAttrs - Serialized input attributes string.
 * @returns {object} - Parsed input attributes as an object.
 */
export const parseInputAttrs = (inputAttrs = '') => {
    // If the inputAttrs are serialized, deserialize them first
    const deserializedAttrs = parsedInputAttrs(inputAttrs);

    const attrs = {};
    Object.entries(deserializedAttrs).forEach(([key, value]) => {
        // If any value from deserializedAttrs is a string that needs further parsing
        if (typeof value === 'string' && value.includes('=')) {
            const parsedValue = value.trim().split(/\s+/).reduce((acc, item) => {
                const [attr, val] = item.split('=');
                if (attr && val) acc[attr] = val.replace(/"/g, '');
                return acc;
            }, {});
            attrs[key] = parsedValue;
        } else {
            attrs[key] = value;
        }
    });
    return attrs;
};

/**
 * Utility function to deserialize serialized input attributes.
 * @param {string} inputAttrs - Serialized input attributes string.
 * @returns {object} - Parsed input attributes as an object.
 */
export const parsedInputAttrs = (inputAttrs = '') => {
    try {
        // If the inputAttrs are serialized, parse them, else return an empty object
        return inputAttrs ? JSON.parse(inputAttrs) : {};
    } catch (error) {
        console.error('Failed to parse inputAttrs:', error);
        return {};
    }
};

export const Devices = {
    desktop: { icon: 'dashicons-laptop' },
    tablet: { icon: 'dashicons-tablet' },
    mobile: { icon: 'dashicons-smartphone' },
};