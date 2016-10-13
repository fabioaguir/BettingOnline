<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <div class="form-group">
                    {!! Form::label('data', 'Data', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('data', Session::getOldInput('data')  , array('class' => 'form-control mask datepicker', 'data-inputmask' => "'alias': 'date'")) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('hora', 'Hora', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('hora', Session::getOldInput('hora')  , array('class' => 'form-control', 'id' => 'hora')) !!}
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
                        {!! Form::select('status_id',  $loadFields['status'], Session::getOldInput('status_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkbox" class="col-sm-2 control-label">Partida simples?</label>
                    <div class="col-sm-8">
                        {!! Form::hidden('simples', 0) !!}
                        {!! Form::checkbox('simples', 1, null, array('class' => 'checkbox-inline', 'id' => 'simples')) !!}
                    </div>
                </div>
                <div class="form-group" id="limite_aposta">
                    {!! Form::label('limite_valor_aposta', 'Limite de aposta', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('limite_valor_aposta', Session::getOldInput('limite_valor_aposta')  , array('class' => 'form-control money')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkbox" class="col-sm-2 control-label">"Sete da sorte"?</label>
                    <div class="col-sm-8">
                        {!! Form::hidden('sete_da_sorte', 0) !!}
                        {!! Form::checkbox('sete_da_sorte', 1, null, array('class' => 'checkbox-inline')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkbox" class="col-sm-2 control-label">Partida obrigatória "sete da sorte"?</label>
                    <div class="col-sm-8">
                        {!! Form::hidden('sete_sorte_obr', 0) !!}
                        {!! Form::checkbox('sete_sorte_obr', 1, null, array('class' => 'checkbox-inline')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_partida.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/js/select2_times.js')}}"></script>
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);
        $(document).ready(function(){
            $("#hora").inputmask("hh:mm:ss", {"clearIncomplete": true});

            @if(isset($model->id) && $model->limite_valor_aposta)
                $('#limite_aposta').show("slow");
            @else
                $('#limite_aposta').hide("slow");
            @endif

        });

        $(document).on('click', '#simples', function(){
            if($("#simples").is(":checked")) {
                $('#limite_aposta').show("slow");
            } else {
                $('#limite_valor_aposta').val("");
                $('#limite_aposta').hide("slow");
            }
        });

    </script>
@endsection