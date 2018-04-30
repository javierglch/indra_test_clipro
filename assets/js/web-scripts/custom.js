$(document).ready(function (e) {
    $('[data-toggle="tooltip"]').tooltip();

    $(".datatable").DataTable().on('draw', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    $('th').css('width','');

})