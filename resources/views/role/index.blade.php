@extends('menu')

@section('title')
    @parent
    Perfil
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

@section('page-heading')
    <h1>Perfis</h1>
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
                        <h2>Lista de perfis</h2> <br />
                        <a href="{{ route('betting.role.create')}}" class="btn btn-primary">Novo Perfil</a>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive no-padding">
                            <table id="role-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th >Acão</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th style="width: 10%;">Acão</th>
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
        var table = $('#role-grid').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "lengthMenu": "_MENU_"
            },
            ajax: "{!! route('betting.role.grid') !!}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
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

    </script>
@endsection