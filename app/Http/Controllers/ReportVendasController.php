<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Repositories\ParametrosRepository;
use Softage\Services\ReportService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\AreasCreateRequest;
use Softage\Http\Requests\AreasUpdateRequest;
use Yajra\Datatables\Datatables;
use Softage\Uteis\SerbinarioDateFormat;


class ReportVendasController extends Controller
{
    
    /**
     * @var ReportService
     */
    private $service;

    /**
     * @var ParametrosRepository
     */
    private $parametros;

    /**
     * @var $data
     */
    private $data;
    
    /**
     * @var array
     */
    private $loadFields = [
        'Premiacoes',
        'Vendedor',
        'Areas',
        'StatusVendas'
    ];

    public function __construct(ReportService $service, ParametrosRepository $parametros)
    {
        $this->service    = $service;
        $this->parametros = $parametros;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportVendasView()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('reports.reportVendas', compact('loadFields'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportVendasSearch(Request $request)
    {
        $dados = $request->request->all();

        $request->session()->set('dados', $dados);

        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        $consulta = $this->queryVendas($request);
        $sum       = $this->querySum($request);

        #Retorno para view
        return view('reports.reportVendas', compact('loadFields', 'consulta', 'sum', 'request'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportVendasSearchPag(Request $request)
    {
        $request = $request->session()->get('dados');

        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        $consulta = $this->queryVendas($request);
        $sum       = $this->querySum($request);

        #Retorno para view
        return view('reports.reportVendas', compact('loadFields', 'consulta', 'sum', 'request'));
    }

    /**
     * @param $dados
     * @return mixed
     */
    public function queryVendas($dados){

        $this->data = $dados;

        $query = $this->struturaQuery($this->data);

        $consulta = $query->select([
            'vendas.id as id',
            \DB::raw("lpad(vendas.seq::text, 6, '0') as seq"),
            'areas.nome as area_nome',
            'vendedor.nome as vendedor_nome',
            \DB::raw("to_char(vendas.data, 'DD/MM/YYYY') as data"),
            'vendas.obs as obs',
            'vendas.valor_total as valor_total',
            'vendas.retorno as retorno',
            'premiacoes.nome as premiacao_nome',
        ])->paginate(25);

        $consulta->setPath(url('betting/report/reportVendasSearchPag'));

        return $consulta;

    }

    /**
     * @param $dados
     * @return mixed
     */
    public function querySum($dados){

        $this->data = $dados;

        $query = $this->struturaQuery($this->data);

        $sum = $query->select([
            \DB::raw("SUM(vendas.valor_total) as total"),
            \DB::raw("SUM(vendas.retorno) as tot_retorno")
        ])->get();

        return $sum;
    }

    /**
     * @param $dados
     */
    public function struturaQuery($dados){

        $this->data = $dados;

        //Tratando as datas
        $dataIni = SerbinarioDateFormat::toUsa($this->data['data_inicio'], 'date');
        $dataFim = SerbinarioDateFormat::toUsa($this->data['data_fim'], 'date');

        #Criando a consulta
        $query = \DB::table('vendas')
            ->join('premiacoes', 'premiacoes.id', '=', 'vendas.premiacao_id')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->join('conf_vendas', 'conf_vendas.venda_id', '=', 'vendas.id')
            ->join('vendedor', 'conf_vendas.vendedor_id', '=', 'vendedor.id')
            ->join('areas', 'areas.id', '=', 'vendedor.area_id')
            ->whereBetween('vendas.data', array($dataIni, $dataFim));
        if($this->data['area'] != 0) {
            $query->where('areas.id', $this->data['area']);
        }
        if($this->data['vendedor'] != 0) {
            $query->where('vendedor.id', $this->data['vendedor']);
        }
        if($this->data['premiacao'] != 0) {
            $query->where('premiacoes.id', $this->data['premiacao']);
        }
        if($this->data['status'] != 0) {
            $query->where('status_vendas.id', $this->data['status']);
        }

        return $query;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cumpomVenda($id)
    {
        #Criando a consulta
        $apostas = \DB::table('apostas')
            ->join('vendas', 'vendas.id', '=', 'apostas.venda_id')
            ->join('cotacoes', 'cotacoes.id', '=', 'apostas.cotacao_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
            ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->where('vendas.id', '=', $id)
            ->select([
                'time_casa.nome as time_casa',
                'time_fora.nome as time_fora',
                \DB::raw("to_char(partidas.data, 'DD/MM/YYYY') as data"),
                'partidas.hora as hora',
                'apostas.valor as valor_aposta',
                'cotacoes.valor as valor_cotacao',
                'modalidades.nome as nome_modalidade',
            ])
            ->get();

        #Criando a consulta
        $venda = \DB::table('vendas')
            ->join('conf_vendas', 'conf_vendas.venda_id', '=', 'vendas.id')
            ->join('vendedor', 'vendedor.id', '=', 'conf_vendas.vendedor_id')
            ->join('status_vendas', 'vendas.status_v_id', '=', 'status_vendas.id')
            ->join('areas', 'vendedor.area_id', '=', 'areas.id')
            ->join('tipo_apostas', 'tipo_apostas.id', '=', 'vendas.tipo_aposta_id')
            ->where('vendas.id', '=', $id)
            ->select([
                \DB::raw("to_char(vendas.data, 'DD/MM/YYYY HH:MI:SS') as data"),
                'vendedor.nome as vendedor',
                'status_vendas.nome as status_nome',
                'status_vendas.id as status_id',
                'vendas.valor_total as total',
                'vendas.retorno as retorno',
                \DB::raw("lpad(vendas.seq::text, 6, '0') as seq"),
                'vendas.obs as info',
                'areas.nome as nome_area',
                'tipo_apostas.id as tipo_id',
                'tipo_apostas.nome as tipo_nome',
            ])
            ->get();

        $parametros = $this->parametros->all();

        #Retorno para view
        return view('reports.cumpomVendas', compact('apostas', 'venda', 'parametros'));
    }
    
}