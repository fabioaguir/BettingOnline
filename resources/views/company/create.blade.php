@extends('menu')

@section('css')
    @parent
    <style>
        .form-group {
            margin-top: -10px;;
        }
    </style>
@endsection

@section('page-heading')
    <h1>Empresa</h1>
@endsection

@section('container')

    <div data-widget-group="group1" data-parsley-validate>
        <div class="row">
            <div class="col-sm-12">

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <em> {!! session('message') !!}</em>
                    </div>
                @endif

                @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Cadastrar Empresa</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    {!! Form::open(['route'=>'softage.company.store', 'method' => "POST",'id' => 'formCompany', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data']) !!}
                    <div class="panel-body">
                        @include('tamplatesForms.tamplateFormCompany')
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn" style="margin-left: -11px">Salvar</button>
                                <a class="btn-default btn" href="{{ route('softage.company.index')}}">Voltar</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection



@section('js')
    @parent

    <script>
	window.ParsleyConfig = {
    	  successClass: 'has-success'
		, errorClass: 'has-error'
		, errorElem: '<span></span>'
		, errorsWrapper: '<span class="help-block"></span>'
		, errorTemplate: "<div></div>"
		, classHandler: function(el) {
    		return el.$element.closest(".formCompany");
		}
	};
 
 
    

</script>

<script type="text/javascript" src="{{ asset('assets/plugins/form-parsley/parsley.js')}}"></script>

<script>
// See Docs
$(document).ready(function () {
    //    Normally no JS is required to initialize parsley, however
    //    we will use it to do a faux-validation
    //    Do see the docs for configuration options

    $('#formCompany .btn').on('click', function () {
        $('#formCompany').parsley().validate();
      });
    });
</script>   
    
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);
    </script>

 @endsection




