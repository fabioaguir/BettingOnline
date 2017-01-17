<html>
<head>
    <meta charset="UTF-8" />
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
        table , tr , td {
            font-size: small;
        }
    </style>
    <link href="" rel="stylesheet" media="screen">
</head>

<body>
<p>
    @if($parametros[0]->status == true) {{$parametros[0]->nome_banca}} @endif <br />
    {{$venda[0]->nome_area}}
</p>
---------------------------------------------
<p>
    Data: {{$venda[0]->data}} <br />
    Vendedor: {{$venda[0]->vendedor}}
</p>
---------------------------------------------
@if($venda[0]->status_id == '2')
    <p>
        Venda {{$venda[0]->status_nome}} <br />
    </p>
    ---------------------------------------------
@endif
@foreach($apostas as $aposta)
    <p>
        {{$aposta->time_casa}} X {{$aposta->time_fora}} <br />
        {{$aposta->data}} {{$aposta->hora}} <br />
        {{$aposta->nome_modalidade}} -
        @if($venda[0]->tipo_id == '1')
            {{-- <?php $total = $aposta->valor_aposta * $aposta->valor_cotacao; ?>--}}
            {{$aposta->valor_cotacao}} <br />
        @elseif($venda[0]->tipo_id == '2')
            {{$aposta->valor_cotacao}} <br />
        @endif
    </p>
    ---------------------------------------------
@endforeach
<p>
    Total Apostado: {{$venda[0]->total}} <br />
    Total Retorno: {{$venda[0]->retorno}} <br />
    SEQ: {{$venda[0]->seq}} <br />
    CHAVE: <br />
    INFO: {{$venda[0]->info}}
</p>
---------------------------------------------
<p>
    {{$parametros[0]->mensagen_rodape}} <br />
</p>
</body>
</html>