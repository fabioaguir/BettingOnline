<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;
use Softage\Http\Requests;
use Softage\Services\VendedorService;
use Yajra\Datatables\Datatables;

class ReportFinanceiroController extends Controller
{
    /**
     * @var VendedorService
     */
    private $service;

    /**
     * @var
     */
    private $queryFinanceiro;

    /**
     * @var
     */
    private $querySum;

    /**
     * @var array
     */
    private $loadFields = [
        'Areas',
        'Vendedor'
    ];

    /**
     * ReportFinanceiroController constructor.
     * @param VendedorService $service
     */
    public function __construct(VendedorService $service)
    {
        $this->service = $service;
    }

    /**
     * Método resonsável por retornar a query
     *
     * @return mixed
     */
    private function getQuery()
    {
        return \DB::table('pessoas')
            ->join('areas', 'areas.id', '=', 'pessoas.area_id')
            ->join('conf_vendas', 'conf_vendas.vendedor_id', '=', 'pessoas.id')
            ->join('vendas', 'vendas.conf_venda_id', '=', 'conf_vendas.id')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->where('pessoas.tipo_pessoa_id', '=', '1')
            ->where('status_vendas.id', '=', '1');
    }

    /**
     * @return mixed
     */
    public function grid(Request $request)
    {
        #Criando a consulta
        $rows = $this->getQuery()
            ->groupBy('pessoas.id', 'areas.id')
            ->select([
                'pessoas.id as id',
                'pessoas.nome as nome',
                'areas.nome as nome_area',
                \DB::raw('SUM(vendas.retorno) as premiacao'),
                \DB::raw('to_char(((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100)::real, \'9999999999D99\') as comissao'),
                \DB::raw('SUM(vendas.valor_total) valor_total'),
                \DB::raw('to_char((SUM(vendas.valor_total) - ((SUM(vendas.valor_total) * SUM(conf_vendas.comissao))/100) - SUM(vendas.retorno))::real, \'9999999999D99\') as valor_final')
            ]);
        
        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                // Filtranto por vestibular
                if ($request->has('data_inicio') && $request->has('data_fim')) {
                    $query->whereBetween('conf_vendas.data', array($request->get('data_inicio'), $request->get('data_fim')));
                }

                if($request->has('area') && $request->get('area') != 0) {
                    $query->where('areas.id', $request->get('area'));
                }

                if($request->has('vendedor') && $request->get('vendedor') != 0) {
                    $query->where('pessoas.id', $request->get('vendedor'));
                }
            })
            ->make(true);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function queryFinanceiro(Request $request)
    {
        try {
            # Criando a query principal
            $query = $this->getQuery()
                ->groupBy('pessoas.id', 'areas.id')
                ->select([
                    'pessoas.id as id',
                    'pessoas.nome as nome',
                    'areas.nome as nome_area',
                    \DB::raw('SUM(vendas.retorno) as premiacao'),
                    \DB::raw('to_char(((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100)::real, \'9999999999D99\') as comissao'),
                    \DB::raw('SUM(vendas.valor_total) valor_total'),
                    \DB::raw('to_char((SUM(vendas.valor_total) - ((SUM(vendas.valor_total) * SUM(conf_vendas.comissao))/100) - SUM(vendas.retorno))::real, \'9999999999D99\') as valor_final')
                ]);

            # Verificando a se o período foi passado por parâmetro
            if ($request->has('data_inicio') && $request->has('data_fim')) {
                $query->whereBetween('conf_vendas.data',  array($request->get('data_inicio'), $request->get('data_fim')));
            }

            if($request->has('area') && $request->get('area') != 0) {
                $query->where('areas.id', $request->get('area'));
            }

            if($request->has('vendedor') && $request->get('vendedor') != 0) {
                $query->where('pessoas.id', $request->get('vendedor'));
            }

            # Retorno
            return $query->get();
        } catch (\Throwable $e) {
            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportFinanceiroView()
    {
        # Recuperando os loads fields
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('reports.reportFinanceiro', compact('loadFields'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reportFinanceiroSum(Request $request)
    {
        try {
            # Criando a query principal
            $query = $this->getQuery()
                ->select([
                    \DB::raw('SUM(vendas.retorno) as premiacao'),
                    \DB::raw('to_char(((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100)::real, \'9999999999D99\') as comissao'),
                    \DB::raw('SUM(vendas.valor_total) valor_total'),
                    \DB::raw('to_char((SUM(vendas.valor_total) - ((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100) - SUM(vendas.retorno))::real, \'9999999999D99\') as valor_final')
                ]);

            # Verificando a se o período foi passado por parâmetro
            if ($request->has('dataInicio') && $request->has('dataFim')) {
                $query->whereBetween('conf_vendas.data',  array($request->get('dataInicio'), $request->get('dataFim')));
            }

            # Verificando a se o período foi passado por parâmetro
            if ($request->has('data_inicio') && $request->has('data_fim')) {
                $query->whereBetween('conf_vendas.data',  array($request->get('data_inicio'), $request->get('data_fim')));
            }

            if($request->has('area') && $request->get('area') != 0) {
                $query->where('areas.id', $request->get('area'));
            }

            if($request->has('vendedor') && $request->get('vendedor') != 0) {
                $query->where('pessoas.id', $request->get('vendedor'));
            }

            if($request->has('tipo_requisicao') && $request->get('tipo_requisicao') == '1') {
                # Retorno
                return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $query->get()]);
            } else {
                # Retorno
                return $query->first();
            }

        } catch (\Throwable $e) {
            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exporteFinanceiro(Request $request)
    {
        $dados = $request->request->all();

        $financeiro = $this->queryFinanceiro($request);
        $sum    = $this->reportFinanceiroSum($request);

        $this->queryFinanceiro = $financeiro;
        $this->querySum = $sum;
        
        if($dados['exportar'] == '1') {

            return \PDF::loadView('reports.reportFinanceiroPDF', ['financeiros' => $financeiro, 'sum' => $sum])->stream();

        } else if ($dados['exportar'] == '2') {

            \Excel::create('Relatório de vendas', function($excel) {

                $excel->sheet('Excel', function($sheet) {

                    $sheet->loadView('reports.reportFinanceiroExcel', array('financeiros' => $this->queryFinanceiro, 'sum' => $this->querySum));

                });

            })->download('xls');
        }

    }
}
