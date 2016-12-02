// Opções para validação
var options = {
    excluded: [':disabled'],
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    submitHandler: null,
    fields: {
        'partida_id': {
            validators: {
                notEmpty: {
                    message: "Este campo é obrigatório",
                }
            }
        },
        'time_id': {
            validators: {
                notEmpty: {
                    message: "Este campo é obrigatório",
                }
            }
        },
        'tempo_id': {
            validators: {
                notEmpty: {
                    message: "Este campo é obrigatório",
                }
            }
        },
        'minutos': {
            validators: {
                notEmpty: {
                    message: "Este campo é obrigatório",
                },
                regexp: {
                    regexp: '([0-2][03]|23):([0-5][0-9]|60):([0-5][0-9]|60)',
                    message: 'Formato da hora não é válido. HH:mm:ss'
                }
            }
        }
    }
};

