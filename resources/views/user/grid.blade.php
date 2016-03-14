@extends('menu')

@section('css')
    <link href="{{ asset('/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <style type="text/css" class="init">
        td.details-control {
            background: url({{ asset("/imagens/icone-produto-plus.png") }}) no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url({{asset("/imagens/icone-produto-minus.png")}}) no-repeat center center;
        }

        a.editar {
            background: url({{asset("/imagens/icone-editar.png")}}) no-repeat 0 0;
            width: 22px;
        }

        a.visualizar {
            background: url({{asset("/imagens/impressao.png")}}) no-repeat 0 0;
            width: 23px;
        }

        a.excluir {
            background: url({{asset("/imagens/icone-excluir.png")}}) no-repeat 0 0;
            width: 21px;
        }

        td.bt {
            padding: 10px 0;
            width: 126px;
        }
        td.bt a {
            float: left;
            height: 22px;
            margin: 0 10px;
        }
        .highlight {
            background-color: #FE8E8E;
        }
        .table-responsive {
            min-height: 0.01%;
            overflow-x: initial;
        }
    </style>
@stop

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Lista usuário</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('seracademico.user.save')}}" class="btn btn-primary btn-pressure btn-sm btn-sensitive">Novo Usuário</a><br /><br />
                    <div class="table-responsive no-padding">
                        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Acão</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Acão</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox-footer">
            <span class="pull-right">
                The righ side of the footer
            </span>
            This is simple footer example
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/js/shCore.js')}}"></script>
    <script type="text/javascript">
        function format(d) {
            return  "";
        }

        $(document).ready(function ()
        {
            var dt = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "bFilter": true, //Ativa o Search global
                "ajax": {
                    "url": "{{ Session::get('url_global') }}/users/grid",
                    "type": "POST",
                    "headers": {
                        'Authorization': 'Bearer {{ Session::get("access_token") }}',
                    }
                },
                "columns": [
                    {"data": "username"},
                    {"data": "email"},
                    {
                        "class": "bt",
                        "orderable": false,
                        "data": null,
                        "render": function (data, type, row, full, meta) {
                            return '<a href="edit/'+data.id+'" class="editar" title="Editar">'
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
                    "sLengthMenu": "_MENU_ resultados por página",
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

            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#example tbody').on('click', 'tr td:first-child', function () {
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                var idx = $.inArray(tr.attr('id'), detailRows);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                }

                else {
                    tr.addClass('details');
                    row.child(format(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            // On each draw, loop over the `detailRows` array and show any child rows
            dt.on('draw', function () {
                $.each(detailRows, function (i, id) {
                    $('#' + id + ' td:first-child').trigger('click');
                });
            });

            // Apply the search -- EUUUUUUUUUUUUUUUUUUUUUUUUU
            dt.columns().eq(0).each(function (colIdx) {
                $('input', dt.column(colIdx).footer()).on('keyup change', function () {
                    dt
                            .column(colIdx)
                            .search(this.value)
                            .draw();
                });
            });

        });
    </script>
@stop