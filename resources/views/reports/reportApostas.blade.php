@extends('menu')

@section('css')
    @parent
    <style>
        .form-group {
            margin-top: -10px;;
        }
        .table-responsive {
            min-height: 0.01%;
            overflow-x: initial;
        }
    </style>
@endsection

@section('page-heading')
    <h1>Relatórios</h1>
@endsection

@section('container')

    <div data-widget-group="group1">
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
                        <h2>Apostas x Partidas</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>'betting.report.reportVendasSearch', 'method' => "POST", 'class' => 'form-horizontal row-border', 'id' => 'formReportVendas']) !!}
                        @include('tamplatesForms.tamplateFormReportApostas')
                        {!! Form::close() !!}
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection