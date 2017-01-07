<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Http\Requests;
use Softage\Http\Controllers\Controller;
use Softage\Repositories\TipoCotacaoRepository;
use Yajra\Datatables\Datatables;
use Softage\Uteis\SerbinarioDateFormat;

class DefaultController extends Controller
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
        return view('default.index');
    }

    public function allTipoCotacao()
    {
        
        $tipoCotacaoes = $this->TipoCotacaoRepository->all();
        
        return compact('tipoCotacaoes');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function dashboard(Request $request)
    {

        $dados = $request->request->all();
        
        if(isset($dados['searchDate']) && $dados['searchDate'] != "") {
            $data = SerbinarioDateFormat::toUsa($dados['searchDate'], 'date');
        } else {
            $dateObj = new \DateTime('now');
            $data = $dateObj->format('Y-m-d');
        }

        #Criando a consulta de Gols
        $rows = \DB::table('partidas')
            ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
            ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
            ->join('campeonatos', 'campeonatos.id', '=', 'partidas.campeonato_id')
            ->leftJoin('processadas', 'processadas.id', '=', 'partidas.processada_id')
            ->leftJoin('apostas', 'apostas.partida_id', '=', 'partidas.id')
            ->leftJoin('vendas', 'apostas.venda_id', '=', 'vendas.id')
            ->groupBy('apostas.partida_id', 'partidas.id', 'time_casa.id', 'time_fora.id', 'campeonatos.id', 'processadas.id', 'vendas.id')
            ->whereDate('partidas.data', '=', $data)
            ->select([
                'partidas.id as id',
                \DB::raw("concat(time_casa.nome,' x ',time_fora.nome) as partida"),
                \DB::raw("(CASE vendas.status_v_id WHEN 1 THEN count(apostas.id) END ) as qtd_apostas"),
                //\DB::raw("count(apostas.id) as qtd_apostas"),
                'campeonatos.nome as campeonato',
                'partidas.hora as hora',
                'processadas.nome as status',
                'processadas.id as status_id',
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

        if(isset($dados['searchDate']) && $dados['searchDate'] != "") {
            $data = SerbinarioDateFormat::toUsa($dados['searchDate'], 'date');
        } else {
            $dateObj = new \DateTime('now');
            $data = $dateObj->format('Y-m-d');
        }

        $vendasRealizadas = \DB::table('vendas')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->where('vendas.status_v_id', '=', '1')
            ->whereDate('vendas.data', '=', $data)
            ->select([
                \DB::raw("count(vendas.id) as vendas_r"),
            ])->get();

        $vendasCanceladas = \DB::table('vendas')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->where('vendas.status_v_id', '=', '2')
            ->whereDate('vendas.data', '=', $data)
            ->select([
                \DB::raw("count(vendas.id) as vendas_c"),
            ])->get();

        return array('vendas_r' => $vendasRealizadas, 'vendas_c' => $vendasCanceladas);
    }
}
