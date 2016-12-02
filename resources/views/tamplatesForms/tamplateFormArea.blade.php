<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div>
                <div class="form-group">
                    {!! Form::label('nome', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-5">
                        {!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label label-input-xs">Ativar/Desativar</label>
                    <div class="col-sm-8">
                        <ul class="demo-btns mb-n xs">
                            <li>
                                {!! Form::hidden('status', 0) !!}
                                @if(!isset($model->id))
                                    {!! Form::checkbox('status', 1, null, ['class' => 'js-switch-info switchery-xs', 'checked' => 'checked']) !!}
                                @else
                                    {!! Form::checkbox('status', 1, null, ['class' => 'js-switch-info switchery-xs']) !!}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_area.js')}}"></script>
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);
    </script>
@endsection