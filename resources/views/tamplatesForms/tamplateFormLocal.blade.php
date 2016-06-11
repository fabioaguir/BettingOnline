<div class="row">
    <div class="col-md-10">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">

                    {!! Form::label('loc_value', 'Valor') !!}
                    {!! Form::text('loc_value', Session::getOldInput('loc_value')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">

                    {!! Form::label('loc_occupants', 'Ocupantes') !!}
                    {!! Form::text('loc_occupants', Session::getOldInput('loc_occupants')  , array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-md-2">
                <div class="checkbox checkbox-primary">
                    {!! Form::hidden('loc_visible', 0) !!}
                    {!! Form::checkbox('loc_visible', 1, null, array('class' => 'form-control')) !!}
                    {!! Form::label('loc_visible', 'Visível', false) !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">

                    {!! Form::label('loc_title', 'Título') !!}
                    {!! Form::text('loc_title', Session::getOldInput('loc_title')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">

                    {!! Form::label('loc_name', 'Nome') !!}
                    {!! Form::text('loc_name', Session::getOldInput('loc_name')  , array('class' => 'form-control')) !!}
                </div>
            </div>

        </div>
        
        <div class="row">

            <div class="col-md-3">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a href="{{ route('softage.local.index')}}" class="btn btn-primary btn-block"><i
                                    class="fa fa-long-arrow-left"></i> Voltar</a></div>
                    <div class="btn-group">
                        {!! Form::submit('Salvar', array('class' => 'btn btn-primary btn-block')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>