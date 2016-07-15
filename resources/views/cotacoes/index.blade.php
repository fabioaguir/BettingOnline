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
    <h1>Cotações</h1>
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
                        <h2>Lista de partidas</h2><br />
                        <a href="{{ route('betting.cotacoes.create')}}" class="btn btn-primary">Nova Cotação</a>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive no-padding">
                            <table id="cotacoes-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Modalidade</th>
                                    <th>Cotação</th>
                                    <th>Situação</th>
                                    <th>Acão</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Modalidade</th>
                                    <th>Cotação</th>
                                    <th>Situação</th>
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

@endsection

@section('js')
    @parent
    <script type="text/javascript">
        // Criando a grid DataTables
        var table = $('#cotacoes-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('betting.cotacoes.grid') !!}",
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
                {data: 'nome', name: 'modalidades.nome'},
                {data: 'valor', name: 'cotacoes.valor'},
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