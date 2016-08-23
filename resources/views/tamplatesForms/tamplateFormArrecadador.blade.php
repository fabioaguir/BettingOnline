<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="form-group">
                {!! Form::label('nome', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('usuario', 'Usuário', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-4">
                    {!! Form::text('usuario', Session::getOldInput('usuario')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('senha', 'Senha', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-4">
                    {!! Form::text('senha', Session::getOldInput('senha')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('status_id', 'Ativo', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-2">
                    {!! Form::select('status_id', $loadFields['status'], Session::getOldInput('status_id'), array('class' => 'form-control')) !!}
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