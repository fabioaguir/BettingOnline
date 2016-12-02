// Evento para finalizar a partida
$(document).on('click', '#btnConcludeGol', function () {
    // Recuperando a partida selecionada
    var idPartida = $('#partida_id option:selected').val();

    // Validando o valor da data
    if(!$.isNumeric(idPartida)) {
        // Mensagem de alerta
        bootbox.alert("Partida inválida!");

        // Cancelando a execução do evento
        return false;
    }

    // Requisição ajax
    jQuery.ajax({
        type: 'PUT',
        url: laroute.route('betting.gols.conclude', {'idPartida' : idPartida}),
        datatype: 'json'
    }).done(function (jsonResponse) {
        if (jsonResponse.success) {
            // Mensagem
            bootbox.alert('Partida finalizada com sucesso!');

            // recarregando a página
            location.reload();
        } else {
            // Mensagem de retorno caso ocorra algum problema
            bootbox.alert(jsonResponse.msg);
        }
    });
});
