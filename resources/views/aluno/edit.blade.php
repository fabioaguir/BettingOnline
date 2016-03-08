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
                <div class="alert alert-danger">
                    {{ Session::get('message') }}<br>
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
    @stop
@stop
