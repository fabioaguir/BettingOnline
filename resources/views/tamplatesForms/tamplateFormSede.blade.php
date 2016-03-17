<div class="row">
    <div class="col-md-12">

    </div>
    <div class="col-md-12">
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        {!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
    </div>
</div>