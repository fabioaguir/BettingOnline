<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="searchDate">Data</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input class="form-control mask datepicker" data-inputmask="'alias': 'date'" type="text"
                                   id="searchDate">
                            <div class="input-group-btn">
                                <button class="btn btn-info" id="btnSearch" type="button">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('partida', 'Partida', array('class' => 'col-sm-1 control-label')) !!}
                    <div class="col-sm-4">
                        {!! Form::select('partida', array(), null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <br/> <br/>
            </div>
        </div>
    </div>
</div>
<div class="row">
    {{--<div class="col-sm-4 col-md-offset-8">
        <table class="table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th style="background-color: grey; color: white">Total de vendas</th>
                <th style="background-color: grey; color: white">Total de retorno</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="background-color: darkgrey; color: white"></b>@if(isset($sum[0]->total)) <b>{{$sum[0]->total}} </b> @endif</td>
                <td style="background-color: darkgrey; color: white">@if(isset($sum[0]->total)) <b>{{$sum[0]->tot_retorno}} </b> @endif</td>
            </tr>
            </tbody>
        </table>
    </div>--}}
    <div class="col-sm-12">
        <div class="table-responsive no-padding">
            <table id="apostas-grid" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>SEQ</th>
                    <th>Data</th>
                    <th>Vendedor</th>
                    <th>Tipo</th>
                    <th>Modalidade</th>
                    <th>Apostado</th>
                    <th>Cotação</th>
                    <th>Prêmio</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>SEQ</th>
                    <th>Data</th>
                    <th>Vendedor</th>
                    <th>Tipo</th>
                    <th>Modalidade</th>
                    <th>Apostado</th>
                    <th>Cotação</th>
                    <th>Prêmio</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-md-offset-5">
        @if(isset($consulta))
            {!!  $consulta->render() !!}
        @endif
    </div>
</div>
@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('js/reports/apostas.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_reportVendas.js')}}"></script>
    <script type="text/javascript">

        var table = $('#apostas-grid').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            bFilter: false,
            ajax: {
                url: "{!! route('betting.report.reportApostasSearch') !!}",
                method: 'POST',
                data: function (d) {
                    d.partida = $('select[name=partida] option:selected').val();
                }
            },
            language: {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Não foram encontrados resultados",
                "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando de 0 até 0 de 0 registros",
                "infoFiltered": "(Filtrado de _MAX_ total de registro)",
                "sProcessing":   "Processando...",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Seguinte",
                    "sLast":     "Último"
                }
            },
            columns: [
                {data: 'seq', name: 'vendas.seq'},
                {data: 'data', name: 'vendas.data'},
                {data: 'vendedor_nome', name: 'pessoas.nome'},
                {data: 'tipo', name: 'tipo_apostas.nome'},
                {data: 'nome_modalidade', name: 'modalidades.nome'},
                {data: 'valor', name: 'apostas.valor'},
                {data: 'cotacao', name: 'cotacoes.valor'},
                {data: 'retorno', name: 'vendas.retorno'}
                //{data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Função do submit do search da grid principal
        $('#partida').change(function(e) {
            table.draw();
            e.preventDefault();
        });

        $('.dataTables_filter input').attr('placeholder', 'Pesquisar...');

    </script>
@endsection