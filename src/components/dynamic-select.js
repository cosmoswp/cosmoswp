/* WordPress */
import { useEffect, useRef, useState } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

/* Library */
import { isArray, isEmpty, isObject, map } from "lodash";

/* Atrc */
import { AtrcControlSelect } from "atrc";

// Font options cache
let fontOptionsCache = null;

function convertOptionsToArray(options) {
  if (isArray(options)) {
    return options;
  }

  if (isObject(options) && options !== null) {
    return map(options, (label, value) => ({
      label: label,
      value: value,
    }));
  }

  return [];
}

// Predefined system font options
const systemFontOptions = [
  { label: "Arial", value: "Arial" },
  { label: "Tahoma", value: "Tahoma" },
  { label: "Verdana", value: "Verdana" },
  { label: "Helvetica", value: "Helvetica" },
  { label: "Times New Roman", value: "Times New Roman" },
  { label: "Trebuchet MS", value: "Trebuchet MS" },
  { label: "Georgia", value: "Georgia" },
];

// Predefined font weight options
const defaultFontWeightOptions = [
  { label: "100 (Thin)", value: "100" },
  { label: "200 (Extra Light)", value: "200" },
  { label: "300 (Light)", value: "300" },
  { label: "400 (Normal)", value: "400" },
  { label: "500 (Medium)", value: "500" },
  { label: "600 (Semi Bold)", value: "600" },
  { label: "700 (Bold)", value: "700" },
  { label: "800 (Extra Bold)", value: "800" },
  { label: "900 (Black)", value: "900" },
];

const DynamicSelect = ({ fieldKey, field, value, onChange }) => {
  const controlSelectWrapperRef = useRef(null);

  const applyOverlayClass = currentValue => {
    if (fieldKey.includes("border-style") && controlSelectWrapperRef.current) {
      // Find the closest ancestor with the class "cwp-czr-ctrl--grp"
      const closestGroup = controlSelectWrapperRef.current.closest(
        ".cwp-czr-ctrl--tab-pnl-tabs-cont, .cwp-czr-ctrl--grp",
      );

      if (closestGroup) {
        if (!currentValue || "none" === currentValue) {
          closestGroup.classList.add("cwp-on-bdr-sty");
        } else {
          closestGroup.classList.remove("cwp-on-bdr-sty");
        }
      }
    }
  };

  useEffect(() => {
    if (controlSelectWrapperRef.current) {
      applyOverlayClass(value);
    }
    return () => {
      if (
        fieldKey.includes("border-style") &&
        controlSelectWrapperRef.current
      ) {
        const closestGroup = controlSelectWrapperRef.current.closest(
          ".cwp-czr-ctrl--tab-pnl-tabs-cont, .cwp-czr-ctrl--grp",
        );
        if (closestGroup) {
          closestGroup.classList.remove("cwp-on-bdr-sty");
        }
      }
    };
  }, [value, fieldKey]);

  const handleInternalChange = newValue => {
    applyOverlayClass(newValue); // Apply class based on new value
    if (onChange) {
      onChange(newValue); // Call the original onChange prop
    }
  };

  const [options, setOptions] = useState([]);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    // If options are provided directly, use them
    if (field.options && !isEmpty(field.options)) {
      setOptions(convertOptionsToArray(field.options));
      return;
    }

    // Handle system fonts
    if (fieldKey === "system-font") {
      setOptions(systemFontOptions);
      return;
    }

    // Handle font weights
    if (fieldKey === "font-weight") {
      setOptions(defaultFontWeightOptions);
      return;
    }

    // Handle dynamic fonts (Google/Custom)
    if (fieldKey === "google-font" || fieldKey === "custom-font") {
      fetchFontOptions();
    }
  }, [fieldKey, field.options]);

  const fetchFontOptions = async () => {
    if (loading) return;

    // Return cached results if available
    if (fontOptionsCache) {
      setOptions(fontOptionsCache);
      return;
    }

    setLoading(true);
    try {
      const response = await fetch(wp.customize.settings.url.ajax, {
        // Or myAjax.ajaxUrl if not in customizer.
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "cosmoswp_customizer_ajax_google_fonts",
          // Add your nonce here if needed
        }),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const responseData = await response.json();

      if (responseData && responseData.data && responseData.data.items) {
        const formattedOptions = responseData.data.items.map(font => ({
          label: font.family,
          value: font.family,
        }));

        // Cache the results
        fontOptionsCache = formattedOptions;
        setOptions(formattedOptions);
      } else {
        setOptions([
          {
            label: __("Failed to load fonts", "cosmoswp"),
            value: "",
          },
        ]);
      }
    } catch (error) {
      console.error("Error fetching font options:", error);
      setOptions([
        {
          label: __("Error loading fonts", "cosmoswp"),
          value: "",
        },
      ]);
    } finally {
      setLoading(false);
    }
  };

  // Get the current value or fallback to default
  const currentValue = value || field.default || "";

  return (
    <div
      ref={controlSelectWrapperRef}
      className={"components-panel__row at-pnl-row " + fieldKey}
    >
      <AtrcControlSelect
        label={field.label || ""}
        description={field.description || ""}
        value={typeof currentValue === "string" ? currentValue : ""}
        options={
          loading
            ? [
                {
                  label: __("Loading...", "cosmoswp"),
                  value: "",
                },
              ]
            : options
        }
        onChange={handleInternalChange}
        disabled={loading}
      />
      {loading && (
        <span className="description">
          {__("Loading font options...", "cosmoswp")}
        </span>
      )}
    </div>
  );
};

export default DynamicSelect;
