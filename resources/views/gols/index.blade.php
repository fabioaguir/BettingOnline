@extends('menu')

@section('css')
    @parent
<style>
    .table-responsive {
        min-height: 0.01%;
        overflow-x: initial;
    }
</style>
@endsection

@section('page-heading')
    <h1>Gols</h1>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-md-12">
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
                        <h2>Cadastrar Gol</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['route'=>'betting.gols.store', 'method' => "POST", 'id' => 'formGol', 'class' => 'form-horizontal row-border','enctype' => 'multipart/form-data']) !!}
                                    @include('tamplatesForms.tamplateFormGols')
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-8">
                                <div class="table-responsive no-padding">
                                    <table id="resultado-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center; font-size: 16px; background-color: #C0C0C0">RESULTADO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" style="text-align: center; font-size: 16px; font-weight: bold; background-color: #DCDCDC">Sport 10 x 0 Santa Cruz</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive no-padding">
                                    <table id="gols-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Tempo</th>
                                            <th>Minuto</th>
                                            <th>Data</th>
                                            <th>Partida</th>
                                            <th>Time</th>
                                            <th>Acão</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Tempo</th>
                                            <th>Minuto</th>
                                            <th>Data</th>
                                            <th>Partida</th>
                                            <th>Time</th>
                                            <th style="width: 15%;">Acão</th>
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
    <script type="text/javascript" src="{{ asset('js/gols/gols.js')  }}"></script>
    <script type="text/javascript">
        // Criando a grid DataTables
        var table = $('#gols-grid').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            bLengthChange: false,
            bFilter: false,
            bPaginate: false,
            ajax: {
                url: "{!! route('betting.gols.grid') !!}",
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
                {data: 'nomeTempo', name: "tempos.nome", orderable: false},
                {data: 'minutos', name: 'gols.minutos'},
                {data: 'data', name: "to_char(partidas.data, 'DD/MM/YYYY')"},
                {data: 'partida', name: "concat(time_casa.nome,' x ',time_fora.nome)", orderable: false},
                {data: 'time', name: 'times.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $('.dataTables_filter input').attr('placeholder','Pesquisar...');

        //DOM Manipulation to move datatable elements integrate to panel
        $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
        $('.panel-ctrls').append("<i class='separator'></i>");
        $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

        $('.panel-footer').append($(".dataTable+.row"));
        $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");


        $(document).on('click', 'a.delete', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            bootbox.confirm("Tem certeza da exclusão do item?", function (result) {
                if (result) {
                    location.href = url
                } else {
                    false;
                }
            });
        });

    </script>
@endsection