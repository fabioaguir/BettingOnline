@extends('menu')


@section('content')

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h4>
                <i class="fa fa-user"></i>
                Cadastrar Aluno
            </h4>
        </div>

        <ul class="language_bar_chooser">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                        {{{ $properties['native'] }}}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="ibox-content">

            @if(Session::has('message'))
                <div class="alert alert-success"><em> {!! session('message') !!}</em></div>
            @endif

            @if(Session::has('errors'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {!! Form::open(['route'=>'seracademico.aluno.store', 'method' => "POST", 'id' => 'formAluno', 'enctype' => 'multipart/form-data']) !!}
                @include('tamplatesForms.tamplateFormAluno')
            {!! Form::close() !!}
        </div>
    </div>

    @section('javascript')

   {{-- <script type="text/javascript">
        $(document).ready(function () {
            //Carregando os estados
            jQuery.ajax({
                type: 'GET',
                url: '{{ Session::get('url_global') }}/estados/all',
                headers: {
                    //"Access-Control-Allow-Origin" : "http://ser.academicoc",
                    'Authorization': 'Bearer {{ Session::get("access_token") }}',
                    --}}{{--'X-CSRF-TOKEN' : '{{  csrf_token() }}'--}}{{--
                },
                datatype: 'json'
            }).done(function (json) {
                var option = "";

                option += '<option value="">Selecione um estado</option>';
                for (var i = 0; i < json.length; i++) {
                    option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                }

                $('#estado option').remove();
                $('#estado').append(option);
            });


            //Carregando as cidades
            $(document).on('change', "#estado", function () {
                var estado = $(this).val();

                if (estado !== "") {
                    var dados = {
                        estado: estado
                    }

                    jQuery.ajax({
                        type: 'POST',
                        url: '{{ Session::get('url_global') }}/cidades/byestado',
                        headers: {
                            'Authorization': 'Bearer {{ Session::get("access_token") }}',
                            --}}{{--'X-CSRF-TOKEN': '{{  csrf_token() }}'--}}{{--
                        },
                        data: dados,
                        datatype: 'json'
                    }).done(function (json) {
                        var option = "";

                        option += '<option value="">Selecione uma cidade</option>';
                        for (var i = 0; i < json.length; i++) {
                            option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                        }

                        $('#cidade option').remove();
                        $('#cidade').append(option);
                    });
                }
            });

            //Carregando os bairros
            $(document).on('change', "#cidade", function () {
                var cidade = $(this).val();

                if (cidade !== "") {
                    var dados = {
                        cidade: cidade
                    }

                    jQuery.ajax({
                        type: 'POST',
                        url: '{{ Session::get('url_global') }}/bairros/bycidade',
                        headers: {
                            'Authorization': 'Bearer {{ Session::get("access_token") }}',
                            --}}{{--'X-CSRF-TOKEN': '{{  csrf_token() }}'--}}{{--
                        },
                        data: dados,
                        datatype: 'json'
                    }).done(function (json) {
                        var option = "";

                        option += '<option value="">Selecione um bairro</option>';
                        for (var i = 0; i < json.length; i++) {
                            option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                        }

                        $('#bairro option').remove();
                        $('#bairro').append(option);
                    });
                }
            });

            //verificando o cpf do aluno
            $(document).on("focusout", "#cpfAlunos", function () {
                //Recuperando o valor do campo
                var valueName  = $(this).val();

                //Preparando os parâmetros
                var parameters = {
                    'valueName': valueName,
                    'tableName': 'SerAcademicoBundle:Alunos',
                    'fieldName': 'cpf'
                }

                //Executando a consulta
                validateUniqueField(parameters, "#cpfAlunos");
            });

            //verificando o email do aluno
            $(document).on("focusout", "#emailAlunos", function () {
                //Recuperando o valor do campo
                var valueName  = $(this).val();

                //Preparando os parâmetros
                var parameters = {
                    'valueName': valueName,
                    'tableName': 'SerAcademicoBundle:Alunos',
                    'fieldName': 'email'
                }

                //Executando a consulta
                validateUniqueField(parameters, "#emailAlunos");
            });

            $("#instituicao").select2({
                placeholder: 'Selecione uma instituição',
                width: 850,
                ajax: {
                    type: 'POST',
                    url: "{{ Session::get('url_global') }}/util/search",
                    dataType: 'json',
                    delay: 250,
                    crossDomain: true,
                    data: function (params) {
                        return {
                            search:     params.term, // search term
                            tableName:  'SerAcademicoBundle:Instituicao',
                            fieldName:  'nome',
                            page:       params.page
                        };
                    },
                    headers: {
                        //"Access-Control-Allow-Origin" : "http://ser.academicoc",
                        'Authorization': 'Bearer {{ Session::get("access_token") }}',
                        --}}{{--'X-CSRF-TOKEN' : '{{  csrf_token() }}'--}}{{--
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
            });

        });

        //envio da requisição para o servidor
        function validateUniqueField(parameters, idTag) {
            //Carregando os estados
            jQuery.ajax({
                type: 'POST',
                data: parameters,
                url: '{{ Session::get('url_global') }}/util/queryByField',
                headers: {
                    //"Access-Control-Allow-Origin" : "http://ser.academicoc",
                    'Authorization': 'Bearer {{ Session::get("access_token") }}',
                    --}}{{--'X-CSRF-TOKEN' : '{{  csrf_token() }}'--}}{{--
                },
                datatype: 'json'
            }).done(function (retorno) {
                var msg = "";

                if(retorno) {
                    $(idTag).parent().addClass("has-error");
                    msg += "<span id='helpBlock2' style='font-size: 11px;' class='help-block'>O valor informado já existe</span>";
                    $("#helpBlock2").remove();
                    $(idTag).parent().append(msg);
                    $(idTag).focus();
                } else {
                    $("#helpBlock2").remove();
                    $(this).parent().parent().removeClass("has-error");
                }

            });
        }
    </script>--}}
    @stop
@stop
