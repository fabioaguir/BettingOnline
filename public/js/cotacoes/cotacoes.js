// Evento para quando clicar no botão de pesquisa
$(document).on('click', '#btnSearch', function (event) {
    // Recuperando o valor da data
    var searchDate   = $('#searchDate').val();
    var dataValidate = searchDate.split('/');

    // Validando o valor da data
    if(!(dataValidate.length == 3)) {
        // Mensagem de alerta
        bootbox.alert("Informe uma data válida!");

        // Cancelando a execução do evento
        event.preventDefault();
    }

    // Requisição ajax
    jQuery.ajax({
        type: 'GET',
        url: laroute.route('betting.partidas.getPartidasSemApostas'),
        data: {'data' : searchDate},
        datatype: 'json'
    }).done(function (jsonResponse) {
        if (jsonResponse.success) {
            // Html de retonro
            var html = '<option value="">Selecione uma partida</option>';

            // Recuperando as partidas
            var partidas = jsonResponse.data;

            // Percorrendo as partidas
            $.each(partidas, function(index, value) {
                html += '<option value="' + value.id + '">' + value.timeCasa + ' x ' + value.timeFora + '</option>';
            });

            // Carregando o html no selecect
            $('#partida_id').html(html);
        } else {
            // Mensagem de retorno caso ocorra algum problema
            bootbox.alert(jsonResponse.msg);
        }
    });
});
