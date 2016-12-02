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

<center><h3>RELATÓRIO DE APOSTAS x PARTIDAS</h3></center>

<table id="" class="" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>SEQ</th>
        <th>Data</th>
        <th>Vendedor</th>
        <th>Tipo</th>
        <th>Modalidade</th>
        <th>Apostado</th>
        <th>Cotação</th>
        <th>Prêmio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($apostas as $aposta)
        <tr>
            <td>{{$aposta->seq}}</td>
            <td>{{$aposta->data}}</td>
            <td>{{$aposta->vendedor_nome}}</td>
            <td>{{$aposta->tipo}}</td>
            <td>{{$aposta->nome_modalidade}}</td>
            <td>{{$aposta->valor}}</td>
            <td>{{$aposta->cotacao}}</td>
            <td>{{$aposta->retorno}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th style="width: 8%">SEQ</th>
        <th>Data</th>
        <th>Vendedor</th>
        <th style="width: 10%">Tipo</th>
        <th style="width: 15%">Modalidade</th>
        <th style="width: 10%">Apostado</th>
        <th style="width: 10%">Cotação</th>
        <th style="width: 10%">Prêmio</th>
    </tr>
    </tfoot>
</table>

</body>
</html>