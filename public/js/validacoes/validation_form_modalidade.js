
$(document).ready(function () {
    $('#formModalidade').validate({
        rules: {
            'nome': {
                required: true
            },
            'status_id': {
                required: true
            },
        },
        messages: {
            'nome': "Este campo é obrigatório",
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