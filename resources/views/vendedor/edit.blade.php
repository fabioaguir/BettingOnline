@extends('menu')

@section('css')
    @parent
    <style>
        .form-group {
            margin-top: -10px;;
        }
        table.dataTable tbody th, table.dataTable tbody td {
            padding: 2px 10px;
        }
        .table-responsive {
            min-height: 0.01%;
            overflow-x: initial;
        }
    </style>
@endsection

@section('page-heading')
    <h1>Vendedores</h1>
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
                        <h2>Editar vendedor</h2>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>

                    <div class="panel-body">
                        @include('tamplatesForms.tamplateFormVendedorEdit')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script type="text/javascript">
        var elem = document.querySelector('.js-switch-info');
        var init = new Switchery(elem);

        var table = $('#confg-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('betting.vendedor.gridConfig', ['id' => $model->id]) }}",
            language: {
                "lengthMenu": "_MENU_"
            },
            columns: [
                {data: 'vendas', name: 'conf_vendas.limite_vendas'},
                {data: 'comissao', name: 'conf_vendas.comissao'},
                {data: 'cotacao', name: 'conf_vendas.cotacao'},
                {data: 'tipo', name: 'tipo_cotacao.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('.dataTables_filter input').attr('placeholder','Pesquisar...');

        //Retonra o id do registro
        $('#confg-grid tbody').on( 'click', '.edit', function (event) {
            event.preventDefault();

            if ($(this).parent().parent().hasClass('selected')) {
                $(this).parent().parent().removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).parent().parent().addClass('selected');
            }
            var data = table.rows('.selected').data()[0];

            console.log( data );
        } );

    </script>
@endsection