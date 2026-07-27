/* WordPress */

/* Library */

/* Atrc */
import {
  AtrcControlText,
  AtrcControlTextarea,
  AtrcControlToggle,
  AtrcPanelRow,
} from "atrc";

import { AtrcControlDropdownColor } from "atrc";

/* Inbuilt */
import CssBox from "./css-box";
import CwpCheckbox from "./cwp-checkbox";
import CwpControlFile from "./cwp-control-file";
import DynamicSelect from "./dynamic-select";
import IconPicker from "./icon-picker";
import ResponsiveNumber from "./responsive-number";

/* Local */
function CustomField({
  fieldKey,
  type,
  label,
  description,
  value,
  onChange,
  field,
}) {
  switch (type) {
    case "text":
      return (
        <AtrcPanelRow className={fieldKey}>
          <AtrcControlText
            label={label}
            description={description}
            value={value}
            onChange={onChange}
          />
        </AtrcPanelRow>
      );

    case "url":
      return (
        <AtrcPanelRow className={fieldKey}>
          <AtrcControlText
            type="url"
            label={label}
            description={description}
            value={value}
            onChange={onChange}
          />
        </AtrcPanelRow>
      );

    case "checkbox":
      return (
        <CwpCheckbox
          fieldKey={fieldKey}
          label={label}
          description={description}
          checked={!!value}
          onChange={onChange}
          // Pass a new prop to CwpCheckbox to enable its specific logic
          enableOverlay={fieldKey === "enable-overlay"}
        />
      );

    case "textarea":
      return (
        <AtrcPanelRow className={fieldKey}>
          <AtrcControlTextarea
            label={label}
            description={description}
            value={value}
            onChange={onChange}
          />
        </AtrcPanelRow>
      );

    case "select":
      return (
        <DynamicSelect
          fieldKey={fieldKey}
          field={field}
          value={value}
          onChange={onChange}
        />
      );

    case "icons":
      return (
        <AtrcPanelRow className={fieldKey}>
          <IconPicker value={value} onChange={onChange} />
        </AtrcPanelRow>
      );

    case "color":
      return (
        <AtrcPanelRow className={fieldKey}>
          <AtrcControlDropdownColor
            label={label}
            description={description}
            value={value}
            onChange={onChange}
            colors={[
              { name: "Black", slug: "black", color: "#000000" },
              { name: "White", slug: "white", color: "#ffffff" },
              { name: "Red", slug: "red", color: "#dd3333" },
              { name: "Orange", slug: "orange", color: "#dd9933" },
              { name: "Yellow", slug: "yellow", color: "#eeee22" },
              { name: "Green", slug: "green", color: "#81d742" },
              { name: "Blue", slug: "blue", color: "#1e73be" },
              { name: "Purple", slug: "purple", color: "#8224e3" },
            ]}
          />
        </AtrcPanelRow>
      );

    case "toggle":
      return (
        <AtrcPanelRow className={fieldKey}>
          <AtrcControlToggle
            label={label}
            description={description}
            checked={!!value}
            onChange={onChange}
          />
        </AtrcPanelRow>
      );

    case "responsive_number":
      return (
        <ResponsiveNumber
          fieldKey={fieldKey}
          label={label}
          description={description}
          value={value}
          onChange={onChange}
        />
      );

    case "cssbox":
      return (
        <CssBox
          fieldKey={fieldKey}
          label={label}
          description={description}
          value={value}
          onChange={onChange}
          fields={field.box_fields}
          linkText={field.attr.link_text}
          className={field.class}
        />
      );

    case "image":
      return (
        <AtrcPanelRow className={fieldKey}>
          <CwpControlFile
            label={label}
            description={description}
            value={value} // Pass the raw URL value
            onChange={onChange} // Pass the original onChange
            // Enable the background image class logic if fieldKey matches
            enableBgImage={fieldKey === "background-image"}
          />
        </AtrcPanelRow>
      );

    default:
      return null;
  }
}

export default CustomField;
