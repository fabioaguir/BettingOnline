// Evento para salvar o gol
$('#formGol').submit(function (event) {
    // Parando a propagação do evento
    event.preventDefault();

    // Array de campos
    var dados = {
        'partida_id' : $('#partida_id option:selected').val(),
        'time_id' : $('#time_id option:selected').val(),
        'tempo_id' : $('#time_id option:selected').val(),
        'minutos' : $('#minutos').val(),
    };

     //Processando a requisição
     store(dados);
});
