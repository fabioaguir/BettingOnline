<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="searchDate">Data</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        @if(isset($model->id))
                            <input class="form-control mask" value="{{$model->partida->data}}"
                                   data-inputmask="'alias': 'date'" type="text" id="searchDate">
                        @else
                            <input class="form-control mask datepicker" data-inputmask="'alias': 'date'" type="text"
                                   id="searchDate">
                        @endif
                        <div class="input-group-btn">
                            <button class="btn btn-info" id="btnSearch" type="button">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('partida_id', 'Partida', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-3">
                    @if(isset($model->id))
                        {!! Form::select('partida_id', [$model->partida->id => $model->partida->casa->nome . " x " . $model->partida->fora->nome],
                         Session::getOldInput('partida_id'), array('class' => 'form-control')) !!}
                    @else
                        {!! Form::select('partida_id', array(), Session::getOldInput('partida_id'), array('class' => 'form-control')) !!}
                    @endif
                </div>
            </div>
        </div><br />
        <div class="row">
            <div style="margin-left: 154px" class="col-md-6">
                <table class="table">
                    @foreach($modalidades as $modalidade)
                        <tr>
                            <td>
                                {{$modalidade->nome}}
                            </td>
                            <td>
                                <div class="form-group" style="margin-top: 1px">
                                    {!! Form::text('valor[]', $modalidade->limite_cotacao , array('class' => 'form-control money')) !!}
                                    <input type="hidden" name="id[]" value="{{$modalidade->id}}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="margin-top: 1px; margin-left: 2px">
                                    {!! Form::select('status[]', $loadFields2['status'], null, array('class' => 'form-control')) !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_cotacao.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/cotacoes/cotacoes.js')  }}"></script>
    <script type="text/javascript">
        // Evento para bloquear a cotação se caso o valor passado
        // for maior que o limite definido na modalidade
        // Recuperando o id da modalidade
        /*$('#formCotacao').submit(function (event) {
            event.preventDefault();

            // Recuperando o id da modalidade
            var idModalidade = $('#modalidade_id').find('option:selected').val();

            // Validando a modalidade
            if(idModalidade) {
                // Requisição ajax
                jQuery.ajax({
                    type: 'GET',
                    url: laroute.route('betting.modalidades.getModalidade', {'id' : idModalidade}),
                    datatype: 'json'
                }).done(function (jsonResponse) {

                    if (jsonResponse.success) {
                        // Recuperando o valor da cotação
                        var valorCotacao = $('#valor').val();
                        // Regra de negócio
                        if(parseFloat(valorCotacao) > parseFloat(jsonResponse.data.limite_cotacao)) {

                            // Mensagem
                            bootbox.alert('Valor informado tem que ser menor que o limite estabelecido, limite ' + jsonResponse.data.limite_cotacao);

                            // Matando o processo
                            event.preventDefault();
                        } else {
                            // Encaminhando a requisição
                            $('#formCotacao').unbind('submit').submit()
                        }
                    } else {
                        // Mensagem de retorno caso ocorra algum problema
                        bootbox.alert(jsonResponse.msg);
                    }
                });
            }
        });*/
    </script>
@endsection