@extends('menu')

@section('page-heading')
    <h1>Relatórios</h1>
@endsection

@section('css')
    @parent
    <style>
        .table-responsive {
            min-height: 0.01%;
            overflow-x: initial;
        }
    </style>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Lista de Resultados</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form id="search-form" class="form-inline" role="form" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('data_inicio', 'Início') !!}
                                        {!! Form::text('data_inicio', null, array('class' => 'form-control date datepicker')) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('data_fim', 'Fim') !!}
                                        {!! Form::text('data_fim', null, array('class' => 'form-control date datepicker')) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('campeonato_id', 'Campeonatos') !!}
                                        {!! Form::select('campeonato_id', (['' => 'Selecione um campeonato'] + $loadFields['campeonatos']->toArray()), null, array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="form-group">
                                        <button class="btn-sm btn-primary" type="submit">Pesquisar</button>
                                    </div>
                                </div>
                            </div>
                        </form> <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive no-padding">
                                    <table id="report-partidas-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Campeonato</th>
                                            <th>Data</th>
                                            <th>Resultado</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Campeonato</th>
                                            <th>Data</th>
                                            <th>Resultado</th>
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
        // Criando a grid DataTables
        var table = $('#report-partidas-grid').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            bLengthChange: false,
            bFilter: false,
            bPaginate: false,
            ajax: {
                url: "{!! route('betting.report.gridReportPartidas') !!}",
                method: 'POST',
                data: function (d) {
                    d.dataInicio    = $('input[name=data_inicio]').val();
                    d.dataFim       = $('input[name=data_fim]').val();
                    d.campeonato    = $('select[name=campeonato_id] option:selected').val();
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
                {data: 'data', name: 'partidas.data'},
                {data: 'resultado', name: 'resultado', orderable: false, searchable: false}
            ]
        });

        // Função do submit do search da grid principal
        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

        $('.dataTables_filter input').attr('placeholder','Pesquisar...');

        //DOM Manipulation to move datatable elements integrate to panel
        $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
        $('.panel-ctrls').append("<i class='separator'></i>");
        $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

        $('.panel-footer').append($(".dataTable+.row"));
        $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
    </script>
@endsection