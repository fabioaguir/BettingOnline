<div class="row">
    <div class="col-md-12">
        <div class="row">

            <div class="form-group">
                {!! Form::label('loc_value', 'Valor', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('loc_value', Session::getOldInput('loc_value')  , array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('loc_occupants', 'Ocupantes', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('loc_occupants', Session::getOldInput('loc_occupants')  , array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label label-input-xs">Ativar/Desativar</label>
                <div class="col-sm-8">
                    <ul class="demo-btns mb-n xs">
                        <li>
                            {!! Form::hidden('loc_visible', 0) !!}
                            {!! Form::checkbox('loc_visible', 1, null, ['class' => 'js-switch-info switchery-xs']) !!}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('loc_title', 'Título', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('loc_title', Session::getOldInput('loc_title')  , array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('loc_name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('name', Session::getOldInput('name')  , array('class' => 'form-control')) !!}
                </div>
            </div>

        </div>

    </div>
</div>