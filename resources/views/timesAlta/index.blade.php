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
    <h1>Times em alta</h1>
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
                        <h2>Lista dos times em alta</h2><br />
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                {!! Form::select('time',(['' => 'Selecione um time'] + $loadFields['times']->toArray()), null, array('class' => 'form-control', 'id' => 'time')) !!}
                                                <div class="input-group-btn">
                                                    <button class="btn btn-info" id="inserir" type="button">Inserir na lista</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive no-padding">
                                    <table id="times-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Acão</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Time</th>
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
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">

        var table = $('#times-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{!! route('betting.timesAlta.grid') !!}",
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
                {data: 'nome', name: 'times.nome'},
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

        $(document).on('click', '#inserir', function (event) {
            event.preventDefault();

            var time = $('#time').val();

            if(time != "") {
                // Requisição ajax
                jQuery.ajax({
                    type: 'POST',
                    url: "{!! route('betting.timesAlta.store') !!}",
                    data: {'time_id' : time},
                    datatype: 'json'
                }).done(function (jsonResponse) {

                    if(jsonResponse['success'] == true) {
                        table.ajax.reload();
                    } else {
                        bootbox.alert(jsonResponse['msg']);
                    }

                });
            } else {
                bootbox.alert('Selecione um time');
            }

        });

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

        //consulta via select2 cgm
        /*$("#time").select2({
            placeholder: 'Selecione um time',
            minimumInputLength: 3,
            width: 200,
            ajax: {
                type: 'POST',
                url: "{{ route('betting.util.select2')  }}",
                dataType: 'json',
                delay: 250,
                crossDomain: true,
                data: function (params) {
                    return {
                        'search':     params.term, // search term
                        'tableName':  'times',
                        'fieldName':  'nome',
                        /!*'fieldWhere':  'nivel',
                         'valueWhere':  '3',*!/
                        'page':       params.page
                    };
                },
                processResults: function (data, params) {

                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                }
            }
        });*/


        $("#time").select2({
            placeholder: "Search for a movie",
            minimumInputLength: 3,
            width: '100%',
            ajax: {
                url: "{{ route('betting.util.select2')}}",
                dataType: 'json',
                quietMillis: 100,
                data: function (term, page) { // page is the one-based page number tracked by Select2
                    return {
                        'search': term, //search term
                        'tableName':  'times',
                        'fieldName':  'nome',
                        page_limit: 10, // page size
                        'page': page, // page number
                        apikey: "q7jnbsc56ysdyvvbeanghegk" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) {
                    var more = (page * 10) < data.total; // whether or not there are more results available

                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {results: data.movies, more: more};
                }
            },
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
        });
    </script>
@endsection