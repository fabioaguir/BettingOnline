<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#principal" data-toggle="tab">Dados principais</a></li>
                    <li><a href="#config" data-toggle="tab">Configuração do vendedor</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="principal">
                        <br /><br />
                        <div class="row">
                            <div class="form-group">
                                {!! Form::label('nome', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('areas_id', 'Área', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-5">
                                    {!! Form::select('area_id', $areas, Session::getOldInput('area_id'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('usuario', 'Usuário', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('usuario', Session::getOldInput('usuario')  , array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('senha', 'Senha', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('senha', Session::getOldInput('senha')  , array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('status_id', 'Ativo', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-2">
                                    {!! Form::select('status_id', $loadFields['status'], Session::getOldInput('status_id'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('estorno_id', 'Estorno', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-2">
                                    {!! Form::select('estorno_id', $loadFields['estornovendedor'], Session::getOldInput('estorno_id'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn" style="margin-left: -11px">Salvar</button>
                                <a class="btn-default btn" href="{{ route('betting.vendedor.index')}}">Voltar</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="config">
                        <br /><br />
                        <div class="row">
                            <div class="form-group">
                                {!! Form::label('limite_vendas', 'Limite de vendas', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-3">
                                    {!! Form::text('config[limite_vendas]', Session::getOldInput('config[limite_vendas]')  , array('class' => 'form-control touchspin2 money')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('comissao', 'Comissão', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-3">
                                    {!! Form::text('config[comissao]', Session::getOldInput('config[comissao]')  , array('class' => 'form-control touchspin2 money')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('cotacao', 'Cotação', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-3">
                                    {!! Form::text('config[cotacao]', Session::getOldInput('config[cotacao]')  , array('class' => 'form-control touchspin1 money')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('tipo_cotacao_id', 'Tipo de cotação', array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-3">
                                    {!! Form::select('config[tipo_cotacao_id]', $loadFields['tipocotacao'], Session::getOldInput('config[tipo_cotacao_id]'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button type="submit" class="btn-primary btn" style="margin-left: -11px">Salvar</button>
                                <a class="btn-default btn" href="{{ route('betting.vendedor.index')}}">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>