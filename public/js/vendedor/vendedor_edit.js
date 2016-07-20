/**
 * Created by Fabio Aguiar on 17/07/2016.
 */
//salvar configurações do vendedor
$('.edit').on('click', function(){

    var limite = $('#limite').val();
    var comissao = $('#comissao').val();
    var cotacao = $('#cotacao').val();
    var tipoCota = $('#tipo_cotacao').val();

    var dados = {
        'limite_vendas': limite,
        'comissao': comissao,
        'cotacao': cotacao,
        'tipo_cotacao_id': tipoCota,
        'idConfig' : idConfigVendas
    }

    //Validando formulário configuração de vendas edit
    if(limite == "" || comissao == "" || cotacao == "" || tipoCota == "") {
        bootbox.alert('Todos os campos são de preenchimento obrigatório');
    } else {
        jQuery.ajax({
            type: 'POST',
            url: 'updateConfig',
            data: dados,
            datatype: 'json'
    }).done(function (json) {
            $('.save').prop('disabled', false);
            $('.edit').prop('disabled', true);
            bootbox.alert(json['msg']);
            table.ajax.reload()
            var limite = $('#limite').val("");
            var comissao = $('#comissao').val("");
            var cotacao = $('#cotacao').val("");
            tipoCotacao();

        });
    }

});

//Validando formulário configuração de vendas save
$('#formConfig').submit(function(event){
    var limite = $('#limite').val();
    var comissao = $('#comissao').val();
    var cotacao = $('#cotacao').val();
    var tipoCota = $('#tipo_cotacao').val();

    if(limite == "" || comissao == "" || cotacao == "" || tipoCota == "") {
        bootbox.alert('Todos os campos são de preenchimento obrigatório');
        return false;
    } else {
        return true;
    }
});

//Função para listar as localidades
function tipoCotacao(id) {
    jQuery.ajax({
        type: 'POST',
        url: 'allTipoCotacao',
        datatype: 'json',
}).done(function (json) {
        var option = '';
        for (var i = 0; i < json['tipoCotacaoes'].length; i++) {
            if (json['tipoCotacaoes'][i]['id'] == id) {
                option += '<option selected value="' + json['tipoCotacaoes'][i]['id'] + '">' + json['tipoCotacaoes'][i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json['tipoCotacaoes'][i]['id'] + '">' + json['tipoCotacaoes'][i]['nome'] + '</option>';
            }
        }
        $('#tipo_cotacao option').remove();
        $('#tipo_cotacao').append(option);
    });
}