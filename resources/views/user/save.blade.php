@extends('menu')

@section('css')
@stop

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Save usuário</h5>

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
            {!! Form::open(['route'=>'seracademico.user.store', 'method' => "POST", 'id' => 'formAluno', 'enctype' => 'multipart/form-data' ]) !!}
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
                                    {!! Form::label('username', 'Login') !!}
                                    {!! Form::text('user[username]', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('user[email]', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('senha', 'Senha') !!}
                                    {!! Form::text('user[password]', '', array('class' => 'form-control')) !!}
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
                                    {!! Form::label('ativo', 'Ativo') !!}
                                    {!! Form::checkbox('user[isActive]', 1, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="permission">
                            <br/>

                            <div id="treeCheckbox">
                                <ul>
                                    @foreach ($dados['projetos'] as $projeto)
                                        <li>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> {{ $projeto['nome'] }}
                                                </label>
                                            </div>
                                            <ul>
                                                @foreach($projeto['aplicacoes'] as $aplicacao)
                                                    <li>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"> {{ $aplicacao['nome'] }}
                                                            </label>
                                                        </div>
                                                        <ul>
                                                            @foreach ($aplicacao['permissoes'] as $permissao)
                                                                <li>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="permissao[]"
                                                                                   value="{{ "ROLE_" . $projeto['nome'] . "_" . $aplicacao['nome'] . "_" . $permissao['nome'] }}"> {{ $permissao['nome'] }}
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="perfil">
                            <br/>

                            <div id="treeCheckboxPerfil">
                                <ul>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> TODOS
                                            </label>
                                        </div>
                                        <ul>
                                            @foreach($dados['perfis'] as $perfil)
                                                <li>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="perfil[]"
                                                                   value="{{ $perfil['id'] }}"> {{ $perfil['nome'] }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
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
            $("#treeCheckbox, #treeCheckboxPerfil").tree();

            $('#user a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
@stop