<div class="row">
    <div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="searchDate">Data</label>
            <div class="col-sm-8">
                <div class="input-group">
                    @if(isset($model->id))
                        <input class="form-control mask" value="{{$model->partida->data}}" data-inputmask="'alias': 'date'" type="text" id="searchDate">
                    @else
                        <input class="form-control mask datepicker" data-inputmask="'alias': 'date'" type="text" id="searchDate">
                    @endif
                    <div class="input-group-btn">
                        <button class="btn btn-info" id="btnSearch" type="button">Buscar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group ajuste-margin-top">
            {!! Form::label('partida_id', 'Partida', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-8">
                @if(isset($model->id))
                    {!! Form::select('partida_id', [$model->partida->id => $model->partida->casa->nome . " x " . $model->partida->fora->nome],
                             Session::getOldInput('partida_id'), array('class' => 'form-control')) !!}
                @else
                    {!! Form::select('partida_id', array(), Session::getOldInput('partida_id'), array('class' => 'form-control')) !!}
                @endif
            </div>
        </div>

        <div class="form-group ajuste-margin-top">
            {!! Form::label('time_id', 'Time', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::select('time_id', [], Session::getOldInput('time_id'), array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group ajuste-margin-top">
            {!! Form::label('tempo_id', 'Tempo', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::select('tempo_id',  [], Session::getOldInput('tempo_id'), array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group ajuste-margin-top">
            {!! Form::label('minutos', 'Minutos', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::text('minutos', Session::getOldInput('minutos')  , array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-primary btn" style="margin-left: -7px">Salvar</button>
                <a class="btn-default btn" href="{{ route('betting.gols.index')}}">Voltar</a>
            </div>
        </div>
        <br/><br/>
    </div>
</div>