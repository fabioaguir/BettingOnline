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
    <h1>Perfil</h1>
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
                        <h2>Cadastrar perfil</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    {!! Form::open(['route'=>'betting.role.store', 'method' => "POST", 'class' => 'form-horizontal row-border' ,'enctype' => 'multipart/form-data' ]) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li role="presentation" class="active">
                                        <a href="#role" aria-controls="role" role="tab" data-toggle="tab">Dados Gerais</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="role">
                                        <br/><br/>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                                                    <div class="col-sm-8">
                                                        {!! Form::text('name', Session::getOldInput('name')  , array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('description', 'Descrição', array('class' => 'col-sm-2 control-label')) !!}
                                                    <div class="col-sm-8">
                                                        {!! Form::text('description', Session::getOldInput('description')  , array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-1">
                                <button class="btn-primary btn" style="margin-left: 22px">Salvar</button>
                                <a class="btn-default btn" href="{{ route('betting.role.index')}}">Voltar</a>
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
        $(document).ready(function () {
            $("#tree-permission").tree();
        });
    </script>
@endsection