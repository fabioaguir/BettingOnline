<div class="row">
    <div class="col-md-12">
        <div class="row">

            <div class="form-group">
                {!! Form::label('sev_name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('catpay_name', Session::getOldInput('catpay_name')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            
        </div>

    </div>
</div>