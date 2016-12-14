@extends('menu')

@section('css')
    @parent
    <style>
        .form-group {
            margin-top: -10px;;
        }

        ul.list-permission li {
            margin-bottom: 1%;;
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
                        <h2>Editar perfil</h2>
                        <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>

                    {!! Form::model($role, ['route'=> ['betting.role.update', $role->id], 'method' => "POST", 'class' => 'form-horizontal row-border','enctype' => 'multipart/form-data' ]) !!}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li role="presentation" class="active">
                                            <a href="#role" aria-controls="role" role="tab" data-toggle="tab">Dados Gerais</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#permission" aria-controls="permission" role="tab" data-toggle="tab">Permissões</a>
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
                                                            {!! Form::text('name', null  , array('class' => 'form-control')) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        {!! Form::label('description', 'Descrição', array('class' => 'col-sm-2 control-label')) !!}
                                                        <div class="col-sm-8">
                                                            {!! Form::text('description', null  , array('class' => 'form-control')) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Permissões-->
                                        <div role="tabpanel" class="tab-pane" id="permission">
                                            <div class="row" style="margin-left: 3%; margin-top: 3%">
                                                <div class="col-md-2">
                                                    <a id="markAll">Marcar Todos</a>
                                                </div>

                                                <div class="col-md-2">
                                                    <a id="unmarkAll">Desmarcar Todos</a>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-top: 2%;">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        @if(isset($loadFields['permission']))
                                                            @if(isset($loadFields['permission']) && count($loadFields['permission']) > 0)
                                                                <?php
                                                                    $permissions = $loadFields['permission'];
                                                                    $models = $loadFields['model'];
                                                                    $count = 0;
                                                                ?>

                                                                @foreach($models as $model)
                                                                    @if($count == 3)
                                                                        <div class="row">
                                                                    @endif

                                                                    <div class="col-md-3">
                                                                        <h5 style="font-weight: bold; margin-left: 16%;">{{ $model }}</h5>

                                                                        <ul class="list-permission" style="list-style: none;">
                                                                            @foreach($permissions as $permission)
                                                                                @if($model == $permission->model)
                                                                                    @if(\in_array($permission->slug, $role->permissions->lists('slug')->all()))
                                                                                        <li><input class="check-permission" type="checkbox" name="permission[]" checked value="{{ $permission->id }}"> {{ $permission->name }} </li>
                                                                                    @else
                                                                                        <li><input class="check-permission" type="checkbox" name="permission[]" value="{{ $permission->id }}"> {{ $permission->name }} </li>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>

                                                                    @if($count == 3)
                                                                        </div>
                                                                    @endif

                                                                    <?php
                                                                        if($count == 3) {
                                                                            $count = 0;
                                                                        } else {
                                                                            $count++;
                                                                        }
                                                                    ?>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim Permissões-->
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
        $(document).on('click', '#markAll', function () {
            $('.check-permission').each(function(){
                $(this).prop("checked", true);
            });
        });

        $(document).on('click', '#unmarkAll', function () {
            $('.check-permission').each(function() {
                $(this).prop("checked", false);
            });
        });
    </script>
@endsection