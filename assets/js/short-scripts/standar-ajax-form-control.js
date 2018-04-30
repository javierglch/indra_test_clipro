$(document).ready(function (e) {
    $('.ajax-form:not(.scanned)').submit(function (e2) {
        e2.preventDefault();
        var submit = $(e.target).find('[type="submit"]');
        if ($(submit).prop('disabled') == true) {
            return false;
        }
        if ($(submit).attr('confirm') && !confirm($(submit).attr('confirm'))) {
            return false;
        }
        var btn_text = $(submit).html();
        $(submit).html('<i class="fas fa-spinner"></i>');
        $(submit).prop('disabled', true);
        $(submit).addClass('waiting');
        var url = $(this).attr("action");
        var method = $(this).attr("method");
        //var enctype = this.attr("multipart/form-data");
        var data = new FormData(document.getElementById($(this).attr("id")));
        var dataType = $(this).attr("dataType") ? $(this).attr("dataType") : 'json';
        var callback = $(this).attr("callback");
        $("#formValidation").html('');
        $.ajax({
            url: url,
            type: method,
            data: data,
            processData: false,
            contentType: false,
            dataType: dataType,
            success: window[callback],
            complete: function (e) {
                $(submit).prop('disabled', false);
                $(submit).removeClass('waiting');
                $(submit).html(btn_text);
            }
        }).fail(function (e) {
            alert(e.status + ' - ' + e.statusText);
        });
        return false;
    }).addClass('scanned');

    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
});

function DefaultFormResponse(json) {
    console.log(json)
    if (json.csrf_token_hash) {
        $('#' + json.form_uuid + ' [name="' + json.csrf_token_name + '"]').val(json.csrf_token_hash)
    }
    if (json.errors) {
        for (var campo in json.errors) {
            var errormsg = json.errors[campo];
            if (campo == "#formValidation") {
                $(campo).prepend(errormsg)
            } else {
                $('#' + json.form_uuid + ' [name="' + campo + '"]').parent().prepend(errormsg);
                $('#' + json.form_uuid + ' [name="' + campo + '"]').addClass('is-invalid').on('keydown',function(e){
                    $(this).removeClass('is-invalid');
                });
            }
        }
    } else {
        if (json.msgs) {
            for (var index in json.msgs) {
                var msg = json.msgs[index];
                $('#' + json.form_uuid).prepend(msg);
            }
        }
        if (json.redirect_to) {
            window.location = json.redirect_to;
        } else if (json.redirect_to_blank) {
            open(json.redirect_to_blank);
        } else {
            location.reload();
        }
    }
}

function AjaxUploadFile(o, uri, inputQuery, onSuccessFunction) {
    var button = $(o);
    if (button.prop('disabled') == true) {
        return;
    }
    button.prop('disabled', true);
    button.addClass('waiting');
    var btn_text = button.html();
    button.html(btn_text + ' <i class="fa fa-spinner fa-spin"></i>');

    var form = new FormData();
    form.append($(inputQuery).attr('name'), $(inputQuery)[0].files[0]);

    $.ajax({
        url: uri,
        type: 'POST',
        data: form,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: window[onSuccessFunction],
        complete: function (e) {
            button.html(btn_text);
            button.prop('disabled', false);
            button.removeClass('waiting');
        }
    }).fail(function (e) {
        alert(e.status + ' - ' + e.statusText);
    });
}