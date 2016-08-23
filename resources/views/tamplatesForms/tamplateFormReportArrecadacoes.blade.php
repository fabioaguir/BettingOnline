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
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('arrecadador', 'Arrecadador') !!}
                    {!! Form::text('arrecadador', null , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="exportar">Exportar </label>
                <select id="exportar" class="form-control" name="exportar">
                    <option value="">Nenhum</option>
                    <option value="1">PDF</option>
                    <option value="2">Excel</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" style="margin-top: -5px;"  class="btn-primary btn search">Consultar</button>
            </div>
            <div class="col-sm-2">
                <button type="submit" style="margin-top: -5px; margin-left: -70px"  class="btn-danger btn">Exportar</button>
            </div>
            <br/> <br/><br/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <table class="table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th style="background-color: grey; color: white">Total vendido</th>
                <th style="background-color: grey; color: white">Total arrecadado</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="total-vendido" style="background-color: darkgrey; color: white"> </td>
                <td class="total-arrecadado" style="background-color: darkgrey; color: white"> </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
        <div class="table-responsive no-padding">
            <table id="arrecadacoes-grid" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Usuário</th>
                    <th>Valor vendido</th>
                    <th>Valor arrecadado</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Usuário</th>
                    <th style="width: 13%">Valor vendido</th>
                    <th style="width: 13%">Valor arrecadado</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('/js/validacoes/validation_form_reportArrecadacoes.js')}}"></script>
    <script type="text/javascript">
        var table = $('#arrecadacoes-grid').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 20,
            bLengthChange: false,
            bFilter: false,
            ajax: {
                url: "{!! route('betting.report.reportArrecadacoesSearch') !!}",
                method: 'POST',
                data: function (d) {
                    d.data_inicio = $('input[name=data_inicio]').val();
                    d.data_fim = $('input[name=data_fim]').val();
                    d.arrecadador = $('input[name=arrecadador]').val();
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
                {data: 'area_nome', name: 'areas.nome'},
                {data: 'vendedor_nome', name: 'vendedor.nome'},
                {data: 'usuario', name: 'usuario', orderable: false, searchable: false},
                {data: 'valor_vendido', name: 'vendas.valor_total', orderable: false, searchable: false},
                {data: 'valor_arrecadado', name: 'valor_arrecadado.nome', orderable: false, searchable: false}
                //{data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Função do submit do search da grid principal
        $('.search').click(function(e) {
            table.draw();

            var searchData = {
                'data_inicio' : $('#data_inicio').val(),
                'data_fim' : $('#data_fim').val(),
                'arrecadador' : $('#arrecadador').val()
            };

            // Requisição ajax
            jQuery.ajax({
                type: 'POST',
                url: "{!! route('betting.report.reportArrecadacoesSum') !!}",
                data: searchData,
                datatype: 'json'
            }).done(function (jsonResponse) {

                if(!jsonResponse[0]['total_vendido'] && !jsonResponse[0]['total_arrecadado']) {
                    $('td.total-vendido').html(" ");
                    $('td.total-arrecadado').html(" ");
                } else {
                    $('td.total-vendido').html("<b>"+jsonResponse[0]['total_vendido']+"</b>");
                    $('td.total-arrecadado').html("<b>"+jsonResponse[0]['total_arrecadado']+"</b>");
                }

            });

            e.preventDefault();
        });

        $('.dataTables_filter input').attr('placeholder', 'Pesquisar...');

    </script>
@endsection