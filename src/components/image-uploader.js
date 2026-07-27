/**
 * Image Uploader Component
 */

/* WordPress */
import { __ } from '@wordpress/i18n';
import { useState, useEffect, useRef } from '@wordpress/element';

function ImageUploader({ value, onChange, label, description }) {
    const [previewUrl, setPreviewUrl] = useState(value);
    const frame = useRef(null);

    useEffect(() => {
        setPreviewUrl(value);
    }, [value]);

    const handleUploadClick = () => {
        if (frame.current) {
            frame.current.open();
            return;
        }

        frame.current = wp.media({
            title: __('Select Image', 'cosmoswp'),
            button: {
                text: __('Select Image', 'cosmoswp'),
            },
            multiple: false,
        });

        frame.current.on('select', () => {
            const attachment = frame.current.state().get('selection').first().toJSON();
            onChange(attachment.url);
        });

        frame.current.open();
    };

    const handleRemoveClick = () => {
        onChange('');
    };

    return (
        <div className="cosmoswp-image-uploader">
            {label && <span className="customize-control-title">{label}</span>}
            {description && (
                <span className="description customize-control-description">{description}</span>
            )}
            {previewUrl && (
                <div className="cosmoswp-image-preview">
                    <img src={previewUrl} alt={__('Image preview', 'cosmoswp')} />
                </div>
            )}
            <div className="cosmoswp-image-controls">
                <button type="button" className="button" onClick={handleUploadClick}>
                    {__('Upload Image', 'cosmoswp')}
                </button>
                {previewUrl && (
                    <button type="button" className="button" onClick={handleRemoveClick}>
                        {__('Remove Image', 'cosmoswp')}
                    </button>
                )}
            </div>
        </div>
    );
}

export default ImageUploader;