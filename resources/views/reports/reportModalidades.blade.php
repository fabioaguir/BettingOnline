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

<center><h3>MODALIDADES</h3></center>

<table id="" class="" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Modalidade</th>
        <th>Cotação</th>
    </tr>
    </thead>
    <tbody>
    @foreach($modalidades as $modalidade)
        <tr>
            <td>{{$modalidade->nome}}</td>
            <td>{{$modalidade->limite_cotacao}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Modalidade</th>
        <th style="width: 8%">Cotação</th>
    </tr>
    </tfoot>
</table>

</body>
</html>