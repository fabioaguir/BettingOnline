@extends('menu')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Lista de disciplinas</h5>
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
                    <a href="{{ route('seracademico.disciplina.create')}}" class="btn btn-primary btn-pressure btn-sm btn-sensitive">Nova Disciplina</a><br /><br />
                    <div class="table-responsive no-padding">
                        <table id="disciplina-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Qtd. Faltas</th>
                                <th>Tipo da disciplina</th>
                                <th>Tipo de avaliação</th>
                                <th >Acão</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Qtd. Faltas</th>
                                <th>Tipo da disciplina</th>
                                <th>Tipo de avaliação</th>
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
        var table = $('#disciplina-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('seracademico.disciplina.grid') !!}",
            columns: [
                {data: 'nome', name: 'fac_disciplinas.nome'},
                {data: 'qtd_falta', name: 'fac_disciplinas.qtd_falta'},
                {data: 'tipo_disciplina', name: 'fac_tipo_disciplinas.nome'},
                {data: 'tipo_avaliacao', name: 'fac_tipo_avaliacoes.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@stop