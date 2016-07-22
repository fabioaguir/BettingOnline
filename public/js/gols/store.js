// Função para criar no banco de dados
function store(dados)
{
    // Requisição ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('betting.gols.store'),
        data: dados,
        datatype: 'json'
    }).done(function (jsonResponse) {
        if (jsonResponse.success) {
            // Html de retonro
            var gol = jsonResponse.data;

            // Atualizando o resultado
            builderResultado(gol.partida_id);

            // Limpando os campos
            clearFields();

            // Carregando a grid principal
            if(table != null) {
                table.ajax.reload();
            } else {
                loadTable(gol.partida_id).ajax.url(laroute.route('betting.gols.grid', {'idPartida' : gol.partida_id})).load();
            }

            // Resetando a validação
            $('#formGol').bootstrapValidator("resetForm",true);
            $('#partida_id option').attr('selected', false);
            $('#partida_id option[value=' + gol.partida_id + ']').prop('selected', true);

            // Mensagem
            bootbox.alert('Cadastro realizado com sucesso!');
        } else {
            // Mensagem de retorno caso ocorra algum problema
            bootbox.alert(jsonResponse.msg);
        }
    });
}

// Função par limpar os campos
function clearFields() {
    $('#minutos').val('');
    $('#tempo_id option:selected').attr('selected', false);
    $('#time_id option:selected').attr('selected', false);
}