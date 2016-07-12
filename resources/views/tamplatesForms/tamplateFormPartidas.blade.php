<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <div class="form-group">
                    {!! Form::label('data', 'Data', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('data', Session::getOldInput('data')  , array('class' => 'form-control mask', 'data-inputmask' => "'alias': 'date'")) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('hora', 'Hora', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('hora', Session::getOldInput('hora')  , array('class' => 'form-control mask', 'data-inputmask' => "'alias': 'time'")) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('campeonato_id', 'Tabelas', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::select('campeonato_id', (['' => 'Selecione um campeonato'] + $loadFields['campeonatos']->toArray()), Session::getOldInput('campeonato_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('time_casa_id', 'Time - Casa', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::select('time_casa_id', (['' => 'Selecione um time'] + $loadFields['times']->toArray()), Session::getOldInput('campeonato_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('time_fora_id', 'Time - Fora', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::select('time_fora_id',  (['' => 'Selecione um time'] + $loadFields['times']->toArray()), Session::getOldInput('time_fora_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('status_id', 'Ativo', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::select('status_id',  (['' => 'Selecione uma situação'] + $loadFields['status']->toArray()), Session::getOldInput('status_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>