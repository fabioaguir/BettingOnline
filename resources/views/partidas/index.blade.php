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
    <h1>Partidas</h1>
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
                        <h2>Lista de partidas</h2><br />
                        <a href="{{ route('betting.partidas.create')}}" class="btn btn-primary">Novo Partida</a>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive no-padding">
                            <table id="partidas-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Tima Casa</th>
                                    <th>Tima Fora</th>
                                    <th>Campeonato</th>
                                    <th>Situação</th>
                                    <th>Acão</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Tima Casa</th>
                                    <th>Tima Fora</th>
                                    <th>Campeonato</th>
                                    <th>Situação</th>
                                    <th>Acão</th>
                                </tr>
                                </tfoot>
                            </table>
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
        var table = $('#partidas-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('betting.partidas.grid') !!}",
            language: {
                "lengthMenu": "_MENU_"
            },
            columns: [
                {data: 'data', name: 'partidas.data'},
                {data: 'hora', name: 'partidas.hora'},
                {data: 'timeCasa', name: 'time_casa.nome'},
                {data: 'timeFora', name: 'time_fora.nome'},
                {data: 'campeonato', name: 'campeonatos.nome'},
                {data: 'status', name: 'status.nome'},
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


        /*//Seleciona uma linha
         $('#crud-grid tbody').on( 'click', 'tr', function () {
         if ( $(this).hasClass('selected') ) {
         $(this).removeClass('selected');
         }
         else {
         table.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         }
         } );

         //Retonra o id do registro
         $('#crud-grid tbody').on( 'click', 'tr', function () {

         var rows = table.row( this ).data()

         console.log( rows.id );
         } );*/

    </script>
@endsection