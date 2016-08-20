<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
    <style type="text/css" class="init">

        body {
            font-family: arial;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table, tr, td {
            font-size: small;
        }
    </style>
    <link href="" rel="stylesheet" media="screen">
</head>
<body>

<center><h3>RELATÓRIO DE ARRECADAÇÕES</h3></center>

<table class="" cellspacing="0" width="30%">
    <thead>
    <tr>
        <th style="background-color: grey; color: white">Total de vendas</th>
        <th style="background-color: grey; color: white">Total arrecadado</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="total-vendido" style="background-color: darkgrey; color: white">{{$sum[0]->total_vendido}}</td>
        <td class="total-retorno" style="background-color: darkgrey; color: white">{{$sum[0]->total_arrecadado}}</td>
    </tr>
    </tbody>
</table>
<br/>
<table id="" class="" cellspacing="0" width="100%">
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

</body>
</html>