// carregamento inicial da grid
loadTable(0).ajax.url(laroute.route('betting.gols.grid', {'idPartida' : 0})).load();

// Escondendo o título de partida finalizada
$('#textoDePartidaFinalizada').hide();

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
        return false;
    }

    // Requisição ajax
    jQuery.ajax({
        type: 'GET',
        url: laroute.route('betting.partidas.getPartidas'),
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

// Evento para quando clicar no botão de pesquisa
$(document).on('change', '#partida_id', function (event) {
    // Recuperando o valor da data
    var idPartida   = $('#partida_id').val();

    // Validando o valor da data
    if(!$.isNumeric(idPartida)) {
        // Mensagem de alerta
        bootbox.alert("Partida inválida!");

        // Removendo os times escolhidos
        $('#time_id option').remove();

        // Cancelando a execução do evento
        return false;
    }

    // Atualizando o resultado
    builderResultado(idPartida);

    // Carregando a grid
    loadTable(idPartida).ajax.url(laroute.route('betting.gols.grid', {'idPartida' : idPartida})).load();

    // Requisição ajax
    jQuery.ajax({
        type: 'GET',
        url: laroute.route('betting.gols.getTimes'),
        data: {'data' : idPartida},
        datatype: 'json'
    }).done(function (jsonResponse) {
        if (jsonResponse.success) {
            // Html de retonro
            var html = '<option value="">Selecione um time</option>';

            // Recuperando as partidas
            var times = jsonResponse.data;

            // Percorrendo as partidas
            $.each(times, function(index, value) {
                html += '<option value="' + value.id + '">' + value.nome + '</option>';
            });

            // Carregando o html no selecect
            $('#time_id').html(html);
        } else {
            // Mensagem de retorno caso ocorra algum problema
            bootbox.alert(jsonResponse.msg);
        }
    });
});


