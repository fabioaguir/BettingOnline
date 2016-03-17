<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-4">
                {!! Form::label('nome', 'Nome:') !!}
                {!! Form::text('nome', null, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-2">
                {!! Form::label('bloco', 'Bloco: ') !!}
                {!! Form::text('bloco', null, array('class' => 'form-control')) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('andar', 'Andar: ') !!}
                {!! Form::text('andar', null, array('class' => 'form-control')) !!}
            </div>

        </div>

        <div class="row">
            <div class="form-group col-md-2">
                {!! Form::label('numero', 'Número: ') !!}
                {!! Form::text('numero', null, array('class' => 'form-control')) !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('capacidade', 'Capacidade:') !!}
                {!! Form::text('capacidade', null, array('class' => 'form-control')) !!}
            </div>
        </div>



        <div class="row">
            <div class="form-group col-md-4">
                {!! Form::hidden('situacao', 0) !!}
                {!! Form::label('situacao', 'Ativo') !!}
                {!! Form::checkbox('situacao', 1, null, array('class' => 'form-control')) !!}
            </div>
        </div>
        {!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
    </div>
</div>