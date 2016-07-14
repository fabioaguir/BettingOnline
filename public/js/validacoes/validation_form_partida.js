$(document).ready(function () {
    $('#formPartida').bootstrapValidator({
        excluded: [':disabled'],
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'data': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: "O formato da data está inválido",
                    }
                },
            },
            'hora': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'campeonato_id': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'time_fora_id': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'time_casa_id': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            }
        }
    });
});
