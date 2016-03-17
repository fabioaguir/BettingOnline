<div class="row">
	<div class="col-md-10">
		<div class="row">
            <div class="col-md-4">
                <div class="form-group">
				{!! Form::label('nome', 'nome') !!}
				{!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                </div>
            </div>
           {{-- <div class="col-md-4">
                <div class="form-group">
				{!! Form::label('carga_horaria', 'carga_horaria') !!}
				{!! Form::text('carga_horaria', Session::getOldInput('carga_horaria')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
				{!! Form::label('qtd_credito', 'qtd_credito') !!}
				{!! Form::text('qtd_credito', Session::getOldInput('qtd_credito')  , array('class' => 'form-control')) !!}
                </div>
            </div>--}}
            <div class="col-md-4">
                <div class="form-group">
				{!! Form::label('qtd_falta', 'Qtd. Faltas') !!}
				{!! Form::text('qtd_falta', Session::getOldInput('qtd_falta')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
				{!! Form::label('tipo_disciplina_id', 'Tipo Disciplina') !!}
				{!! Form::select('tipo_disciplina_id', $loadFields['tipodisciplina'], null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
				{!! Form::label('tipo_avaliacao_id', 'Tipo Avaliação') !!}
				{!! Form::select('tipo_avaliacao_id', $loadFields['tipoavaliacao'], null, array('class' => 'form-control')) !!}
                </div>
            </div>
		</div>
        {!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
	</div>
</div>