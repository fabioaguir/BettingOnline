<div class="row">
	<div class="col-md-12">
		<div class="row">
            <div class="col-md-2">
            <div class="form-group">
                <?php $data = new \DateTime('now') ?>
                <?php $dataInicio =  isset($request['data_inicio']) ? $request['data_inicio'] : ""; ?>
				{!! Form::label('data_inicio', 'Início') !!}
				{!! Form::text('data_inicio', $dataInicio , array('class' => 'form-control date datepicker')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php $dataFim =  isset($request['data_fim']) ? $request['data_fim'] : ""; ?>
				{!! Form::label('data_fim', 'Fim') !!}
				{!! Form::text('data_fim', $data->format('d/m/Y') , array('class' => 'form-control date datepicker')) !!}
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" style="margin-top: 18px" id="search" class="btn-primary btn">Consultar</button>
            </div>
		</div>
        <div class="row">
            <div class="form-group col-md-2">
                <label for="exportar">Exportar </label>
                <select id="exportar" class="form-control" name="exportar">
                    <option value="1">PDF</option>
                    <option value="2">Excel</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" style="margin-top: 18px; margin-left: -8px" class="btn-danger btn">Exportar</button>
            </div><br />
        </div>
	</div>
    {{--Fim Buttons Submit e Voltar--}}
</div>
<div class="row">
    <div class="col-sm-4 col-md-offset-8">
        <table class="table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th style="background-color: grey; color: white">Total de vendas</th>
                <th style="background-color: grey; color: white">Total de retorno</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="total-vendido" style="background-color: darkgrey; color: white"></td>
                <td class="total-retorno" style="background-color: darkgrey; color: white"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
        <div class="table-responsive no-padding">
            <table id="vendas-grid" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>SEQ</th>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Data</th>
                    <th>Informação</th>
                    <th>Venda</th>
                    <th>Retorno</th>
                    {{--<th>Premiada</th>--}}
                    {{--<th>Ação</th>--}}
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th style="width: 6%">SEQ</th>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Data</th>
                    <th>Informação</th>
                    <th style="width: 8%">Venda</th>
                    <th style="width: 9%">Retorno</th>
                    {{--<th style="width: 9%">Premiada</th>--}}
                    {{--<th  style="width: 7%">Ação</th>--}}
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@section('js')
    @parent
    {{--<script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_reportVendasPremiadas.js')}}"></script>--}}
    <script type="text/javascript">
        var table = $('#vendas-grid').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            bLengthChange: false,
            bFilter: true,
            ajax: {
                url: "{!! route('betting.report.reportVendasPremiadasSearch') !!}",
                method: 'POST',
                data: function (d) {
                    d.data_inicio = $('input[name=data_inicio]').val();
                    d.data_fim = $('input[name=data_fim]').val();
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
                {data: 'seq', name: 'seq', orderable: false, searchable: false},
                {data: 'area_nome', name: 'areas.nome'},
                {data: 'vendedor_nome', name: 'pessoas.nome'},
                {data: 'data', name: 'vendas.data'},
                {data: 'obs', name: 'vendas.obs'},
                {data: 'valor_total', name: 'vendas.valor_total'},
                {data: 'retorno', name: 'vendas.retorno'},
                /*{data: 'premiacao_nome', name: 'premiacoes.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}*/
            ]
        });

        //Função do submit do search da grid principal
        $('#search').click(function(e) {
            table.draw();

            var searchData = {
                'data_inicio' : $('#data_inicio').val(),
                'data_fim' : $('#data_fim').val(),
                'area' : $('select[name=area] option:selected').val(),
                'vendedor' : $('select[name=vendedor] option:selected').val(),
                'premiacao' : $('select[name=premiacao] option:selected').val(),
                'status' : $('select[name=status] option:selected').val()
            };

            var importe  =$('select[name=importar] option:selected').val()

            // Requisição ajax
            jQuery.ajax({
                type: 'POST',
                url: "{!! route('betting.report.reportVendasPremiadasSum') !!}",
                data: searchData,
                datatype: 'json'
            }).done(function (jsonResponse) {

                if(!jsonResponse[0]['total_vendido'] && !jsonResponse[0]['total_retorno']) {
                    $('td.total-vendido').html(" ");
                    $('td.total-retorno').html(" ");
                } else {
                    $('td.total-vendido').html("<b>"+jsonResponse[0]['total_vendido']+"</b>");
                    $('td.total-retorno').html("<b>"+jsonResponse[0]['total_retorno']+"</b>");
                }

            });

            e.preventDefault();
        });

        $('.dataTables_filter input').attr('placeholder', 'Pesquisar...');

        /*$(document).on('click', 'a.cancelar', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            bootbox.confirm("Tem certeza do cancelamento da venda?", function (result) {
                if (result) {
                    location.href = url
                } else {
                    false;
                }
            });
        });*/
    </script>
@endsection