@extends('menu')

@section('css')
    @parent
    <style>
        .form-group {
            margin-top: -10px;;
        }
        .table-responsive {
            min-height: 0.01%;
            overflow-x: initial;
        }
    </style>
@endsection

@section('page-heading')
    <h1>Vendedores</h1>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-sm-12">

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <em> {!! session('message') !!}</em>
                    </div>
                @endif

                @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Editar vendedor</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>

                    <div class="panel-body">
                        @include('tamplatesForms.tamplateFormVendedorEdit')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_vendedorEdit.js')}}"></script>
    <script type="text/javascript">
        var idConfigVendas = 0;
        var table = $('#confg-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('betting.vendedor.gridConfig', ['id' => $model->id]) }}",
                method: 'POST'
            },
            language: {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Não foram encontrados resultados",
                "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando de 0 até 0 de 0 registros",
                "infoFiltered": "(Filtrado de _MAX_ total de registro)",
                "sProcessing":   "Processando...",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Seguinte",
                    "sLast":     "Último"
                }
            },
            columns: [
                {data: 'vendas', name: 'conf_vendas.limite_vendas'},
                {data: 'comissao', name: 'conf_vendas.comissao'},
                {data: 'cotacao', name: 'conf_vendas.cotacao'},
                {data: 'tipo', name: 'tipo_cotacao.nome'},
                {data: 'status', name: 'status.nome'},
                {data: 'data', name: 'conf_vendas.data'},
                {data: 'total', name: 'vendas.valor_total', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('.dataTables_filter input').attr('placeholder','Pesquisar...');

        //Retonra da tabela os registro pertencentes a linha selecionada
        $('#confg-grid tbody').on( 'click', '.edit', function (event) {
            event.preventDefault();

            if ($(this).parent().parent().hasClass('selected')) {
                $(this).parent().parent().removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).parent().parent().addClass('selected');
            }
            var data = table.rows('.selected').data()[0];

            $('#limite').val(data['vendas']);
            $('#comissao').val(data['comissao']);
            $('#cotacao').val(data['cotacao']);
            tipoCotacao(data['id_tipo']);
            idConfigVendas = data['id']

            $('.save').prop('disabled', true);
            $('.edit').prop('disabled', false);

        } );

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
                    url: '{{route('betting.vendedor.updateConfig')}}',
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
                url: '{{ route('betting.allTipoCotacao')  }}',
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

    </script>
@endsection