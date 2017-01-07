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
    <h1>Dashboard</h1>
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
                        <h2>Dashboard</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="input-group" style="margin-top: 80px">
                                                <input style="margin-left: 8px" placeholder="Data" class="form-control mask datepicker" data-inputmask="'alias': 'date'" type="text"
                                                       id="searchDate" name="searchDate">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-info" id="btnSearch" type="button">Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-tile info-tile-alt tile-success">
                                                <div class="tile-icon"><i class="ti ti-check-box"></i></div>
                                                <div class="tile-heading"><span>Vendas realizadas</span></div>
                                                <div class="tile-body"><span id="vendas-r"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-tile info-tile-alt tile-danger">
                                                <div class="tile-icon"><i class="ti  ti-close"></i></div>
                                                <div class="tile-heading"><span>Vendas canceladas</span></div>
                                                <div class="tile-body"><span id="vendas-c"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                                            <th style="width: 25%">Tabela</th>
                                            <th style="width: 7%">Hora</th>
                                            <th>Partida</th>
                                            <th style="width: 10%">Processada</th>
                                            <th style="width: 8%">Apostas</th>
                                            <th style="width: 6%">Casa</th>
                                            <th style="width: 6%">Fora</th>
                                            <th style="width: 7%">Empate</th>
                                        </tr>
                                        </tfoot>
                                    </table>
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
                url: "{!! route('betting.dashboard') !!}",
                method: 'POST',
                data: function (d) {
                    d.searchDate = $('input[name=searchDate]').val();
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
                {data: 'status', name: 'processadas.nome'},
                {data: 'qtdApostas', name: 'qtdApostas', orderable: false, searchable: false},
                {data: 'casa', name: 'casa', orderable: false, searchable: false},
                {data: 'fora', name: 'fora', orderable: false, searchable: false},
                {data: 'empate', name: 'empate', orderable: false, searchable: false}
            ]
        });

        //Pega o resultado das vendas
        resultadoVendas();

        // Função do submit do search da grid principal
        $('#btnSearch').click(function(e) {
            table.draw();

            //Pega o resultado das vendas
            resultadoVendas();

            e.preventDefault();
        });

        //Função para trazer o resultado das vendas
        function resultadoVendas()
        {
            var searchData = {
                'searchDate' : $('input[name=searchDate]').val()
            };

            // Requisição ajax
            jQuery.ajax({
                type: 'POST',
                url: "{!! route('betting.resultVendas') !!}",
                data: searchData,
                datatype: 'json'
            }).done(function (jsonResponse) {

                    $('#vendas-r').text(jsonResponse['vendas_r'][0]['vendas_r']);
                    $('#vendas-c').text(jsonResponse['vendas_c'][0]['vendas_c']);

            });
        }

        $('.dataTables_filter input').attr('placeholder', 'Pesquisar...');

    </script>
@endsection