
$(document).ready(function () {
    $('#formCotacao').validate({
        rules: {
            'partida_id': {
                required: true
            },
            'modalidade_id': {
                required: true
            },
            'valor': {
                required: true
            },
            'status_id': {
                required: true
            }
        },
        messages: {
            'partida_id': "Este campo é obrigatório",
            'modalidade_id': "Este campo é obrigatório",
            'valor': "Este campo é obrigatório",
            'status_id': "Este campo é obrigatório",
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