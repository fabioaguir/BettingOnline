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

<center><h3>RELATÓRIO FINANCEIRO</h3></center>

<table class="" cellspacing="0" width="30%">
    <thead>
    <tr>
        <th style="background-color: grey; color: white">Total Apurado</th>
        <th style="background-color: grey; color: white">Total Comissão</th>
        <th style="background-color: grey; color: white">Total Prêmio</th>
        <th style="background-color: grey; color: white">Total Final</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="total-apurado" style="background-color: darkgrey; color: white"> {{$sum->premiacao}}</td>
        <td class="total-comissao" style="background-color: darkgrey; color: white"> {{$sum->comissao}}</td>
        <td class="total-premio" style="background-color: darkgrey; color: white"> {{$sum->valor_total}}</td>
        <td class="total-final" style="background-color: darkgrey; color: white"> {{$sum->valor_final}}</td>
    </tr>
    </tbody>
</table>
<br/>
<table id="" class="" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Área</th>
        <th>Vendedor</th>
        <th>Apurado</th>
        <th>Comissão</th>
        <th>Prêmio</th>
        <th>Final</th>
    </tr>
    </thead>
    <tbody>
    @foreach($financeiros as $financeiro)
        <tr>
            <td>{{ $financeiro->nome }}</td>
            <td>{{ $financeiro->nome_area }}</td>
            <td>{{ number_format($financeiro->premiacao, 2, ',', '.') }}</td>
            <td>{{ number_format($financeiro->comissao, 2, ',', '.') }}</td>
            <td>{{ number_format($financeiro->valor_total, 2, ',', '.') }}</td>
            <td>{{ number_format($financeiro->valor_final, 2, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Área</th>
        <th>Vendedor</th>
        <th style="width: 13%">Apurado</th>
        <th style="width: 13%">Comissão</th>
        <th style="width: 13%">Prêmio</th>
        <th style="width: 13%">Final</th>
    </tr>
    </tfoot>
</table>

</body>
</html>