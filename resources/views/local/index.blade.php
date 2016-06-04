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
                {{--<div class="alert alert-info alert-dismissable ">
                    <i class="ti ti-info-alt"></i> Resize the browser window to see the responive tables in action!
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>--}}

                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                            <a href="{{ route('softage.local.create')}}" class="btn btn-primary">Novo Local</a>
                        <div class="panel-ctrls" data-actions-container=""
                             data-action-collapse='{"target": ".panel-body"}'></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive no-padding">
                            <table id="gues-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Nome</th>
                                </tr>
                                </tfoot>
                            </table>
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

        var table = $('#gues-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('softage.local.grid') !!}",
            columns: [
                {data: 'local_name', name: 'local_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        /*//Seleciona uma linha
         $('#crud-grid tbody').on( 'click', 'tr', function () {
         if ( $(this).hasClass('selected') ) {
         $(this).removeClass('selected');
         }
         else {
         table.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         }
         } );

         //Retonra o id do registro
         $('#crud-grid tbody').on( 'click', 'tr', function () {

         var rows = table.row( this ).data()

         console.log( rows.id );
         } );*/

    </script>
@endsection