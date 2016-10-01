<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
</head>
<body>

<center><h3>RELATÓRIO DE VENDAS PREMIADAS</h3></center>

<table>
    <thead>
    <tr>
        <th >Total de vendas</th>
        <th >Total de retorno
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td >{{$sum[0]->total_vendido}}</td>
        <td >{{$sum[0]->total_retorno}}</td>
    </tr>
    </tbody>
</table>
<br/>
<table>
    <thead>
    <tr>
        <th>SEQ</th>
        <th>Área</th>
        <th>Vendedor</th>
        <th>Data</th>
        <th>Informação</th>
        <th>Venda</th>
        <th>Retorno</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vendas as $venda)
        <tr>
            <td>{{$venda->seq}}</td>
            <td>{{$venda->area_nome}}</td>
            <td>{{$venda->vendedor_nome}}</td>
            <td>{{$venda->data}}</td>
            <td>{{$venda->obs}}</td>
            <td>{{$venda->valor_total}}</td>
            <td>{{$venda->retorno}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>