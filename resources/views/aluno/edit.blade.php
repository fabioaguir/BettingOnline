@extends('menu')


@section('content')

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h4>
                <i class="fa fa-user"></i>
                Editar Aluno
            </h4>
        </div>
        <div class="ibox-content">


            @if(Session::has('message'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <em> {!! session('message') !!}</em>
                </div>
            @endif

            @if (isset($return) && $return !=  null)
                @if($return['success'] == false && isset($return[0]['fields']) &&  $return[0]['fields'] != null)
                    <div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @foreach ($return[0]['fields'] as $nome => $erro)
                            {{ $erro }}<br>
                        @endforeach
                    </div>
                @elseif($return['success'] == false)
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $return['message'] }}<br>
                    </div>
                @elseif($return['success'] == true)
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $return['message'] }}<br>
                    </div>
                @endif
            @endif

            {!! Form::model($aluno, ['route'=> ['seracademico.aluno.update', $aluno->id], 'id' => 'formAluno', 'enctype' => 'multipart/form-data']) !!}
                @include('tamplatesForms.tamplateFormAluno')
                {{--<a href="{{ route('seracademico.report.contratoAluno', ['id' => $aluno->id]) }}" target="_blank" class="btn btn-info">Contrato</a>--}}
            {!! Form::close() !!}
        </div>
    </div>
<?php //echo $cliente['enderecosEnderecos']['bairrosBairros']['cidadesCidades']['estadosEstados']['id']; ?>
    @section('javascript')
        <script src="{{ asset('/js/validacoes/validation_form_aluno.js')}}"></script>

        <script type="text/javascript">
            //Carregando as cidades
            $(document).on('change', "#estado", function () {
                //Removendo as cidades
                $('#cidade option').remove();

                //Removendo as Bairros
                $('#bairro option').remove();

                //Recuperando o estado
                var estado = $(this).val();

                if (estado !== "") {
                    var dados = {
                        'table' : 'cidades',
                        'field_search' : 'estados_id',
                        'value_search': estado,
                    }

                    jQuery.ajax({
                        type: 'POST',
                        url: '{{ route('seracademico.util.search')  }}',
                        data: dados,
                        datatype: 'json',
                        headers: {
                            'X-CSRF-TOKEN' : '{{  csrf_token() }}'
                        },
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
                //Removendo as Bairros
                $('#bairro option').remove();

                //Recuperando a cidade
                var cidade = $(this).val();

                if (cidade !== "") {
                    var dados = {
                        'table' : 'bairros',
                        'field_search' : 'cidades_id',
                        'value_search': cidade,
                    }

                    jQuery.ajax({
                        type: 'POST',
                        url: '{{ route('seracademico.util.search')  }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{  csrf_token() }}'
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
        </script>
    @stop
@stop
