// Função para criar no banco de dados
function builderResultado(idPartida)
{
    // Requisição ajax
    jQuery.ajax({
        type: 'GET',
        url: laroute.route('betting.gols.getResultado', {'idPartida' : idPartida}),
        datatype: 'json'
    }).done(function (jsonResponse) {
        if (jsonResponse.success) {
            // Dados de retorno
            var resultado = jsonResponse.data;

            // Carregando o html de resultado
            $('#time_casa').html(resultado[0].time_casa);
            $('#time_fora').html(resultado[0].time_fora);
            $('#gols_casa').html(resultado[0].gols_casa);
            $('#gols_fora').html(resultado[0].gols_fora);
        } else {
            // Mensagem de retorno caso ocorra algum problema
            bootbox.alert(jsonResponse.msg);
        }
    });
}
