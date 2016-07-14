
$(document).ready(function () {
    $('#formPartida').validate({
        rules: {
            'data': {
                required: true
            },
            'hora': {
                required: true
            },
            'campeonato_id': {
                required: true
            },
            'time_casa_id': {
                required: true
            },
            'time_fora_id': {
                required: true
            },
            'status_id': {
                required: true
            },
        },
        messages: {
            'data': "Este campo é obrigatório",
            'hora': "Este campo é obrigatório",
            'campeonato_id': "Este campo é obrigatório",
            'time_casa_id': "Este campo é obrigatório",
            'time_fora_id': "Este campo é obrigatório",
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