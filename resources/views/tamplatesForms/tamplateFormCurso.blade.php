<div class="row">
	<div class="col-md-10">
		<div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('nome', 'Nome ') !!}
				{!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('codigo', 'Código ') !!}
				{!! Form::text('codigo', Session::getOldInput('codigo')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('duracao_meses', 'Duração (meses) ') !!}
				{!! Form::text('duracao_meses', Session::getOldInput('duracao_meses')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('portaria_mec_rec', 'Portaria MEC (REC)') !!}
				{!! Form::text('portaria_mec_rec', Session::getOldInput('portaria_mec_rec')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('numero_decreto_rec', 'Nº Decreto (REC)') !!}
				{!! Form::text('numero_decreto_rec', Session::getOldInput('numero_decreto_rec')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('data_decreto_rec', 'Data Decreto (REC)') !!}
				{!! Form::text('data_decreto_rec', Session::getOldInput('data_decreto_rec')  , array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('data_dou_rec', 'Data Dou (REC') !!}
				{!! Form::text('data_dou_rec', Session::getOldInput('data_dou_rec'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('portaria_mec_aut', 'Portaria MEC (AUT)') !!}
				{!! Form::text('portaria_mec_aut', Session::getOldInput('portaria_mec_aut')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('numero_decreto_aut', 'Nº Decreto (AUT)') !!}
				{!! Form::text('numero_decreto_aut', Session::getOldInput('numero_decreto_aut')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('data_decreto_aut', 'Data Decreto (AUT)') !!}
				{!! Form::text('data_decreto_aut', Session::getOldInput('data_decreto_aut'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('data_dou_aut', 'Data Dou (AUT)') !!}
				{!! Form::text('data_dou_aut', Session::getOldInput('data_dou_aut'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('data_matricula_inicio', 'Matrícula Início') !!}
				{!! Form::text('data_matricula_inicio', Session::getOldInput('data_matricula_inicio'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('data_matricula_fim', 'Matrícula Final') !!}
				{!! Form::text('data_matricula_fim', Session::getOldInput('data_matricula_fim'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('inicio_aula', 'Início Aulas') !!}
				{!! Form::text('inicio_aula', Session::getOldInput('inicio_aula'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('fim_aula', 'Fim Aulas') !!}
				{!! Form::text('fim_aula', Session::getOldInput('fim_aula'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('maximo_vagas', 'Máximo Vagas') !!}
				{!! Form::text('maximo_vagas', Session::getOldInput('maximo_vagas')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('minumo_vagas', 'Mínimo Vagas') !!}
				{!! Form::text('minumo_vagas', Session::getOldInput('minumo_vagas')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('obs_vagas', 'Observação Vagas') !!}
				{!! Form::text('obs_vagas', Session::getOldInput('obs_vagas')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('valor', 'Valor') !!}
				{!! Form::text('valor', Session::getOldInput('valor')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('parcelas', 'Qtd. Parcelas') !!}
				{!! Form::text('parcelas', Session::getOldInput('parcelas')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('vencimento_inicial', 'Vencimento Inicial') !!}
				{!! Form::text('vencimento_inicial', Session::getOldInput('vencimento_inicial'), array('class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('sede_id', 'Sede') !!}
				{!! Form::select('sede_id', $loadFields['sede'], null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('tipo_curso_id', 'Tipo Curso') !!}
				{!! Form::select('tipo_curso_id', $loadFields['tipocurso'], null,  array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('cordenador_id', 'Cordenador') !!}
				{!! Form::select('cordenador_id', array(), null, array('class' => 'form-control')) !!}
                </div>
            </div>
		</div>
        {!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
	</div>
</div>