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

<center><h3>RELATÓRIO DE VENDAS PREMIADAS</h3></center>

<table class="" cellspacing="0" width="30%">
    <thead>
    <tr>
        <th style="background-color: grey; color: white">Total de vendas</th>
        <th style="background-color: grey; color: white">Total de retorno
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="total-vendido" style="background-color: darkgrey; color: white">{{$sum[0]->total_vendido}}</td>
        <td class="total-retorno" style="background-color: darkgrey; color: white">{{$sum[0]->total_retorno}}</td>
    </tr>
    </tbody>
</table>
<br/>
<table id="" class="" cellspacing="0" width="100%">
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
    <tfoot>
    <tr>
        <th style="width: 6%">SEQ</th>
        <th>Área</th>
        <th>Vendedor</th>
        <th>Data</th>
        <th>Informação</th>
        <th style="width: 8%">Venda</th>
        <th style="width: 9%">Retorno</th>
    </tr>
    </tfoot>
</table>

</body>
</html>