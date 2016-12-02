// Evento para salvar o gol
$('#formGol').on('submit', function (event) {
    // Parando a propagação do evento
    event.preventDefault();

    // Array de campos
    var dados = {
        'partida_id' : $('#partida_id option:selected').val(),
        'time_id' : $('#time_id option:selected').val(),
        'tempo_id' : $('#tempo_id option:selected').val(),
        'minutos' : $('#minutos').val(),
    };

    // Validando o formulário
    $('#formGol').bootstrapValidator(options);
    var validate = $('#formGol').data('bootstrapValidator').validate().isValid();

     //Processando a requisição
    if(validate) {
        store(dados);
    }
});