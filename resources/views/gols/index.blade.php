@extends('menu')

@section('css')
    @parent
<style>
    .table-responsive {
        min-height: 0.01%;
        overflow-x: initial;
    }
</style>
@endsection

@section('page-heading')
    <h1>Gols</h1>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Cadastrar Gol</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['route'=>'betting.gols.store', 'method' => "POST", 'id' => 'formGol', 'class' => 'form-horizontal row-border','enctype' => 'multipart/form-data']) !!}
                                    @include('tamplatesForms.tamplateFormGols')
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-8">
                                <div class="table-responsive no-padding">
                                    <table id="resultado-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center; font-size: 16px; background-color: #C0C0C0">RESULTADO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" style="text-align: center; font-size: 16px; font-weight: bold; background-color: #DCDCDC">
                                                    <span id="time_casa"></span> <span id="gols_casa"></span> x <span id="gols_fora"></span> <span id="time_fora"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive no-padding">
                                    <table id="gols-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Tempo</th>
                                            <th>Minuto</th>
                                            <th>Data</th>
                                            <th>Partida</th>
                                            <th>Time</th>
                                            <th>Acão</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Tempo</th>
                                            <th>Minuto</th>
                                            <th>Data</th>
                                            <th>Partida</th>
                                            <th>Time</th>
                                            <th style="width: 15%;">Acão</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('js/gols/grid.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/gols/resultado.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/gols/gols.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/gols/store.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/gols/destroy.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/gols/conclude.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/gols/controller.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/validacoes/validation_form_gols.js') }}"></script>
@endsection