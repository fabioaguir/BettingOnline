<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Http\Requests;
use Softage\Http\Controllers\Controller;
use Softage\Repositories\TipoCotacaoRepository;
use Yajra\Datatables\Datatables;
use Softage\Uteis\SerbinarioDateFormat;

class SeteSorteController extends Controller
{

    /**
     * @var TipoCotacaoRepository
     */
    private $TipoCotacaoRepository;
    
    /**
     * DefaultController constructor.
     * @param TipoCotacaoRepository $TipoCotacaoRepository
     */
    public function __construct(TipoCotacaoRepository $TipoCotacaoRepository)
    {
        $this->TipoCotacaoRepository = $TipoCotacaoRepository;
    }
    
    public function index()
    {
        return view('seteSorte.index');
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function dashboard(Request $request)
    {

        $dados = $request->request->all();
        
        if(isset($dados['dataInicio']) && isset($dados['dataFim'])) {
            $dataInicio = SerbinarioDateFormat::toUsa($dados['dataInicio'], 'date');
            $dataFim    = SerbinarioDateFormat::toUsa($dados['dataFim'], 'date');
        } else {
            $dateObj = new \DateTime('now');
            $dataInicio = $dateObj->format('Y-m-d');
            $dataFim = $dateObj->format('Y-m-d');
        }

        #Criando a consulta de Gols
        $rows = \DB::table('partidas')
            ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
            ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
            ->join('campeonatos', 'campeonatos.id', '=', 'partidas.campeonato_id')
            ->join('status', 'status.id', '=', 'partidas.status_id')
            ->leftJoin('apostas', 'apostas.partida_id', '=', 'partidas.id')
            ->groupBy('apostas.partida_id', 'partidas.id', 'time_casa.id', 'time_fora.id', 'campeonatos.id', 'status.id')
            ->whereBetween('partidas.data', array($dataInicio, $dataFim))
            ->where('partidas.sete_da_sorte', '=', true)
            ->select([
                'partidas.id as id',
                \DB::raw("concat(time_casa.nome,' x ',time_fora.nome) as partida"),
                \DB::raw("count(apostas.id) as qtd_apostas"),
                'campeonatos.nome as campeonato',
                'partidas.hora as hora',
                'status.nome as status',
                'status.id as status_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('casa', function ($row) {

            $q1 = \DB::table('cotacoes')
                ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
                ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
                ->where('modalidades.t_casa', '=', 'true')
                ->where('partidas.id', '=', $row->id)
                ->select('cotacoes.valor')->first();

            if (count($q1) > 0) {
                return $q1->valor;
            } else {
                return "";
            }

        })
            ->addColumn('fora', function ($row) {

                $q1 = \DB::table('cotacoes')
                    ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
                    ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
                    ->where('modalidades.t_fora', '=', 'true')
                    ->where('partidas.id', '=', $row->id)
                    ->select('cotacoes.valor')->first();

                if (count($q1) > 0) {
                    return $q1->valor;
                } else {
                    return "";
                }

            })
            ->addColumn('empate', function ($row) {

                $q1 = \DB::table('cotacoes')
                    ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
                    ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
                    ->where('modalidades.t_empate', '=', 'true')
                    ->where('partidas.id', '=', $row->id)
                    ->select('cotacoes.valor')->first();

                if (count($q1) > 0) {
                    return $q1->valor;
                } else {
                    return "";
                }

            })->make(true);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function resultadosVendas(Request $request)
    {
        $dados = $request->request->all();

        if(isset($dados['dataInicio']) && isset($dados['dataFim'])) {
            $dataInicio = SerbinarioDateFormat::toUsa($dados['dataInicio'], 'date');
            $dataFim    = SerbinarioDateFormat::toUsa($dados['dataFim'], 'date');
        } else {
            $dateObj = new \DateTime('now');
            $dataInicio = $dateObj->format('Y-m-d');
            $dataFim = $dateObj->format('Y-m-d');
        }

        $vendasRealizadas = \DB::table('vendas')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->where('vendas.status_v_id', '=', '1')
            ->where('vendas.tipo_aposta_id', '=', '3')
            ->whereBetween('vendas.data', array($dataInicio, $dataFim))
            ->select([
                \DB::raw("count(vendas.id) as vendas_r"),
            ])->get();

        $vendasCanceladas = \DB::table('vendas')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->where('vendas.status_v_id', '=', '2')
            ->where('vendas.tipo_aposta_id', '=', '3')
            ->whereBetween('vendas.data', array($dataInicio, $dataFim))
            ->select([
                \DB::raw("count(vendas.id) as vendas_c"),
            ])->get();

        return array('vendas_r' => $vendasRealizadas, 'vendas_c' => $vendasCanceladas);
    }
}
