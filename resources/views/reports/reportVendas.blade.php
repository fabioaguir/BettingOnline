@extends('menu')

@section('css')
    @parent
    <style>
        .form-group {
            margin-top: -10px;;
        }
    </style>
@endsection

@section('page-heading')
    <h1>Relatórios</h1>
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
                        <h2>Vendas</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>'betting.report.reportVendasSearch', 'method' => "POST", 'id' => 'formReportVendas','enctype' => 'multipart/form-data']) !!}
                        @include('tamplatesForms.tamplateFormReportVandas')
                        {!! Form::close() !!}
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_reportVendas.js')}}"></script>
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);

        //Carregando os bairros
        $(document).on('change', "#area", function () {
            //Removendo as Bairros
            $('#vendedor option').remove();

            //Recuperando a cidade
            var area = $(this).val();

            if (area !== "") {
                var dados = {
                    'table' : 'vendedor',
                    'field_search' : 'area_id',
                    'value_search': area,
                };

                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('betting.util.search')  }}',
                    data: dados,
                    datatype: 'json'
                }).done(function (json) {
                    var option = "";

                    option += '<option value="0">Todos</option>';
                    for (var i = 0; i < json.length; i++) {
                        option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                    }

                    $('#vendedor option').remove();
                    $('#vendedor').append(option);
                });
            }
        });
    </script>
@endsection