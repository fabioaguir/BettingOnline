<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
</head>
<body>

<center><h3>RELATÓRIO DE APOSTAS x PARTIDAS</h3></center>

<table>
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
</table>

</body>
</html>