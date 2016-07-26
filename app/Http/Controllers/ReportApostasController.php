<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Repositories\ParametrosRepository;
use Softage\Services\ReportService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\Datatables\Datatables;
use Softage\Uteis\SerbinarioDateFormat;


class ReportApostasController extends Controller
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
    private $loadFields = [];

    public function __construct(ReportService $service, ParametrosRepository $parametros)
    {
        $this->service    = $service;
        $this->parametros = $parametros;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportApostasView()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('reports.reportApostas', compact('loadFields'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportApostasSearch(Request $request)
    {
        $dados = $request->request->all();

        //dd($dados);

        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        $consulta  = $this->queryApostas($request);
        $sum       = $this->querySum($request);

        #Editando a grid
        return Datatables::of($consulta)->addColumn('action', function ($row) {
            $html = "";
            $html .= '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';
            return $html;
        })->make(true);
    }
    

    /**
     * @param $dados
     * @return mixed
     */
    public function queryApostas($dados)
    {
        $this->data = $dados;

        $query = $this->struturaQuery($this->data);

        $consulta = $query->select([
            'apostas.id as id',
            \DB::raw("lpad(vendas.seq::text, 6, '0') as seq"),
            \DB::raw("to_char(vendas.data, 'DD/MM/YYYY') as data"),
            'pessoas.nome as vendedor_nome',
            'tipo_apostas.nome as tipo',
            'modalidades.nome as nome_modalidade',
            'apostas.valor as valor',
            'cotacoes.valor as cotacao',
            \DB::raw("(CASE tipo_apostas.id WHEN 1 THEN to_char((apostas.valor * cotacoes.valor)::real, '9999999999D99') WHEN 2 THEN to_char((vendas.retorno)::real, '9999999999D99') END ) as retorno"),
        ]);

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
    public function struturaQuery($dados)
    {
        $this->data = $dados;

        #Criando a consulta
        $query = \DB::table('apostas')
            ->join('vendas', 'vendas.id', '=', 'apostas.venda_id')
            ->join('cotacoes', 'cotacoes.id', '=', 'apostas.cotacao_id')
            ->join('conf_vendas', 'conf_vendas.id', '=', 'vendas.conf_venda_id')
            ->join('pessoas', 'conf_vendas.vendedor_id', '=', 'pessoas.id')
            ->join('partidas', 'partidas.id', '=', 'apostas.partida_id')
            ->join('tipo_apostas', 'tipo_apostas.id', '=', 'vendas.tipo_aposta_id')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->where('partidas.id', '=', $dados['partida']);

        return $query;
    }
    
}
