$(document).ready(function () {
    $('#formReportVendas').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'data_inicio': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: "O formato da data está inválido",
                    },
                },
            },
            'data_fim': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: "O formato da data está inválido",
                    }
                }
            },
            'vendedor': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    },
                },
            },
            'premiacao': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    }
                }
            },
            'status': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    }
                }
            },
            'area': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório",
                    }
                }
            }
        }
    });
});
