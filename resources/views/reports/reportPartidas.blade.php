@extends('menu')

@section('page-heading')
    <h1>Relatórios</h1>
@endsection

@section('css')
    @parent
    <style>
        .table-responsive {
            min-height: 0.01%;
            overflow-x: initial;
        }

        .campeonato {
            color: #696969;
            font-size: 20px;
            text-align: center;
            background-color: #C0C0C0;
        }

        .resultado {
            background-color: #DCDCDC;
            font-size: 16px;
            text-align: center;
        }

        .row {
            margin-bottom: 30px;;
        }
    </style>
@endsection

@section('container')

    <div data-widget-group="group1">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Lista de Resultados</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>'betting.report.getReportPartidas', 'method' => "GET", "class" => "form-inline"]) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('data_inicio', 'Início') !!}
                                        {!! Form::text('data_inicio', $datas['dataInicio'] ?? "", array('class' => 'form-control date datepicker')) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('data_fim', 'Fim') !!}
                                        {!! Form::text('data_fim', $datas['dataFim'] ?? "", array('class' => 'form-control date datepicker')) !!}
                                    </div>

                                    <div class="form-group">
                                        <button class="btn-sm btn-primary" type="submit">Pesquisar</button>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        <div class="row">
                            <div class="col-md-8">
                                @if(isset($rows))
                                <div class="table-responsive no-padding">
                                    <table id="report-partidas-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        @foreach($rows as $row)
                                            <tr>
                                                <td class="campeonato" colspan="2">{{ $row['nome']  }}</td>
                                            </tr>
                                            @foreach($row['partidas'] as $partida)
                                                <tr>
                                                    <td class="resultado">{{ $partida->data  }}</td>
                                                    <td class="resultado">{{ $partida->time_casa  }} {{ $partida->gols_casa  }} x {{ $partida->gols_fora  }} {{ $partida->time_fora  }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </table>
                                </div>
                                @endif
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
    <script type="text/javascript">
    </script>
@endsection