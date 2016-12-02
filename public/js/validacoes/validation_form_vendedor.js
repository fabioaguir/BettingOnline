$(document).ready(function () {
    $('#formVendedor').bootstrapValidator({
        excluded: [':disabled'],
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'nome': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'area_id': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'usuario': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'senha': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'config[limite_vendas]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'config[comissao]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'config[cotacao]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            }
        }
    });
});
