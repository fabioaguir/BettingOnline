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
                    {!! Form::label('status_id', 'Status', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::select('status_id', $loadFields['status'], Session::getOldInput('status_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_time.js')}}"></script>
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);
    </script>
@endsection