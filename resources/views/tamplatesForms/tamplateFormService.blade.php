<div class="row">
    <div class="col-md-12">
        <div class="row">

            <div class="form-group">
                {!! Form::label('sev_name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('sev_name', Session::getOldInput('sev_name')  , array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('sev_amount', 'Valor', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('sev_amount', Session::getOldInput('sev_amount')  , array('class' => 'form-control')) !!}
                </div>
            </div>

        </div>

    </div>
</div>