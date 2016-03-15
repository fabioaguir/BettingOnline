@extends('menu')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Lista de Salas</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('seracademico.sala.create')}}" class="btn btn-primary btn-pressure btn-sm btn-sensitive">Nova Sala</a><br /><br />
                    <div class="table-responsive no-padding">
                        <table id="sala-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Bloco</th>
                                <th>Andar</th>
                                <th>Número</th>
                                <th>Capacidade</th>
                                <th >Acão</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Bloco</th>
                                <th>Andar</th>
                                <th>Número</th>
                                <th>Capacidade</th>
                                <th style="width: 10%;">Acão</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox-footer">
            <span class="pull-right">
                The righ side of the footer
            </span>
            This is simple footer example
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        var table = $('#sala-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('seracademico.sala.grid') !!}",
            columns: [
                {data: 'nome', name: 'nome'},
                {data: 'bloco', name: 'bloco'},
                {data: 'andar', name: 'andar'},
                {data: 'numero', name: 'numero'},
                {data: 'capacidade', name: 'capacidade'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@stop