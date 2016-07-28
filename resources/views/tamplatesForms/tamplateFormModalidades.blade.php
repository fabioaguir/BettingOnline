<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <div class="form-group">
                    {!! Form::label('nome', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('limite_cotacao', 'Limite para cotação', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('limite_cotacao', Session::getOldInput('limite_cotacao')  , array('class' => 'form-control money')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status_id', 'Ativo', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::select('status_id',  (['' => 'Selecione uma situação'] + $loadFields['status']->toArray()), Session::getOldInput('status_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>