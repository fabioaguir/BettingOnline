<div class="row">
	<div class="col-md-12">
		<div class="row">
            <div class="col-md-2">
            <div class="form-group">
                <?php $data = new \DateTime('now') ?>
                <?php $dataInicio =  isset($request['data_inicio']) ? $request['data_inicio'] : ""; ?>
				{!! Form::label('nome', 'Início') !!}
				{!! Form::text('data_inicio', $dataInicio , array('class' => 'form-control date')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php $dataFim =  isset($request['data_fim']) ? $request['data_fim'] : ""; ?>
				{!! Form::label('cpnj', 'Fim') !!}
				{!! Form::text('data_fim', $data->format('d/m/Y') , array('class' => 'form-control date')) !!}
                </div>
            </div>
            <div class="form-group col-md-4">
                <?php $area =  isset($request['area']) ? $request['area'] : ""; ?>
                {!! Form::label('area', 'Área ') !!}
                {!! Form::select('area', (['0' => 'Todas'] + $loadFields['areas']->toArray()), $area,array('class' => 'form-control', 'id' => 'area')) !!}
            </div>
            <div class="form-group col-md-4">
                <?php $vendedor =  isset($request['vendedor']) ? $request['vendedor'] : ""; ?>
                {!! Form::label('vendedor', 'Vendedor ') !!}
                {!! Form::select('vendedor', (['0' => 'Todos'] + $loadFields['vendedor']->toArray()), $vendedor, array('class' => 'form-control', 'id' => 'vendedor')) !!}
            </div>
		</div>
        <div class="row">
            <div class="form-group col-md-2">
                <?php $premiacao =  isset($request['premiacao']) ? (int) $request['premiacao'] : "";?>
                {!! Form::label('premiacao', 'Premiado ') !!}
                {!! Form::select('premiacao', (['0' => 'Ambos'] + $loadFields['premiacoes']->toArray()), $premiacao, array('class' => 'form-control', 'id' => 'premiacao')) !!}
            </div>
            <div class="form-group col-md-2">
                <?php $status =  isset($request['status']) ? $request['status'] : ""; ?>
                {!! Form::label('status', 'Status ') !!}
                {!! Form::select('status', (['0' => 'Ambos'] + $loadFields['statusvendas']->toArray()), $status,array('class' => 'form-control', 'id' => 'status')) !!}
            </div>
        </div>
	</div>
    {{--Fim Buttons Submit e Voltar--}}
</div>
<div class="row">
    <div class="col-sm-8">
        <button type="submit" class="btn-primary btn">Consultar</button>
    </div>
</div>
<br />
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
                <td style="background-color: darkgrey; color: white"></b>@if(isset($sum[0]->total)) <b>{{$sum[0]->total}} </b> @endif</td>
                <td style="background-color: darkgrey; color: white">@if(isset($sum[0]->total)) <b>{{$sum[0]->tot_retorno}} </b> @endif</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
        <div class="table-responsive no-padding">
            <table id="partidas-grid" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>SEQ</th>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Data</th>
                    <th>Informação</th>
                    <th>Valor de vendas</th>
                    <th>Retorno</th>
                    <th>Premiada</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($consulta))
                    @foreach($consulta as $venda)
                        <tr>
                            <td><a href="{{route('betting.report.cumpomVenda', ['d' => $venda->id])}}" target="__blank">{{$venda->seq}}</a></td>
                            <td>{{$venda->area_nome}}</td>
                            <td>{{$venda->vendedor_nome}}</td>
                            <td>{{$venda->data}}</td>
                            <td>{{$venda->obs}}</td>
                            <td>{{$venda->valor_total}}</td>
                            <td>{{$venda->retorno}}</td>
                            <td>{{$venda->premiacao_nome}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>SEQ</th>
                    <th>Área</th>
                    <th>Vendedor</th>
                    <th>Data</th>
                    <th>Informação</th>
                    <th>Valor de vendas</th>
                    <th>Retorno</th>
                    <th>Premiada</th>
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
    <script type="text/javascript">

    </script>
@endsection