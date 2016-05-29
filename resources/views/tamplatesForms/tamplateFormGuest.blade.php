<div class="row">
	<div class="col-md-12">
		<div class="row">

            <div class="col-md-10">
                <div class="form-group">
				{!! Form::label('gue_name', 'Nome') !!}
				{!! Form::text('gue_name', Session::getOldInput('gue_name')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('gue_gen_id', 'Sexo') !!}
                    {!! Form::select('gue_gen_id',array() /*$loadFields['gender']*/, Session::getOldInput('gue_gen_id'), array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('gue_dt_birth', 'Data de nascimento') !!}
                    {!! Form::text('gue_dt_birth', Session::getOldInput('gue_dt_birth'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
				{!! Form::label('gue_cpf', 'CPF') !!}
				{!! Form::text('gue_cpf', Session::getOldInput('gue_cpf')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
				{!! Form::label('gue_rg', 'RG') !!}
				{!! Form::text('gue_rg', Session::getOldInput('gue_rg')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
				{!! Form::label('gue_email', 'E-mail') !!}
				{!! Form::text('gue_email', Session::getOldInput('gue_email')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('gue_phone', 'Telefone') !!}
                    {!! Form::text('gue_phone', Session::getOldInput('gue_phone')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('gue_phone2', 'Celular') !!}
                    {!! Form::text('gue_phone2', Session::getOldInput('gue_phone2')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox checkbox-primary">
                    {!! Form::hidden('gue_visible', 0) !!}
                    {!! Form::checkbox('gue_visible', 1, null, array('class' => 'form-control')) !!}
                    {!! Form::label('gue_visible', 'Visível', false) !!}
                </div>
            </div>
		</div>
        <div class="row">

            <div class="col-md-3">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a href="" class="btn btn-primary btn-block"><i
                                    class="fa fa-long-arrow-left"></i> Voltar</a></div>
                    <div class="btn-group">
                        {!! Form::submit('Salvar', array('class' => 'btn btn-primary btn-block')) !!}
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>