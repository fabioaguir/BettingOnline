<div class="row">
	<div class="col-md-12">
		<div class="row">
            <div class="col-md-2">
            <div class="form-group">
                <?php $data = new \DateTime('now') ?>
                <?php $dataInicio =  isset($request['data_inicio']) ? $request['data_inicio'] : ""; ?>
				{!! Form::label('data_inicio', 'Início') !!}
				{!! Form::text('data_inicio', $dataInicio , array('class' => 'form-control date datepicker')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php $dataFim =  isset($request['data_fim']) ? $request['data_fim'] : ""; ?>
				{!! Form::label('data_fim', 'Fim') !!}
				{!! Form::text('data_fim', $data->format('d/m/Y') , array('class' => 'form-control date datepicker')) !!}
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" style="margin-top: 18px" id="search" class="btn-primary btn">Consultar</button>
            </div>
            <br />
		</div>
	</div>
    {{--Fim Buttons Submit e Voltar--}}
</div>