<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#principal" data-toggle="tab">Dados pessoais</a></li>
                    <li><a href="#endereco" data-toggle="tab">Endereço</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="principal">
                        <br /><br />
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-3">
                                <div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
                                    <div>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Selecione uma imagem</span>
                                            <span class="fileinput-exists">Selecionar</span>
                                            <input type="file" name="...">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('gue_name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::text('gue_name', Session::getOldInput('gue_name')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_gen_id', 'Sexo', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::select('gue_gen_id', $loadFields['gender'], Session::getOldInput('gue_gen_id'), array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_dt_birth', 'Data de nascimento', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('gue_dt_birth', Session::getOldInput('gue_dt_birth'), array('class' => 'form-control datepicker')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_cpf', 'CPF', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('gue_cpf', Session::getOldInput('gue_cpf')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_rg', 'RG', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('gue_rg', Session::getOldInput('gue_rg')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_phone', 'Telefone', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('gue_phone', Session::getOldInput('gue_phone')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_phone2', 'Celular', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('gue_phone2', Session::getOldInput('gue_phone2')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gue_email', 'E-mail', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-6">
                                {!! Form::text('gue_email', Session::getOldInput('gue_email')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label label-input-xs">Ativar/Desativar</label>
                            <div class="col-sm-8">
                                <ul class="demo-btns mb-n xs">
                                    <li>
                                        {!! Form::hidden('gue_visible', 0) !!}
                                        {!! Form::checkbox('gue_visible', 1, null, ['class' => 'js-switch-info switchery-xs']) !!}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="endereco">
                        <br /><br />
                        <div class="form-group">
                            {!! Form::label('adr_address', 'Logradouro', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::text('address[adr_address]', Session::getOldInput('address[adr_address]')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('adr_cep', 'CEP', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('address[adr_cep]', Session::getOldInput('address[adr_cep]')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('adr_country', 'Pais', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-2">
                                {!! Form::text('address[adr_country]', Session::getOldInput('address[adr_country]'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('adr_sta_id', 'Estado', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-3">
                                {!! Form::select('address[adr_sta_id]', $loadFields['state'], Session::getOldInput('address[adr_sta_id]'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('adr_city', 'Cidade', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-3">
                                {!! Form::text('address[adr_city]', Session::getOldInput('address[adr_city]')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('adr_district', 'Bairro', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-4">
                                {!! Form::text('address[adr_district]', Session::getOldInput('address[adr_district]')  , array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>