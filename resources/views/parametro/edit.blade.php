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
    <h1>Parâmetros</h1>
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

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Cadastrar Parâmetros</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>

                    {!! Form::model($model, ['route'=> ['betting.parametro.update', $model->id], 'id' => 'formParametro', 'class' => 'form-horizontal row-border','enctype' => 'multipart/form-data']) !!}
                    <div class="panel-body">
                        @include('tamplatesForms.tamplateFormParametro')
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn" style="margin-left: -11px">Salvar</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);
    </script>
@endsection