@extends('menu')

@section('title')
    @parent
    HOME
@endsection

@section('css')
    @parent

@endsection

@section('page-heading')
    <h1>Responsive Tables</h1>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-sm-12">
                {{--<div class="alert alert-info alert-dismissable ">
                    <i class="ti ti-info-alt"></i> Resize the browser window to see the responive tables in action!
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>--}}

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Horizontal Tables</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        <p>Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>
                            to make them scroll horizontally up to small devices (under 768px)</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent

@endsection