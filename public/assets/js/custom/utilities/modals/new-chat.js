"use strict"; var KTModalNewchat = function () {
    var t, e, n, a, o, i, close; return {
        init: function () {
            (
                    i = document.querySelector("#kt_modal_new_chat")) && (o = new bootstrap.Modal(i),
                    a = document.querySelector("#kt_modal_new_chat_form"),
                    t = document.getElementById("kt_modal_new_chat_submit"),
                    e = document.getElementById("kt_modal_new_chat_cancel"),
                    close = document.getElementById("close_new_chat"),

                    close.addEventListener('click', function(){

                        a.reset();

                    }),
                        $(a.querySelector('[name="due_date"]')).flatpickr({ enableTime: !0, dateFormat: "d, M Y, H:i" }),
                    $(a.querySelector('[name="team_assign"]')).on("change", (function () { n.revalidateField("team_assign") })), n = FormValidation.formValidation(a, {
                        fields: {
                            new_chat_title: { validators: { notEmpty: { message: "chat title is required" } } }, chat_assign: { validators: { notEmpty: { message: "chat assign is required" } } },
                            chat_due_date: { validators: { notEmpty: { message: "chat due date is required" } } }, chat_tags: { validators: { notEmpty: { message: "chat tags are required" } } },
                            "chats_notifications[]": { validators: { notEmpty: { message: "Please select at least one communication method" } } }
                        }, plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" })
                        }
                    }),

                    // t.addEventListener("click", (function (e) {

                    //     e.preventDefault(), n && n.validate().then((function (e) {
                    //         console.log("validated!"), "Valid" == e ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0,
                    //             setTimeout((function () {
                    //                 t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({ text: "Form has been successfully submitted!", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } }).then((function (t) {
                    //                     t.isConfirmed && o.hide()
                    //                 }))
                    //             }), 2e3)) : Swal.fire({ text: "Sorry, looks like there are some errors detected, please try again.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } })
                    //     }))
                    // })),

                    e.addEventListener("click", (function (t) {
                        t.preventDefault(), Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                             buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                             cancelButtonText: "No, return",
                              customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" }

                        }).then(function (result) {
                            if (result.value) {
                                a.reset(); // Reset form
                                o.hide(); // Hide modal
                            }
                        })

                    })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () { KTModalNewchat.init() }));
