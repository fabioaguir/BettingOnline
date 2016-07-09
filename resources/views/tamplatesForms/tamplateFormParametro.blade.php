<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <div class="form-group">
                    {!! Form::label('nome_banca', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-5">
                        {!! Form::text('nome_banca', Session::getOldInput('nome_banca')  , array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label label-input-xs">Nome Da Banca Na Aposta?</label>
                    <div class="col-sm-8">
                        <ul class="demo-btns mb-n xs">
                            <li>
                                {!! Form::hidden('status', 0) !!}
                                {!! Form::checkbox('status', 1, null, ['class' => 'js-switch-info switchery-xs']) !!}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('mensagem_rodape', 'Mensagem Rodapé', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-5">
                        {!! Form::textarea('mensagen_rodape', Session::getOldInput('mensagem_rodape')  ,['size' => '50x3'] , array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('limite_premiacao', 'Limite de Premiação Cliente', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('limite_premiacao', Session::getOldInput('limite_premiacao')  , array('class' => 'form-control')) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>