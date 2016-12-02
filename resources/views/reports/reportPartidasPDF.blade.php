<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
    <style>
        .campeonato {
            color: #696969;
            font-size: 20px;
            text-align: center;
            background-color: #91ba89;
            border-color: #73a869;
        }

        .resultado {
            background-color: #d7e6d4;
            font-size: 16px;
            text-align: center;
            border-color: #73a869;
        }

        .row {
            margin-bottom: 30px;;
        }
    </style>
    <link href="" rel="stylesheet" media="screen">
</head>
<body>

<center><h3>RELATÓRIO DE RESULTADOS</h3></center>

@if(isset($rows))

    <table id="report-partidas-grid" cellspacing="0" width="100%">
        @foreach($rows as $row)
            <tr>
                <td class="campeonato" colspan="2"><?php echo mb_strtoupper($row['nome'], 'UTF-8') ?></td>
            </tr>
            @foreach($row['partidas'] as $partida)
                <tr>
                    <td class="resultado">{{ $partida->data  }}</td>
                    <td class="resultado">{{ $partida->time_casa  }} {{ $partida->gols_casa  }}
                        x {{ $partida->gols_fora  }} {{ $partida->time_fora  }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>

@endif

</body>
</html>