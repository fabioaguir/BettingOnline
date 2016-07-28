<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('data_inicio', 'Início') !!}
                    {!! Form::text('data_inicio', null , array('class' => 'form-control date datepicker')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php $data = new \DateTime('now') ?>
                    {!! Form::label('data_fim', 'Fim') !!}
                    {!! Form::text('data_fim', $data->format('d/m/Y') , array('class' => 'form-control date datepicker')) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('area', 'Área') !!}
                    {!! Form::select('area', (['Selecione uma área'] + $loadFields['areas']->toArray()), null, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('vendendor', 'Vendedor') !!}
                    {!! Form::select('vendendor', (['Selecione um vendedor'] + $loadFields['vendedor']->toArray()), null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" style="margin-top: 18px" class="btn-primary btn search">Consultar</button>
            </div>
            <br/> <br/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <table class="table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th style="background-color: grey; color: white">Total Apurado</th>
                <th style="background-color: grey; color: white">Total Comissão</th>
                <th style="background-color: grey; color: white">Total Prêmio</th>
                <th style="background-color: grey; color: white">Total Final</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="total-apurado" style="background-color: darkgrey; color: white"> </td>
                <td class="total-comissao" style="background-color: darkgrey; color: white"> </td>
                <td class="total-premio" style="background-color: darkgrey; color: white"> </td>
                <td class="total-final" style="background-color: darkgrey; color: white"> </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
        <div class="table-responsive no-padding">
            <table id="financeiro-grid" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Apurado</th>
                    <th>Comissão</th>
                    <th>Prêmio</th>
                    <th>Final</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th style="width: 13%">Apurado</th>
                    <th style="width: 13%">Comissão</th>
                    <th style="width: 13%">Prêmio</th>
                    <th style="width: 13%">Final</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@section('js')
    @parent
    <script type="text/javascript">
        var table = $('#financeiro-grid').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            bLengthChange: false,
            bFilter: false,
            ajax: {
                url: "{!! route('betting.report.gridReportFinanceiro') !!}",
                method: 'GET',
                data: function (d) {
                    d.data_inicio = $('input[name=data_inicio]').val();
                    d.data_fim = $('input[name=data_fim]').val();
                    d.vendendor = $('select[name=vendedor]').val();
                    d.area = $('select[name=area]').val();
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
                {data: 'nome_area', name: 'areas.nome'},
                {data: 'nome', name: 'pessoa.nome'},
                {data: 'valor_total', name: 'valor_total', orderable: false, searchable: false},
                {data: 'comissao', name: 'comissao', orderable: false, searchable: false},
                {data: 'premiacao', name: 'premiacao', orderable: false, searchable: false},
                {data: 'valor_final', name: 'valor_final', orderable: false, searchable: false}
                //{data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Função do submit do search da grid principal
        $('.search').click(function(e) {
            table.draw();

            var searchData = {
                'dataInicio' : $('#data_inicio').val(),
                'dataFim' : $('#data_fim').val()
            };

            // Requisição ajax
            jQuery.ajax({
                type: 'POST',
                url: "{!! route('betting.report.reportFinanceiroSum') !!}",
                data: searchData,
                datatype: 'json'
            }).done(function (jsonResponse) {

                if(!jsonResponse.success) {
                    $('td.total-apurado').html(" ");
                    $('td.total-comissao').html(" ");
                    $('td.total-premio').html(" ");
                    $('td.total-final').html(" ");
                } else {
                    $('td.total-apurado').html("<b>"+ jsonResponse.data[0].valor_total+"</b>");
                    $('td.total-comissao').html("<b>"+ jsonResponse.data[0].comissao +"</b>");
                    $('td.total-premio').html("<b>"+ jsonResponse.data[0].premiacao +"</b>");
                    $('td.total-final').html("<b>"+jsonResponse.data[0].valor_final +"</b>");
                }

            });

            e.preventDefault();
        });

        $('.dataTables_filter input').attr('placeholder', 'Pesquisar...');

    </script>
@endsection