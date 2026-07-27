wp.customize.controlConstructor["cosmoswp-sortable"] =
  wp.customize.Control.extend({
    ready: function () {
      "use strict";
      const control = this;
      const {
        label = "",
        description = "",
        choices = {},
        inputAttrs = "",
      } = control.params || {};
      let value = control.setting.get();
      if (!Array.isArray(value)) {
        value = [];
      }

      control.container.html(`
            <div class='cwp-czr-ctrl cwp-czr-ctrl--sort at-gap at-flx at-flx-col'>
                <span class="cwp-czr-ctrl--ttl at-txt">${label}</span>
                ${
                  description
                    ? `<span class="description cwp-czr-ctrl-desc">${description}</span>`
                    : ""
                }
                <ul class="sortable cwp-czr-ctrl--sort-cont at-flx at-flx-col at-gap">
                    ${value
                      .map(choiceID =>
                        this.renderListItem(
                          choiceID,
                          choices[choiceID],
                          inputAttrs,
                        ),
                      )
                      .join("")}
                    ${Object.keys(choices)
                      .map(choiceID =>
                        !value.includes(choiceID)
                          ? this.renderListItem(
                              choiceID,
                              choices[choiceID],
                              inputAttrs,
                              true,
                            )
                          : "",
                      )
                      .join("")}
                </ul>
            </div>
        `);

      control.sortableContainer = control.container.find("ul.sortable").first();
      control.sortableContainer
        .sortable({ stop: () => control.updateValue() })
        .disableSelection();
      control.sortableContainer.find("li").each(function () {
        jQuery(this)
          .find(".cwp-czr-ctrl--sort-icon")
          .click(function () {
            // jQuery(this)
            // 	.toggleClass('dashicons-hide')
            // 	.closest('li')
            // 	.toggleClass('invisible');
            var $li = jQuery(this).closest("li");
            $li.toggleClass("cwp-czr-ctrl--sort-itm-disabled");

            if ($li.hasClass("cwp-czr-ctrl--sort-itm-disabled")) {
              jQuery(this)
                .removeClass("dashicons-visibility")
                .addClass("dashicons-hidden");
            } else {
              jQuery(this)
                .removeClass("dashicons-hidden")
                .addClass("dashicons-visibility");
            }
          });
        jQuery(this).click(() => control.updateValue());
      });
    },

    renderListItem: function (
      choiceID,
      choiceLabel,
      inputAttrs,
      invisible = false,
    ) {
      return `<li ${inputAttrs} class='cwp-czr-ctrl--sort-itm at-opa at-flx at-al-itm-ctr at-gap at-p at-m at-bg-cl at-bdr at-bdr-rad at-cur at-pos ${
        invisible ? "cwp-czr-ctrl--sort-itm-disabled" : ""
      }' data-value='${choiceID}'>
            ${
              /* Commented out old icon: <i class="cwp-czr-ctrl--sort-icon at-cur dashicons dashicons-visibility ${
                invisible ? 'dashicons-hide' : ''
            }"></i> */ ""
            }
            <i class="cwp-czr-ctrl--sort-icon at-cur dashicons ${
              invisible ? "dashicons-hidden" : "dashicons-visibility"
            }"></i>
            ${choiceLabel || ""}
            
        </li>`;
    },

    updateValue: function () {
      const control = this;
      const newValue = control.sortableContainer
        .find("li:not(.cwp-czr-ctrl--sort-itm-disabled)")
        .map(function () {
          return jQuery(this).data("value");
        })
        .get();
      control.setting.set(newValue);
    },
  });
