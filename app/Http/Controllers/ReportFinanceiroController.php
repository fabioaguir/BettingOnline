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
            ->where('pessoas.tipo_pessoa_id', '=', '1');
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
                \DB::raw('((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100) as comissao'),
                \DB::raw('SUM(vendas.valor_total) valor_total'),
                \DB::raw('(SUM(vendas.valor_total) - ((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100) - SUM(vendas.retorno)) as valor_final')
            ]);

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                // Filtranto por vestibular
                if ($request->has('dataInicio') && $request->has('dataFim')) {
                    $query->whereBetween('conf_vendas.data', array($request->get('dataInicio'), $request->get('dataFim')));
                }
            })
            ->make(true);
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
                    \DB::raw('((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100) as comissao'),
                    \DB::raw('SUM(vendas.valor_total) valor_total'),
                    \DB::raw('(SUM(vendas.valor_total) - ((SUM(vendas.valor_total) * sum(conf_vendas.comissao))/100) - SUM(vendas.retorno)) as valor_final')
                ]);

            # Verificando a se o período foi passado por parâmetro
            if ($request->has('dataInicio') && $request->has('dataFim')) {
                $query->whereBetween('conf_vendas.data', '=', array($request->get('dataInicio'), $request->get('dataFim')));
            }

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $query->get()]);
        } catch (\Throwable $e) {
            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
