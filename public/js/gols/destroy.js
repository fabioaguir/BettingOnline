// Evento para remover no banco de dados
$(document).on('click', 'a.delete', function (event) {
    // Parando a propagação do evento
    event.preventDefault();

    // Recuperando o id da partida
    var id = table.row($(this).parent().parent().index()).data().id;

    // Prompt para confirmação de cadastro
    bootbox.confirm("Tem certeza da exclusão do item?", function (result) {
        if (result) {
            // Requisição ajax
            jQuery.ajax({
                type: 'DELETE',
                url: laroute.route('betting.gols.delete', {'id' : id}),
                datatype: 'json'
            }).done(function (jsonResponse) {
                if (jsonResponse.success) {
                    // Html de retonro
                    var idPartida = jsonResponse.data;

                    // Limpando os campos
                    clearFields();

                    // Carregando a grid principal
                    if(table != null) {
                        table.ajax.reload();
                    } else {
                        loadTable(idPartida).ajax.url(laroute.route('betting.gols.grid', {'idPartida' : idPartida})).load();
                    }

                    // Mensagem
                    bootbox.alert('Dados removidos com sucesso!');
                } else {
                    // Mensagem de retorno caso ocorra algum problema
                    bootbox.alert(jsonResponse.msg);
                }
            });
        } else {
            false;
        }
    });
});
