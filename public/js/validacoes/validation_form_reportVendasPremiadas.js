
$(document).ready(function () {
    $('#formReportVendasPremiadas').validate({
        rules: {
            'data_inicio': {
                required: true
            },
            'data_fim': {
                required: true
            },
            'exportar': {
                required: true
            },
        },
        messages: {
            'data_inicio': "Este campo é obrigatório",
            'data_fim': "Este campo é obrigatório",
            'exportar': "Este campo é obrigatório",
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});