<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Repositories\ParametrosRepository;
use Softage\Repositories\VendasRepository;
use Softage\Services\ReportService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\AreasCreateRequest;
use Softage\Http\Requests\AreasUpdateRequest;
use Softage\Entities\Vendas;
use Yajra\Datatables\Datatables;
use Softage\Uteis\SerbinarioDateFormat;


class ReportVendasController extends Controller
{
    
    /**
     * @var ReportService
     */
    private $service;

    /**
     * @var VendasRepository
     */
    private $vendasRepository;

    /**
     * @var ParametrosRepository
     */
    private $parametros;

    /**
     * @var
     */
    private $queryVendas;

    /**
     * @var
     */
    private $querySum;
    
    /**
     * @var array
     */
    private $loadFields = [
        'Premiacoes',
        'Vendedor',
        'Areas',
        'StatusVendas'
    ];

    /**
     * ReportVendasController constructor.
     * @param ReportService $service
     * @param ParametrosRepository $parametros
     * @param VendasRepository $vendasRepository
     */
    public function __construct(ReportService $service, ParametrosRepository $parametros, VendasRepository $vendasRepository)
    {
        $this->service    = $service;
        $this->parametros = $parametros;
        $this->vendasRepository = $vendasRepository;
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

        $consulta = $this->queryVendas($request);

        #Editando a grid
        return Datatables::of($consulta)->addColumn('seq', function ($row) {
            $html = "";
            $html .= '<a href="cupomVendas/'.$row->id.'" target="_blank">'.$row->seq.'</a> ';
            return $html;
        })
        ->addColumn('action', function ($row) {
            $html = "";
            $html .= '<a href="cancelarVenda/'.$row->id.'" class="btn btn-xs btn-primary cancelar"><i class="glyphicon glyphicon-edit"></i> Cancelar</a> ';
            return $html;
        })->make(true);
    }

    /**
     * @param $dados
     * @return mixed
     */
    public function queryVendas($dados)
    {

        $query = $this->struturaQuery($dados);

        $consulta = $query->select([
            'vendas.id as id',
            \DB::raw("lpad(vendas.seq::text, 6, '0') as seq"),
            'areas.nome as area_nome',
            'pessoas.nome as vendedor_nome',
            \DB::raw("to_char(vendas.data, 'DD/MM/YYYY') as data"),
            'vendas.obs as obs',
            'vendas.valor_total as valor_total',
            'vendas.retorno as retorno',
            'premiacoes.nome as premiacao_nome',
        ]);

        return $consulta;

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function querySum(Request $request)
    {

        $query = $this->struturaQuery($request);

        $sum = $query->select([
            \DB::raw("SUM(vendas.valor_total) as total_vendido"),
            \DB::raw("SUM(vendas.retorno) as total_retorno")
        ])->get();

        return $sum;
    }

    /**
     * @param $dados
     */
    public function struturaQuery($dados)
    {

        //Tratando as datas
        $dataIni = SerbinarioDateFormat::toUsa($dados['data_inicio'], 'date');
        $dataFim = SerbinarioDateFormat::toUsa($dados['data_fim'], 'date');

        #Criando a consulta
        $query = \DB::table('vendas')
            ->join('premiacoes', 'premiacoes.id', '=', 'vendas.premiacao_id')
            ->join('conf_vendas', 'conf_vendas.id', '=', 'vendas.conf_venda_id')
            ->join('pessoas', 'conf_vendas.vendedor_id', '=', 'pessoas.id')
            ->join('areas', 'areas.id', '=', 'pessoas.area_id')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->whereBetween('vendas.data', array($dataIni, $dataFim))
            ->where('status_vendas.id', '=', '1');

        if($dados['area'] != 0) {
            $query->where('areas.id', $dados['area']);
        }

        if($dados['vendedor'] != 0) {
            $query->where('pessoas.id', $dados['vendedor']);
        }

        if($dados['premiacao'] != 0) {
            $query->where('premiacoes.id', $dados['premiacao']);
        }

        if($dados['status'] != 0) {
            $query->where('status_vendas.id', $dados['status']);
        }

        return $query;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cupomVendas($id)
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
            ->join('conf_vendas', 'conf_vendas.id', '=', 'vendas.conf_venda_id')
            ->join('pessoas', 'pessoas.id', '=', 'conf_vendas.vendedor_id')
            ->join('status_vendas', 'vendas.status_v_id', '=', 'status_vendas.id')
            ->join('areas', 'pessoas.area_id', '=', 'areas.id')
            ->join('tipo_apostas', 'tipo_apostas.id', '=', 'vendas.tipo_aposta_id')
            ->where('vendas.id', '=', $id)
            ->select([
                \DB::raw("to_char(vendas.data, 'DD/MM/YYYY HH:MI:SS') as data"),
                'pessoas.nome as vendedor',
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
        return view('reports.cupomVendas', compact('apostas', 'venda', 'parametros'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function cancelarVenda($id)
    {
        try {

            # Recuperando o registro do banco de dados
            $vendas = $this->vendasRepository->find($id);

            # verificando se o registro foi recuperado
            if(!$vendas) {
                throw new \Exception('Venda não encontrado!');
            }

            # Removendo o registro do banco de dados
            $vendas->status_v_id = '2';
            $vendas->save();

            #Retorno para a view
            return redirect()->back()->with("message", "Cancelamento realizada com sucesso!");
        } catch (\Throwable $e) {
            dd('sdsd');
            return redirect()->back()->withErros($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfVendas(Request $request)
    {
        $dados = $request->request->all();
        
        $vendas = $this->queryVendas($request);
        $sum    = $this->querySum($request);
        
        $this->queryVendas = $vendas->get();
        $this->querySum = $sum;
        
        if($dados['exportar'] == '1') {
            
            return \PDF::loadView('reports.reportVendasPDF', ['vendas' => $vendas->get(), 'sum' => $sum])->stream();
            
        } else if ($dados['exportar'] == '2') {

            \Excel::create('Relatório de vendas', function($excel) {

                $excel->sheet('Excel', function($sheet) {

                    $sheet->loadView('reports.reportVendasExcel', array('vendas' => $this->queryVendas, 'sum' => $this->querySum));

                });

            })->download('xls');
        }
        
    }
    
}
