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
    <h1>Usuário</h1>
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
                        <h2>Editar usuário</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    {!! Form::model($user, ['route'=> ['softage.user.update', $user->id], 'method' => "POST", 'class' => 'form-horizontal row-border','enctype' => 'multipart/form-data' ]) !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li role="presentation" class="active">
                                        <a href="#user" aria-controls="user" role="tab" data-toggle="tab">Dados
                                            Gerais</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#permission" aria-controls="permission" role="tab" data-toggle="tab">Permissões</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#perfil" aria-controls="perfil" role="tab" data-toggle="tab">Perfís</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="user">
                                        <br/><br />
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                                                    <div class="col-sm-8">
                                                        {!! Form::text('name', null  , array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('email', 'E-mail', array('class' => 'col-sm-2 control-label')) !!}
                                                    <div class="col-sm-8">
                                                        {!! Form::text('email', null , array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('password', 'Senha', array('class' => 'col-sm-2 control-label')) !!}
                                                    <div class="col-sm-4">
                                                        {!! Form::text('password', ''  , array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label label-input-xs">Ativar/Desativar</label>
                                                    <div class="col-sm-8">
                                                        <ul class="demo-btns mb-n xs">
                                                            <li>
                                                                {!! Form::hidden('active', 0) !!}
                                                                {!! Form::checkbox('active', 1, null, ['class' => 'js-switch-info switchery-xs']) !!}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="margin-top: -9px">
                                                <div class="col-md-4">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 135px; height: 115px;">
                                                            @if ($user->path_image != null)
                                                                <div id="midias">
                                                                    <img id="logo" src="/seracademico-laravel/public/images/{{$user->path_image}}"  alt="Foto" height="120" width="100"/><br/>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                    <span class="btn btn-primary btn-xs btn-block btn-file">
                                                        <span class="fileinput-new">Selecionar</span>
                                                        <span class="fileinput-exists">Mudar</span>
                                                        <input type="file" name="img">
                                                    </span>
                                                            {{--<a href="#" class="btn btn-warning btn-xs fileinput-exists col-md-6" data-dismiss="fileinput">Remover</a>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="permission">
                                        <br/>

                                        <div id="tree-role">
                                            <ul>
                                                <li>
                                                    @if(count($user->permissions->lists('name')->all()) > 0)
                                                        <input type="checkbox" checked> Todos
                                                    @else
                                                        <input type="checkbox"> Todos
                                                    @endif
                                                    <ul>
                                                        @if(isset($loadFields['permission']))
                                                            @foreach($loadFields['permission'] as $id => $permission)
                                                                @if(\in_array($permission, $user->permissions->lists('name')->all()))
                                                                    <li><input type="checkbox" name="permission[]" checked value="{{ $id  }}"> {{ $permission }} </li>
                                                                @else
                                                                    <li><input type="checkbox" name="permission[]" value="{{ $id  }}"> {{ $permission }} </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="perfil">
                                        <br/>

                                        <div id="tree-permission">
                                            <ul>
                                                @if(isset($loadFields['role']))
                                                    @foreach($loadFields['role'] as $id => $role)
                                                        @if(\in_array($role, $user->roles->lists('name')->all()))
                                                            <li><input type="checkbox" name="role[]" checked value="{{ $id  }}"> {{ $role }} </li>
                                                        @else
                                                            <li><input type="checkbox" name="role[]" value="{{ $id  }}"> {{ $role }} </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
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
                                <a class="btn-default btn" href="{{ route('softage.user.index')}}">Voltar</a>
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

        $(document).ready(function () {
            $("#tree-role, #tree-permission").tree();

            $('#user a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
@endsection