$(document).on("click", '[data-bs-toggle="modal"][data-content]', function (e) {
    e.preventDefault();

    const trigger = $(this);
    const target = trigger.attr("data-bs-target");
    const contentUrl = trigger.attr("data-content");
    const modal = $(target);

    if (!modal.length || !contentUrl) {
        return;
    }

    const dialog = modal.find(".modal-dialog");
    const size = trigger.attr("data-modal-size");

    dialog.removeClass("modal-sm modal-lg modal-xl modal-dialog-scrollable");
    dialog.addClass(size ? `modal-${size}` : "modal-lg");
    dialog.addClass("modal-dialog-scrollable");
    modal.find(".modal-content").html(
        '<div class="modal-body text-center py-5"><div class="spinner-border text-primary" role="status" aria-label="Loading"></div></div>'
    );

    modal.find(".modal-content").load(contentUrl, function (response, status) {
        if (status === "error") {
            modal.find(".modal-content").html(
                '<div class="modal-body text-center py-5 text-danger">Unable to load this content.</div>'
            );

            return;
        }

        initializeSupplierModal(modal);
        initializeColorPicker(modal);

        modal.find(".datepicker").each(function () {
            new Litepicker({
                element: this,
                buttonText: {
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                },
            });
        });
    });
});

$(function () {
    const assessmentTrigger = $('[data-auto-open-modal="assessment"]').first().get(0);

    if (assessmentTrigger) {
        assessmentTrigger.click();
    }
});

$(document).on("submit", ".ajax-form", function (e) {
    e.preventDefault();

    const form = $(this);
    const modal = form.closest(".modal");
    const submitButton = form.find('[type="submit"]');
    const submitLabel = submitButton.attr("data-submit-label") || submitButton.text().trim();

    clearValidationErrors(form);
    submitButton
        .prop("disabled", true)
        .html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...');

    $.ajax({
        url: form.attr("action"),
        method: form.attr("method") || "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        headers: {
            "X-Modal-Request": "true",
            Accept: "application/json",
        },
    })
        .done(function (response) {
            if (response.status === "success") {
                if (typeof notyf !== "undefined") {
                    notyf.success(response.message);
                }

                bootstrap.Modal.getInstance(modal[0])?.hide();

                if (response.tableName && $.fn.DataTable.isDataTable(`#${response.tableName}`)) {
                    $(`#${response.tableName}`).DataTable().ajax.reload(null, false);
                } else {
                    window.location.reload();
                }
            }
        })
        .fail(function (xhr) {
            if (xhr.responseJSON?.errors) {
                showValidationErrors(form, xhr.responseJSON.errors);
            } else if (xhr.responseJSON?.message && typeof notyf !== "undefined") {
                notyf.error(xhr.responseJSON.message);
            }
        })
        .always(function () {
            submitButton.prop("disabled", false).text(submitLabel);
        });
});

$(document).on("click", '[data-document-preview="image"]', function () {
    const source = $(this).attr("data-document-preview-url") || $(this).attr("src");

    if (!source) {
        return;
    }

    const previewModal = $("#modal-document-preview");
    previewModal.find("[data-document-preview-pdf]").addClass("d-none").attr("src", "");
    previewModal.find("[data-document-preview-image]").attr("src", source).removeClass("d-none");
    bootstrap.Modal.getOrCreateInstance(previewModal[0]).show();
});

$(document).on("click", '[data-document-preview="pdf"]', function () {
    const source = $(this).attr("src");

    if (!source) {
        return;
    }

    const previewModal = $("#modal-document-preview");
    previewModal.find("[data-document-preview-image]").addClass("d-none").attr("src", "");
    previewModal.find("[data-document-preview-pdf]").attr("src", source).removeClass("d-none");
    bootstrap.Modal.getOrCreateInstance(previewModal[0]).show();
});

$(document).on("click", "[data-document-preview-pdf-trigger]", function (event) {
    if ($(event.target).is('[data-document-preview="image"]')) {
        return;
    }

    const source = $(this).attr("data-document-preview-url") || $(this).find('[data-document-preview="pdf"]').attr("src");

    if (!source) {
        return;
    }

    const previewModal = $("#modal-document-preview");
    previewModal.find("[data-document-preview-image]").addClass("d-none").attr("src", "");
    previewModal.find("[data-document-preview-pdf]").attr("src", source).removeClass("d-none");
    bootstrap.Modal.getOrCreateInstance(previewModal[0]).show();
});

$(document).on("hidden.bs.modal", "#modal-document-preview", function () {
    $(this).find("[data-document-preview-image]").attr("src", "");
    $(this).find("[data-document-preview-pdf]").attr("src", "");
});

function initializeSupplierModal(modal) {
    modal.find("[data-supplier-document-input]").off("change.supplierPreview").on("change.supplierPreview", function () {
        const file = this.files[0];
        const imagePreview = modal.find("[data-supplier-image-preview]");
        const pdfPreview = modal.find("[data-supplier-pdf-preview]");

        if (!file) {
            return;
        }

        if (file.type === "application/pdf") {
            const pdfUrl = URL.createObjectURL(file);
            pdfPreview.attr("src", pdfUrl).removeClass("d-none");
            pdfPreview.closest("[data-document-preview-pdf-trigger]").attr("data-document-preview-url", pdfUrl);
            imagePreview.addClass("d-none");
        } else if (file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (event) {
                imagePreview.attr("src", event.target.result).removeClass("d-none");
                pdfPreview.attr("src", "").addClass("d-none");
                pdfPreview.closest("[data-document-preview-pdf-trigger]").attr("data-document-preview-url", "");
            };
            reader.readAsDataURL(file);
        }
    });
}

function initializeColorPicker(modal) {
    const colorPicker = modal.find("[data-color-picker]");

    if (!colorPicker.length || typeof window.Coloris === "undefined") {
        return;
    }

    window.Coloris({
        el: `#${colorPicker.attr("id")}`,
        parent: `#${modal.attr("id")}`,
        selectInput: false,
        alpha: false,
        format: "hex",
        swatches: [
            "#0054a6",
            "#45aaf2",
            "#6574cd",
            "#a55eea",
            "#f66d9b",
            "#fa4654",
            "#fd9644",
            "#f1c40f",
            "#7bd235",
            "#5eba00",
            "#2bcbba",
            "#17a2b8",
        ],
    });
}

$(document).on("hidden.bs.modal", "#modal-global", function () {
    $(this).find(".modal-content").empty();
});

function clearValidationErrors(form) {
    form.find(".is-invalid").removeClass("is-invalid");
    form.find(".form-errors").remove();
    form.find(".text-danger").removeClass("text-danger");
}

function showValidationErrors(form, errors) {
    clearValidationErrors(form);

    Object.entries(errors).forEach(([fieldName, messages]) => {
        const field = form.find(`[name="${fieldName}"]`).first();

        if (!field.length) {
            return;
        }

        field.addClass("is-invalid");

        // Walk up to the nearest ancestor with a col-* or mb-* class,
        // instead of only matching a hardcoded list of grid classes.
        const fieldGroup = field.parents().filter(function () {
            return /(^|\s)(col-|mb-)/.test(this.className);
        }).first();

        if (!fieldGroup.length) {
            if (typeof notyf !== "undefined") {
                notyf.error(messages[0]);
            }
            return;
        }

        fieldGroup.addClass("text-danger");
        const feedback = $('<small class="text-danger form-errors d-block mt-1"></small>').text(messages[0]);
        fieldGroup.append(feedback);

        if (typeof notyf !== "undefined") {
            notyf.error(messages[0]);
        }
    });
}
