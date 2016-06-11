@extends('menu')

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

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <em> {!! session('message') !!}</em>
                    </div>
                @endif

                @if (isset($return) && $return !=  null)
                    @if($return['success'] == false && isset($return[0]['fields']) &&  $return[0]['fields'] != null)
                        <div class="alert alert-warning">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($return[0]['fields'] as $nome => $erro)
                                {{ $erro }}<br>
                            @endforeach
                        </div>
                    @elseif($return['success'] == false)
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $return['message'] }}<br>
                        </div>
                    @elseif($return['success'] == true)
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $return['message'] }}<br>
                        </div>
                    @endif
                @endif

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Horizontal Tables</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">

                        {!! Form::model($model, ['route'=> ['softage.local.edit', $model->id], 'id' => 'formLocal', 'enctype' => 'multipart/form-data']) !!}
                        @include('tamplatesForms.tamplateFormLocal')
                        {{--<a href="{{ route('softage.local.edit', ['id' => $crud->id]) }}" target="_blank" class="btn btn-info">Contrato</a>--}}
                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript">

    </script>
@endsection