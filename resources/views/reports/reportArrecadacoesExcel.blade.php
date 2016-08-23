<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
</head>
<body>

<center><h3>RELATÓRIO DE ARRECADAÇÕES</h3></center>

<table>
    <thead>
    <tr>
        <th>Total de vendas</th>
        <th>Total arrecadado</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$sum[0]->total_vendido}}</td>
        <td>{{$sum[0]->total_arrecadado}}</td>
    </tr>
    </tbody>
</table>
<br/>
<table>
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
    @foreach($arrecadacoes as $arrecadacao)
        <tr>
            <td>{{$arrecadacao->area_nome}}</td>
            <td>{{$arrecadacao->vendedor_nome}}</td>
            <td>{{$arrecadacao->usuario}}</td>
            <td>{{$arrecadacao->valor_vendido}}</td>
            <td>{{$arrecadacao->valor_arrecadado}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>