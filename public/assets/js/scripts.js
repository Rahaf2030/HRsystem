$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function ($) {

    var search_url = $('#searchBar').attr('data-href');
    call_chat();

    $('#sidebar_chat').on('mouseover', '.chat_card', function () {

        $(this).find('#delete_chat_btn').show();
        $(this).find('#chat_date').hide();

        $('.console').append('over');
    });

    $('#sidebar_chat').on('mouseout', '.chat_card', function () {

        $(this).find('#delete_chat_btn').hide();

        $(this).find('#chat_date').show();


        $('.console').append('out');
    });

    $('#searchBar').on('keyup', function () {
        var query = $(this).val();

        $.ajax({
            url: search_url,
            type: "GET",
            data: { query: query },
            success: function (response) {
                $('#sidebar_chat').html(response);
                if($('#chat_id').val() != 0 ){
                    $(".chat_card").each(function(e){
                    if ($(this).attr("data-id") == $('#chat_id').val()) {
                    $("#sidebar_chat .chat_card").not(this).removeClass("active");
                    $(this).addClass("active");
                 }
             });
            }

            }
        });

    });




$('#sidebar_chat').on('click', '.delete_chat', function () {

    url = $(this).attr('data-href');
    parent = $(this).closest('.chat_card');

    Swal.fire({
        title: 'Are you sure?',
        text: "Please click confirm to delete this item",
        icon: 'warning',
        showCancelButton: !0,
        buttonsStyling: !1,
        showCancelButton: true,
        cancelButtonText: "No, cancle",
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-active-light"
        }

    }).then(function (result) {

        if (result.value) {


            $.ajax(
                {
                    url: url,
                    type: "POST",
                    data: { _method: "DELETE", chat_id: chat_id },
                    success: function () {

                        $('#chat_id').val(0);
                        if ($('#searchBar').val()) {
                            $('#searchBar').val("");
                            $('#searchBar').trigger('keyup');
                        }
                        parent.remove();
                        call_chat();

                    }
                });


        } // do i need else ?
    });
});

});

var send_isClicked = 0;

function load_chat(chat_id) {

    $('#sidebar_chat').on('click', '.chat_card', function () {
        $("#sidebar_chat .chat_card").not(this).removeClass("active");
        $(this).addClass("active");
    });
    $('#chat_id').val(chat_id);
    call_chat();

}

function call_chat() {
    chat_id = $('#chat_id').val();

    $.ajax({
        url: $('#chat_url').val(),
        type: 'GET',
        data: { chat_id: chat_id },
        success: function (response) {

            $('#kt_chat_messenger').html(response);
            upload_file();
            send_message();

        }
    });

}

function upload_file() {

    const t = '[data-kt-inbox-form="dropzone"]', a = document.querySelector('[data-kt-inbox-form="dropzone"]'),
        n = document.querySelector('[data-kt-inbox-form="dropzone_upload"]');
    if (typeof (a) != 'undefined' && a != null) {

        var o = a.querySelector(".dropzone-item"); o.id = "";
        var r = o.parentNode.innerHTML;
        o.parentNode.removeChild(o);
        a.style.display = '';
        var l = new Dropzone(t, {
            url: $('#uploadUrl').val(),
            acceptedFiles: ".xlsx , .xls , .csv, .txt ,.docx, .pdf ,.pptx",
            parallelUploads: 20,
            maxFilesize: 50,
            previewTemplate: r,
            previewsContainer: t + " .dropzone-items",
            clickable: n
        });

        l.on("addedfile", (function (e) {
            a.querySelectorAll(".dropzone-item").forEach((e => { e.style.display = "" }))
        })),
            l.on("totaluploadprogress", (function (e) {
                a.querySelectorAll(".progress-bar").forEach((t => { t.style.width = e + "%" }))
            })),
            l.on("sending", (function (file, xhr, formData) {
                formData.append('_token', $('#csrfToken').val());
                formData.append('chat_id', $('#chat_id').val());
                a.querySelectorAll(".progress-bar").forEach((e => { e.style.opacity = "1" }))
            })),
            l.on("complete", (function (e) {
                const t = a.querySelectorAll(".dz-complete");
                setTimeout((function () {
                    t.forEach((e => {
                        e.querySelector(".progress-bar").style.opacity = "0",
                            e.querySelector(".progress").style.opacity = "0"
                    }))
                }), 300)

            })),
            l.on("error", function (file, responseText) {
                a.style.display = 'none';
                if (responseText.message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Can\'t read the file',
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: responseText,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }

            }),
            l.on("success", function (file, response) {
                call_chat();
                send_isClicked = 0;

               setTimeout(function () {//settimeout for 1 min after uploading file
                    if (!send_isClicked) {
                        $.ajax({
                            // async:true,
                            url: $('#chatMessage_url').val(),
                            type: "POST",
                            data: { chat_id: $('#chat_id').val(), text: "Could you please provide a question or clear statment, so I can assist you better?", sent: 0 },
                            success: function () {
                                call_chat();
                            }
                        });
                    }
                }, 60000);


            });



    }
}

function send_message() {

    textarea_message = document.getElementById("message_input");
    send_message_btn = document.getElementById("send_btn");


    if (typeof (textarea_message) != 'undefined' && textarea_message != null) {

        textarea_message.addEventListener("keyup", function (e) {
            if (this.value.length > 0) {
                send_message_btn.disabled = false;

            } else {
                send_message_btn.disabled = true;
            }

        });
        textarea_message.addEventListener("keypress", function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                send_message_btn.click();

            }
        })
    }
    if (typeof (send_message_btn) != 'undefined' && send_message_btn != null) {

        send_message_btn.addEventListener("click", function (e) {
            send_isClicked = 1;

            e.preventDefault();

            chat_id = $('#chat_id').val();

            text = $('#message_input').val();

            url = $('#chatMessage_url').val();



            $.ajax({
                url: url,
                type: "POST",
                data: { text: text, chat_id: chat_id, sent: 1 },
                success: function () {

                    $.when($.ajax(call_chat())).then(function () {
                        chatgptResponse(chat_id);
                    });
                },
                error: function(){
                    error_message(chat_id)
                }
            });

        });
    }
}
function chatgptResponse(chat_id) {
    $('.typing-indicator').show();

    $.ajax({
        url: $('#chatGPT_url').val(),
        type: "POST",
        data: { chat_id: chat_id },
        success: function () {
            call_chat();
        },
        error: function(){
            error_message(chat_id);
        }
    });
}

function error_message(chat_id){

    $.ajax({
        url: $('#chatMessage_url').val(),
        type: "POST",
        data: { chat_id: chat_id, text:"Sorry, we are having technical issue.",sent: 0},
        success: function () {
            call_chat();
        }
    });
}




