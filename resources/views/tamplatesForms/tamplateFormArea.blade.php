<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <div class="form-group">
                    {!! Form::label('nome', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-5">
                        {!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label label-input-xs">Ativar/Desativar</label>
                    <div class="col-sm-8">
                        <ul class="demo-btns mb-n xs">
                            <li>
                                {!! Form::hidden('status', 0) !!}
                                {!! Form::checkbox('status', 1, null, ['class' => 'js-switch-info switchery-xs']) !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>