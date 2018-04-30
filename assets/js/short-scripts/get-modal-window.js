
function loadModalView(o) {
    var btn_text = $(o).html();
    $(o).html('<i class="fas fa-spinner"></i>');
    $.get('/get-modal', {
        modal_template: $(o).attr('data-modal-template'),
        modal_title: $(o).attr('data-modal-title'),
        params_json: $(o).attr('data-modal-params-json'),
    }, function (json) {
        $('html body').append(json.html);
        $('#' + json.modal_id).modal();
        $(o).html(btn_text);
        $('[data-toggle="tooltip"]').tooltip('hide');
        $('#' + json.modal_id).on('hidden.bs.modal', function (e) {
            $('#' + json.modal_id).remove();
        });
    });
}