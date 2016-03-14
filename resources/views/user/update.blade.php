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

            {!! Form::open(['route'=>'seracademico.user.update', 'method' => "POST", 'id' => 'formAluno', 'enctype' => 'multipart/form-data' ]) !!}
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
                            <br>
                            <input type="hidden" name="idUser" value="{{ $cliente['id'] }}">
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('username', 'Login') !!}
                                    {!! Form::text('user[username]', isset($cliente['username']) ? $cliente['username'] : "", array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('user[email]', isset($cliente['email']) ? $cliente['email'] : "", array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('senha', 'Senha') !!}
                                    {!! Form::text('user[password]', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 135px; height: 115px;">
                                        @if (isset($cliente['img']) && $cliente['img'] != null)
                                            <div id="midias" >
                                                <img id="logo"  src="{{asset('/uploads/fotos/'.$cliente['img'])}}" class="img-responsive" alt="Foto"  height="300" width="150"/><br />
                                                {{--<button type="button" class="btn btn-danger removerFoto">Remover Foto</button>--}}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="btn btn-primary btn-xs btn-block btn-file">
                                            <span class="fileinput-new">Selecionar</span>
                                            <span class="fileinput-exists">Mudar</span>
                                            <input type="file" name="img">
                                            <input type="hidden" name="imgAtual" value="{{isset($cliente['img']) ? $cliente['img'] : ""}}">
                                        </span>
                                        {{--<a href="#" class="btn btn-warning btn-xs fileinput-exists col-md-6" data-dismiss="fileinput">Remover</a>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('ativo', 'Ativo') !!}
                                    {!! Form::checkbox('user[isActive]', 1, $cliente['is_active'], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="permission">
                            <br>
                            <div id="treeCheckbox">
                                <ul>
                                    @foreach ($dados['projetos'] as $projeto)
                                        <li>
                                            <input type="checkbox">  {{ $projeto['nome'] }}
                                            <ul>
                                                @foreach($projeto['aplicacoes'] as $aplicacao)
                                                    <li>
                                                        <input type="checkbox">  {{ $aplicacao['nome'] }}
                                                        <ul>
                                                            @foreach ($aplicacao['permissoes'] as $permissao)
                                                                <?php $role =  "ROLE_" . $projeto['nome'] . "_" . $aplicacao['nome'] . "_" . $permissao['nome'];  ?>
                                                                <li>
                                                                    @if(in_array($role,$rolesDoUser))
                                                                        <input type="checkbox" name="permissao[]" checked value="{{ "ROLE_" . $projeto['nome'] . "_" . $aplicacao['nome'] . "_" . $permissao['nome'] }}"> {{ $permissao['nome'] }}
                                                                    @else
                                                                        <input type="checkbox" name="permissao[]" checked value="{{ "ROLE_" . $projeto['nome'] . "_" . $aplicacao['nome'] . "_" . $permissao['nome'] }}"> {{ $permissao['nome'] }}
                                                                    @endif
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
                            <br>
                            <div id="treeCheckboxPerfil">
                                <ul>
                                    <li>
                                        <input type="checkbox">  TODOS
                                        <ul>
                                            @foreach($dados['perfis'] as $perfil)
                                                <?php $perfilName = $perfil['nome']; ?>
                                                <li>
                                                    @if(in_array($perfilName, $perfisDoUser))
                                                        <input type="checkbox" name="perfil[]" checked value="{{ $perfil['id'] }}"> {{ $perfil['nome'] }}
                                                    @else
                                                        <input type="checkbox" name="perfil[]"  value="{{ $perfil['id'] }}"> {{ $perfil['nome'] }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Enviar', array('class' => 'btn btn-primary')) !!}
                </div>
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
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $(".select2").select2();
            $('#serbinario_securitybundle_user_actions_voltar').removeClass("btn-default");
            $('#serbinario_securitybundle_user_actions_voltar').addClass("btn-success");
            $("#treeCheckbox, #treeCheckboxPerfil").tree({});

            $('#user a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $("#serbinario_securitybundle_user_actions_voltar").click(function () {
                javascript:history.back();
            });

        });
    </script>
@stop