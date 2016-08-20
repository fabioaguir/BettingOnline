<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
</head>
<body>

<center><h3>RELATÓRIO FINANCEIRO</h3></center>

<table>
    <thead>
    <tr>
        <th>Total Apurado</th>
        <th>Total Comissão</th>
        <th>Total Prêmio</th>
        <th>Total Final</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td> {{$sum->premiacao}}</td>
        <td> {{$sum->comissao}}</td>
        <td> {{$sum->valor_total}}</td>
        <td> {{$sum->valor_final}}</td>
    </tr>
    </tbody>
</table>
<br/>
<table>
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
            <td>{{$financeiro->nome}}</td>
            <td>{{$financeiro->nome_area}}</td>
            <td>{{$financeiro->premiacao}}</td>
            <td>{{$financeiro->comissao}}</td>
            <td>{{$financeiro->valor_total}}</td>
            <td>{{$financeiro->valor_final}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>