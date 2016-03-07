@extends('menu')


@section('css')
    <link href="{{ asset('/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('content')

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="col-md-10">
                <h4>
                    <i class="fa fa-users"></i>
                    Listar Alunos
                </h4>
            </div>
            <div class="col-md-2">
                <a href="{{ route('seracademico.alunos.save')}}" class="btn-sm btn-primary">Novo Aluno</a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive no-padding">
                        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Acão</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th style="width: 10%;">Acão</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('/js/shCore.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var dt = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "bFilter": true, //Ativa o Search global
                "ajax": {
                    "url": "{{ Session::get('url_global') }}/grid",
                    "type": "POST",
                    "headers": {
                        'Authorization': 'Bearer {{ Session::get("access_token") }}',
                    }
                },
                "columns": [
                    {"data": "nomeAlunos"},
                    {"data": "cpfAlunos"},
                    {
                        "orderable": false,
                        "data": null,
                        "render": function (data, type, row, full, meta) {
                            return '<div class="btn-group pull-left">' +
                                    '<button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Selecione <span class="caret"></span></button>' +
                                    '<ul class="dropdown-menu pull-right">' +
                                    '<li><a href="#"><i class="fa fa-search"></i> Visualizar</a></li>' +
                                    '<li><a href="edit/' + data.id + '"><i class="fa fa-edit"></i> Editar</a></li>' +
                                    '</ul>' +
                                    '</div>'

                        }
                    },
                ],
                "order": [[0, 'asc']],
                language: {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ Resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });

        });
    </script>
@stop
