<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;
use Softage\Http\Requests;
use Softage\Services\PartidasService;
use Yajra\Datatables\Datatables;

class ReportPartidasController extends Controller
{
    /**
     * @var PartidasService
     */
    private $service;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var array
     */
    private $loadFields = [
        'Campeonatos'
    ];

    /**
     * ReportPartidasController constructor.
     * @param PartidasService $service
     */
    public function __construct(PartidasService $service)
    {
        $this->service = $service;
    }



    /**
     * @return mixed
     */
    public function getReportPartidas(Request $request)
    {
        # Array de resposta
        $rows = [];

        # Tratando os parametros
        $dataInicio = $request->get('data_inicio') ?? null;
        $dataFim    = $request->get('data_fim') ?? null;

        # Array de datas
        $datas = [
            'dataInicio' => $dataInicio,
            'dataFim'    => $dataFim
        ];

        #Criando a consulta de campeonatos
        $campeonatos = \DB::table('campeonatos')->select(['id', 'nome'])->get();

        # Percorrendo o array de campeonatos
        $count = 0;
        foreach ($campeonatos as $campeonato) {
            # Criando a query de partidas
            $queryPartidas =  \DB::table('partidas')
                ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
                ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
                ->join('campeonatos', 'campeonatos.id', '=', 'partidas.campeonato_id')
                ->where('campeonatos.id', $campeonato->id)
                ->select([
                    \DB::raw("TO_CHAR(partidas.data, 'DD/MM/YYYY') as data"),
                    'time_casa.nome as time_casa',
                    'time_fora.nome as time_fora',
                    'campeonatos.nome as campeonato',
                    \DB::raw("(SELECT COUNT(gols.id) FROM gols WHERE gols.partida_id = partidas.id AND gols.time_id = time_casa.id) as gols_casa"),
                    \DB::raw("(SELECT COUNT(gols.id) FROM gols WHERE gols.partida_id = partidas.id AND gols.time_id = time_fora.id) as gols_fora")
                ]);

            # Validando a condição do período
            if($dataInicio && $dataFim) {
                $queryPartidas->where('partidas.data', '>=', $dataInicio)->where('partidas.data', '<=', $dataFim);
            }

            # Preenchendo o array
            $rows[$count]['nome'] = $campeonato->nome;
            $rows[$count]['partidas'] = $queryPartidas->get();

            # Incrementando o contador
            $count++;
        }

        #Retorno para view
        return view('reports.reportPartidas', compact('rows', 'datas'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportPartidasView()
    {
        #Retorno para view
        return view('reports.reportPartidas');
    }
}
