/* WordPress */
import { useEffect, useRef } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

// Assuming AtrcControlFile and AtrcImgTag are available from your component library
import { AtrcControlFile, AtrcImgTag } from "atrc";

/**
 * CwpControlFile Component
 *
 * This component wraps AtrcControlFile to add specific DOM manipulation
 * for background image functionality. It will add/remove the 'cwp-bg-img-opt-show'
 * class to its closest ancestor with the 'cwp-czr-ctrl--grp' class.
 *
 * @param {object} props - Component props.
 * @param {string} props.label - The label for the file control.
 * @param {string} [props.description] - The description for the file control.
 * @param {string} props.value - The URL of the selected image.
 * @param {function} props.onChange - Callback function when the file selection changes.
 * @param {boolean} props.enableBgImage - If true, enables the background image class logic.
 */
const CwpControlFile = ({
  label,
  description,
  value,
  onChange,
  enableBgImage,
  ...restProps
}) => {
  // Create a ref to attach to the root element of this component
  const fileControlWrapperRef = useRef(null);

  /**
   * Handles the logic for adding/removing the 'cwp-bg-img-opt-show' class.
   * This function is called both on initial render (via useEffect) and on change.
   *
   * @param {string} currentImageUrl - The current URL value of the image.
   */
  const applyBgImageClass = currentImageUrl => {
    if (enableBgImage && fileControlWrapperRef.current) {
      // Find the closest ancestor with the class "cwp-czr-ctrl--grp"
      const closestGroup =
        fileControlWrapperRef.current.closest(".cwp-czr-ctrl--grp");

      if (closestGroup) {
        // Add class if enableBgImage is true AND there is a value (image selected)
        if (currentImageUrl) {
          closestGroup.classList.add("cwp-bg-img-opt-show");
        } else {
          // Always remove the class if no image is selected
          closestGroup.classList.remove("cwp-bg-img-opt-show");
        }
      }
    }
  };

  // useEffect to handle initial class application when the component mounts
  // or when 'value' or 'enableBgImage' props change.
  useEffect(() => {
    // Ensure the ref is available and the component is mounted
    if (fileControlWrapperRef.current) {
      applyBgImageClass(value);
    }
    // The cleanup function ensures the class is removed if the component unmounts
    // or if 'enableBgImage' becomes false.
    return () => {
      if (enableBgImage && fileControlWrapperRef.current) {
        const closestGroup =
          fileControlWrapperRef.current.closest(".cwp-czr-ctrl--grp");
        if (closestGroup) {
          closestGroup.classList.remove("cwp-bg-img-opt-show");
        }
      }
    };
  }, [value, enableBgImage]); // Dependencies: re-run effect if value or enableBgImage prop changes

  /**
   * Handles the change event from AtrcControlFile.
   * Extracts the URL and calls the applyBgImageClass logic, then the original onChange prop.
   *
   * @param {object} newValue - The new value object from AtrcControlFile.
   */
  const handleInternalChange = newValue => {
    const imageUrl = newValue?.data?.[0]?.url ?? "";
    applyBgImageClass(imageUrl); // Apply class based on new image URL
    if (onChange) {
      onChange(imageUrl); // Call the original onChange prop with the extracted URL
    }
  };
  console.log(value);
  return (
    // Attach the ref to a div wrapping AtrcControlFile
    <div className="at-flx-grw-1" ref={fileControlWrapperRef}>
      <AtrcControlFile
        label={label}
        allowSource={false}
        selfHostedFileProps={{
          frameProps: {
            title: __("Select or upload image", "cosmoswp"),
            button: { text: __("Select", "cosmoswp") },
            multiple: false,
            library: { type: "image" },
          },
          addButtonProps: {
            text: __("Select or upload image", "cosmoswp"),
          },
          removeButtonProps: {
            text: __("Remove image", "cosmoswp"),
          },
        }}
        description={description}
        value={
          value
            ? {
                frm: "",
                data: [
                  {
                    id: "",
                    url: value,
                  },
                ],
              }
            : {}
        }
        onChange={handleInternalChange}
        {...restProps}
      />
      {value ? <AtrcImgTag className={"at-m"} src={value} /> : ""}
    </div>
  );
};

export default CwpControlFile;
