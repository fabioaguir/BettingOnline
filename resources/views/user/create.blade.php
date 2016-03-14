@extends('menu')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Novo Usuário</h5>

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

            @if(Session::has('message'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <em> {!! session('message') !!}</em>
                </div>
            @endif

            {!! Form::open(['route'=>'seracademico.user.store', 'method' => "POST", 'enctype' => 'multipart/form-data' ]) !!}
            <div class="row">
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a href="#user" aria-controls="user" role="tab" data-toggle="tab">Dados Gerais</a>
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
                            <br/>

                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('name', 'Nome') !!}
                                    {!! Form::text('name', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('email', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('password', 'Senha') !!}
                                    {!! Form::password('password', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 135px; height: 115px;">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::hidden('active', 0) !!}
                                    {!! Form::label('active', 'Ativo') !!}
                                    {!! Form::checkbox('active', 1, null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="permission">
                            <br/>

                            <div id="tree-role">
                                <ul>
                                    <li>
                                        <input type="checkbox"> Todos
                                        <ul>
                                            @if(isset($loadFields['permission']))
                                                @foreach($loadFields['permission'] as $id => $permission)
                                                    <li><input type="checkbox" name="permission[]" value="{{ $id  }}"> {{ $permission }} </li>
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
                                            <li><input type="checkbox" name="role[]" value="{{ $id  }}"> {{ $role }} </li>
                                         @endforeach
                                     @endif
                                 </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <di class="col-md-12">
                    {!! Form::submit('Enviar', array('class' => 'btn btn-primary')) !!}
                </di>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="ibox-footer">
            <span class="pull-right">
                footer a direita
            </span>
            footer esquerda
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" class="init">
        $(document).ready(function () {
            $("#tree-role, #tree-permission").tree();

            $('#user a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
@stop