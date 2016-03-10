<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="form-group col-md-8">
                {!! Form::label('nome', 'Nome *') !!}
                {!! Form::text('nome',  Session::getOldInput('nome') , array('class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('data_nasciemento', 'Nascimento ') !!}
                {!! Form::text('data_nasciemento', null, array('class' => 'form-control datepicker')) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('sexo', 'Sexo ') !!}
                {!! Form::select('sexos_id', $loadFields['sexo'], Session::getOldInput('sexos_id'), array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                {!! Form::label('curso', 'Curso') !!}
                {!! Form::select('curso',  array('1' => 'Curso'), array(),array('class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('turma', 'Turma ') !!}
                {!! Form::select('turma',  array('1' => 'Turma'), array(),array('class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('turno', 'Turno ') !!}
                {!! Form::select('turno', array(), Session::getOldInput('nome'),array('class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('currículo', 'Currículo') !!}
                {!! Form::select('currículo', array(), Session::getOldInput('nome'),array('class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('matricula', 'Matrícula ') !!}
                {!! Form::text('matricula', Session::getOldInput('nome') , array('class' => 'form-control')) !!}
                <input type="hidden" value="" id="idAluno" name="idAluno">
            </div>
            <div class="form-group col-md-1">
                {!! Form::label('ativar', 'Ativar') !!}
                <div class="checkbox checkbox-primary">
                    @if(!isset($cliente['id']))
                        <input type="checkbox" name="" checked id="status" value="">
                    @else
                        @if(isset($cliente['status']) && $cliente['status'] == true)
                            <input type="checkbox" name="" checked id="status" value="{{$cliente['status']}}">
                        @else
                            <input type="checkbox" name="alunos[status]" id="status" value="">
                        @endif
                    @endif
                    <label for="op1"> Ativar </label>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 135px; height: 115px;">
                @if (isset($cliente['img']) && $cliente['img'] != null)
                    <div id="midias">
                        <img id="logo" src="" class="ajuste-img" alt="Foto" height="300" width="150"/><br/>
                        <button type="button" class="btn btn-danger removerFoto">Remover Foto</button>
                    </div>
                @endif
            </div>
            <div>
                <span class="btn btn-primary btn-xs btn-block btn-file">
                    <span class="fileinput-new">Selecionar</span>
                    <span class="fileinput-exists">Mudar</span>
                    <input type="file" name="img">
                    <input type="hidden" name="imgAtual" value="">
                </span>
                <a href="#" class="btn btn-warning btn-xs fileinput-exists col-md-6"
                   data-dismiss="fileinput">Remover</a>
            </div>
        </div>
    </div>
</div>
<hr class="hr-line-dashed"/>


<div class="row">
    <div class="col-md-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#dados" aria-controls="dados" data-toggle="tab"><i class="fa fa-male"></i> Dados pessoais</a>
            </li>
            <li role="presentation">
                <a href="#contato" aria-controls="contato" role="tab" data-toggle="tab"><i class="fa fa-globe"></i>Informações para contato</a>
            </li>
            <li role="presentation">
                <a href="#ensMedio" aria-controls="ensMedio" role="tab" data-toggle="tab"><i class="fa fa-file-text"></i> Ensino Superior</a>
            </li>
            <li role="presentation">
                <a href="#documentosObrig" aria-controls="documentosObrig" role="tab" data-toggle="tab"><i class="fa fa-file-text"></i>Documentos Obrigatórios</a>
            </li>

        </ul>
        <!-- End Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="dados">
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-2">
                                {!! Form::label('estado_civis_id', 'Estado Civil ') !!}
                                {!! Form::select('estado_civis_id', $loadFields['estadocivil'], Session::getOldInput('estado_civis_id'),array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('grau_instrucoes_id', 'Grau de instrução') !!}
                                {!! Form::select('grau_instrucoes_id', $loadFields['grauinstrucao'], Session::getOldInput('grau_instrucoes_id'),array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-4">
                                {!! Form::label('profissoes_id', 'Profissão ') !!}
                                {!! Form::select('profissoes_id', array(), Session::getOldInput('profissoes_id'),array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('cores_racas_id', 'Cor/Raça') !!}
                                {!! Form::select('cores_racas_id', $loadFields['corraca'], Session::getOldInput('cores_racas_id'),array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('tipos_sanguinios_id', 'Tipo Sanguíneo') !!}
                                {!! Form::select('tipos_sanguinios_id', $loadFields['tiposanguinio'] , Session::getOldInput('tipos_sanguinios_id'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {!! Form::label('nacionalidade', 'Nacionalidade ') !!}
                                {!! Form::text('nacionalidade', Session::getOldInput('nacionalidade'), array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::label('uf_nascimento_id', 'UF Nascimento') !!}
                                {!! Form::select('uf_nascimento_id', $loadFields['estado'], Session::getOldInput('uf_nascimento_id'),array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::label('naturalidade', 'Naturalidade ') !!}
                                {!! Form::text('naturalidade', Session::getOldInput('naturalidade'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <legend><i class="fa fa-archive"></i> Outros dados</legend>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#filiacao"> <i
                                                    class="fa fa-plus-circle"></i> Filiação</a>
                                    </h4>
                                </div>
                                <div id="filiacao" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                {!! Form::label('nome_pai', 'Nome Pai ') !!}
                                                {!! Form::text('nome_pai', Session::getOldInput('nome_pai'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-6">
                                                {!! Form::label('nome_mae', 'Nome Mãe ') !!}
                                                {!! Form::text('nome_mae',Session::getOldInput('nome_mae'), array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> <i
                                                    class="fa fa-plus-circle"></i> Documentos</a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                {!! Form::label('identidade', 'Identidade ') !!}
                                                {!! Form::text('identidade', Session::getOldInput('identidade'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                {!! Form::label('orgao_rg', 'Orgão RG ') !!}
                                                {!! Form::text('orgao_rg', Session::getOldInput('orgao_rg'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                {!! Form::label('uf_exp', 'UF') !!}
                                                {!! Form::text('uf_exp', Session::getOldInput('nome'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                {!! Form::label('data_expedicao', 'Data expedição') !!}

                                                {!! Form::text('data_expedicao', null , array('class' => 'form-control datepicker')) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                {!! Form::label('cpf', 'CPF *') !!}
                                                {!! Form::text('cpf', Session::getOldInput('cpf'), array('class' => 'form-control cpf', 'id' => 'cpfAlunos')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('titulo_eleitoral', 'Título Eleitoral') !!}
                                                {!! Form::text('titulo_eleitoral', Session::getOldInput('titulo_eleitoral'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-1">
                                                {!! Form::label('zona', 'Zona') !!}
                                                {!! Form::text('zona', Session::getOldInput('zona'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-1">
                                                {!! Form::label('secao', 'Seção') !!}
                                                {!! Form::text('secao', Session::getOldInput('secao') , array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('resevista', 'Reservista') !!}
                                                {!! Form::text('resevista', Session::getOldInput('resevista'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                {!! Form::label('catagoria_resevista', 'Categoria Reservista') !!}
                                                {!! Form::text('catagoria_resevista', Session::getOldInput('catagoria_resevista'), array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#deficiencia"> <i
                                                    class="fa fa-plus-circle"></i> Deficiencia</a>
                                    </h4>
                                </div>
                                <div id="deficiencia" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                {!! Form::label('tipoDef', 'Deficiências') !!}
                                                    <div class="checkbox checkbox-primary">
                                                        {!! Form::hidden('deficiencia_fisica', 0) !!}
                                                        {!! Form::checkbox('deficiencia_fisica', 1, null, array('class' => 'form-control')) !!}
                                                        {!! Form::label('deficiencia_fisica', 'Física') !!}
                                                    <div class="checkbox checkbox-primary checkbox-inline">
                                                        {!! Form::hidden('deficiencia_auditiva', 0) !!}
                                                        {!! Form::checkbox('deficiencia_auditiva', 1, null, array('class' => 'form-control')) !!}
                                                        {!! Form::label('deficiencia_auditiva', 'Auditivas', false) !!}
                                                    </div>
                                                    <div class="checkbox checkbox-primary checkbox-inline">
                                                        {!! Form::hidden('deficiencia_visual', 0) !!}
                                                        {!! Form::checkbox('deficiencia_visual', 1, null, array('class' => 'form-control')) !!}
                                                        {!! Form::label('deficiencia_visual', 'Visuais', false) !!}
                                                    </div>
                                                    <div class="checkbox checkbox-primary checkbox-inline">
                                                        {!! Form::hidden('deficiencia_outra', 0) !!}
                                                        {!! Form::checkbox('deficiencia_outra', 1, null,array('class' => 'form-control')) !!}
                                                        {!! Form::label('deficiencia_outra', 'Outras') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="contato">
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-10">
                                {!! Form::label('endereco[logradouro]', 'Endereço ') !!}
                                {!! Form::text('endereco[logradouro]', Session::getOldInput('endereco[logradouro]'), array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('endereco[numero]', 'Número') !!}
                                {!! Form::text('endereco[numero]', Session::getOldInput('endereco[numero]'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {!! Form::label('estados_id', 'UF ') !!}
                                {!! Form::select('estados_id', $loadFields['estado'], Session::getOldInput('estados_id'), array('class' => 'form-control', 'id' => 'estado')) !!}
                            </div>
                            <div class="form-group col-md-4">
                                {!! Form::label('cidade', 'Cidade ') !!}
                                @if(isset($aluno->endereco->bairro->cidade))
                                    {!! Form::select('cidade', array($aluno->endereco->bairro->cidade->id => $aluno->endereco->bairro->cidade->nome), $aluno->endereco->bairro->cidade->id,array('class' => 'form-control', 'id' => 'cidade')) !!}
                                @else
                                    {!! Form::select('cidade', array(), Session::getOldInput('cidade'),array('class' => 'form-control', 'id' => 'cidade')) !!}
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::label('endereco[bairros_id]', 'Bairro ') !!}
                                @if(isset($aluno->endereco->bairro))
                                    {!! Form::select('endereco[bairros_id]', array($aluno->endereco->bairro->id => $aluno->endereco->bairro->nome), $aluno->endereco->bairro->id,array('class' => 'form-control', 'id' => 'bairro')) !!}
                                @else
                                    {!! Form::select('endereco[bairros_id]', array(), Session::getOldInput('bairro'),array('class' => 'form-control', 'id' => 'bairro')) !!}
                                @endif
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('endereco[cep]', 'CEP ') !!}
                                {!! Form::text('endereco[cep]', Session::getOldInput('endereco[cep]'), array('class' => 'form-control cep')) !!}
                            </div>
                        </div>
                        <legend><i class="fa fa-phone"></i> Contato</legend>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#contato1"> <i
                                                    class="fa fa-plus-circle"></i> Contato pessoal</a>
                                    </h4>
                                </div>
                                <div id="contato1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                {!! Form::label('email', 'E-mail') !!}
                                                {!! Form::text('email', Session::getOldInput('email'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                {!! Form::label('telefone_fixo', 'Telefone fixo') !!}
                                                {!! Form::text('telefone_fixo', Session::getOldInput('telefone_fixo') , array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('celular', 'Celular') !!}
                                                {!! Form::text('celular', Session::getOldInput('celular'), array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('celular2', 'Celular 2') !!}
                                                {!! Form::text('celular2', Session::getOldInput('celular2'), array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#endprof"> <i
                                                    class="fa fa-plus-circle"></i> Contato profissional</a>
                                    </h4>
                                </div>
                                <div id="endprof" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                {!! Form::label('nome_emp', 'Nome da empresa') !!}
                                                {!! Form::text('nome_emp',Session::getOldInput('nome'), array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                {!! Form::label('uf_pro', 'UF ') !!}
                                                {!! Form::select('uf_pro', array(), Session::getOldInput('nome'), array('class' => 'form-control', 'id' => 'estadoPro')) !!}
                                            </div>
                                            <div class="form-group col-md-4">
                                                {!! Form::label('cidade', 'Cidade ') !!}
                                                {!! Form::select('cidade', array(), Session::getOldInput('nome'),array('class' => 'form-control', 'id' => 'cidadePro')) !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                {!! Form::label('bairro', 'Bairro ') !!}
                                                {!! Form::select('bairro', array(), Session::getOldInput('nome'),array('class' => 'form-control', 'id' => 'bairroPro')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('cep_pro', 'CEP') !!}
                                                {!! Form::text('cep_pro',Session::getOldInput('nome') , array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                {!! Form::label('email_institucional', 'E-mail institucional') !!}
                                                {!! Form::text('email_institucional',Session::getOldInput('nome') , array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('tel_fixo_pro', 'Telefone Fixo') !!}
                                                {!! Form::text('tel_fixo_pro', Session::getOldInput('nome') , array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="form-group col-md-2">
                                                {!! Form::label('cel_pro', 'Celular') !!}
                                                {!! Form::text('cel_pro',Session::getOldInput('nome') , array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ensMedio">
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="firmacaoacad_id">Formação Acadêmica</label>
                                <select id="firmacaoacad_id" class="form-control">
                                    {{--@if(isset($cliente['instituicao']))--}}
                                        {{--<option value="{{ ''  }}" selected="selected">{{ ''  }}</option>--}}
                                    {{--@endif--}}
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="instituicao">Instituição</label>
                                <select id="instituicao" class="form-control" name="fac_instituicoes_id">
                                   @if(isset($aluno) && $aluno->instituicao != null)
                                        <option value="{{ $aluno->instituicao->id  }}" selected="selected">{{ $aluno->instituicao->nome }}</option>
                                   @endif
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                {!! Form::label('ano_conlusao', 'Ano Conclusão') !!}
                                {!! Form::text('ano_conlusao', Session::getOldInput('nome'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {!! Form::label('outra_escola', 'Outra Escola') !!}
                                {!! Form::text('outra_escola', Session::getOldInput('outra_escola'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div role="tabpanel" class="tab-pane" id="documentosObrig">
                <br/>

            </div>


        </div>
    </div>
    <div class="col-md-10"></div>
    <div class="col-md-2">
        {!! Form::submit('Salvar', array('class' => 'btn btn-primary btn-block pull-right')) !!}
    </div>
</div>

</div>