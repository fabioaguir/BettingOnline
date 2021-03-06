@extends('menu')

@section('title')
    @parent
    HOME
@endsection

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
    <h1>SETE DA SORTE</h1>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-sm-12">
                {{--<div class="alert alert-info alert-dismissable ">
                    <i class="ti ti-info-alt"></i> Resize the browser window to see the responive tables in action!
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>--}}

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Partidas do sete da sorte</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>'betting.report.pdfVendas', 'method' => "POST",  'id' => 'formReportVendas']) !!}
                         @include('tamplatesForms.tamplateFormReportSeteSorte')
                        {!! Form::close() !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive no-padding">
                                    <table id="dashboard-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Tabela</th>
                                            <th>Hora</th>
                                            <th>Partida</th>
                                            <th>Processada</th>
                                            <th>Apostas</th>
                                            <th>Casa</th>
                                            <th>Fora</th>
                                            <th>Empate</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Tabela</th>
                                            <th>Hora</th>
                                            <th>Partida</th>
                                            <th>Processada</th>
                                            <th>Apostas</th>
                                            <th>Casa</th>
                                            <th>Fora</th>
                                            <th>Empate</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-tile info-tile-alt tile-success">
                                                <div class="tile-icon"><i class="ti ti-check-box"></i></div>
                                                <div class="tile-heading"><span>Vendas realizadas</span></div>
                                                <div class="tile-body"><span id="vendas-r">0</span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-tile info-tile-alt tile-danger">
                                                <div class="tile-icon"><i class="ti  ti-close"></i></div>
                                                <div class="tile-heading"><span>Vendas canceladas</span></div>
                                                <div class="tile-body"><span id="vendas-c">0</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript">

        var table = $('#dashboard-grid').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            bLengthChange: false,
            bFilter: false,
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if ( aData['status_id'] == "1" )
                {
                    $('td', nRow).css('background-color', 'Orange');
                }
            },
            ajax: {
                url: "{!! route('betting.seteGrid') !!}",
                method: 'POST',
                data: function (d) {
                    d.dataInicio = $('input[name=data_inicio]').val();
                    d.dataFim = $('input[name=data_fim]').val();
                }
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
                {data: 'campeonato', name: 'campeonatos.nome'},
                {data: 'hora', name: 'partidas.hora'},
                {data: 'partida', name: 'partida'},
                {data: 'status', name: 'status.nome'},
                {data: 'qtd_apostas', name: 'qtd_apostas'},
                {data: 'casa', name: 'casa', orderable: false, searchable: false},
                {data: 'fora', name: 'fora', orderable: false, searchable: false},
                {data: 'empate', name: 'empate', orderable: false, searchable: false}
            ]
        });

        //Pega o resultado das vendas
       // resultadoVendas();

        // Função do submit do search da grid principal
        $('#search').click(function(e) {
            table.draw();

            //Pega o resultado das vendas
             resultadoVendas();

            e.preventDefault();
        });

        //Função para trazer o resultado das vendas
        function resultadoVendas()
        {
            var searchData = {
                'dataInicio' : $('input[name=data_inicio]').val(),
                'dataFim' : $('input[name=data_fim]').val()
            };

            // Requisição ajax
            jQuery.ajax({
                type: 'POST',
                url: "{!! route('betting.resultVendasST') !!}",
                data: searchData,
                datatype: 'json'
            }).done(function (jsonResponse) {

                console.log(jsonResponse['vendas_r'][0]['vendas_r']);

                    $('#vendas-r').text(jsonResponse['vendas_r'][0]['vendas_r']);
                    $('#vendas-c').text(jsonResponse['vendas_c'][0]['vendas_c']);

            });
        }

        $('.dataTables_filter input').attr('placeholder', 'Pesquisar...');

    </script>
@endsection