<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;
use Softage\Http\Requests;
use Softage\Services\VendedorService;
use Yajra\Datatables\Datatables;
use Softage\Uteis\SerbinarioDateFormat;

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
     * @param $idVendedor
     * @return mixed
     */
    private function getConfVendasId($idVendedor,  $dataIni, $dataFin)
    {
        # Fazendo a consulta para recuperar os
        # ids das configurações de vendas
        $query = $this->getQuery()
            ->where('pessoas.id', $idVendedor);

        // Filtranto por período
        if ($dataIni && $dataFin) {
            //Tratando as datas
            $dataIniUsa = SerbinarioDateFormat::toUsa($dataIni, 'date');
            $dataFimUsa = SerbinarioDateFormat::toUsa($dataFin, 'date');
            $query->whereBetween('vendas.data', array($dataIniUsa, $dataFimUsa));
        }

        # Recuperndo o resultado da query
        $confVendas = $query->lists('conf_vendas.id');

        # Retorno
        return $confVendas;
    }

    /**
     * @param $idVendedor
     * @param $confVendas
     * @return float
     */
    private function comissao($idVendedor, $confVendas)
    {

        # Fazendo a consulta
        $query = \DB::table('conf_vendas')
            ->where('vendedor_id', $idVendedor)
            //->whereIn('conf_vendas.id', array_unique($confVendas))
            ->where('conf_vendas.id', "=", $confVendas)
            ->select([\DB::raw('SUM(conf_vendas.comissao) as comissao')])
            ->first();

        # Retorno
        return $query->comissao ?? 0.00;
    }

    /**
     * @param $idVendedor
     * @param $dataIni
     * @param $dataFin
     * @return mixed
     */
    public function getPremiacao($idVendedor, $dataIni, $dataFin)
    {
        # Fazendo a consulta
        $query = $this->getQuery()
            ->where('pessoas.id', $idVendedor)
            ->where('premiacao_id', 1)
            ->select([\DB::raw('SUM(vendas.retorno) as premiacao')]);

        // Filtranto por período
        if ($dataIni && $dataFin) {
            //Tratando as datas
            $dataIniUsa = SerbinarioDateFormat::toUsa($dataIni, 'date');
            $dataFimUsa = SerbinarioDateFormat::toUsa($dataFin, 'date');
            $query->whereBetween('vendas.data', array($dataIniUsa, $dataFimUsa));
        }

        # Recuperndo o resultado da query e retornando
        return $query->first()->premiacao ?? 0.00;
    }

    /**
     * @param $idVendedor
     * @param $dataIni
     * @param $dataFin
     * @return mixed
     */
    public function getComissao($idVendedor, $dataIni, $dataFin)
    {

        $comissao = "0.0";

        # Recuperando o id das configurações de vendas
        $confVendas = array_values(array_unique($this->getConfVendasId($idVendedor, $dataIni, $dataFin)));
       // dd(count($confVendas));

        for($i = 0; $i < count($confVendas); $i++){
            # Recuperndo o resultado da query

            # Fazendo a consulta
            $query = $this->getQuery()
                ->where('pessoas.id', $idVendedor)
                ->select([\DB::raw('SUM(vendas.valor_total) as valor')]);

            // Filtranto por período
            if ($dataIni && $dataFin) {
                //Tratando as datas
                $dataIniUsa = SerbinarioDateFormat::toUsa($dataIni, 'date');
                $dataFimUsa = SerbinarioDateFormat::toUsa($dataFin, 'date');
                $query->whereBetween('vendas.data', array($dataIniUsa, $dataFimUsa));
            }

            $query->where('vendas.conf_venda_id', $confVendas[$i]);

            $result = $query->first();
           // $comissao = $comissao + $result->valor;
           // dd( $this->comissao($idVendedor, $confVendas[1]));
           // dd(($result->valor * $this->comissao($idVendedor, $confVendas[$i])));
            //dd(($result->valor * $this->comissao($idVendedor, $confVendas[$i])) / 100);

            $comissao = $comissao + ($result->valor * $this->comissao($idVendedor, $confVendas[$i])) / 100;
        }

       // dd($comissao);

        # Retorno
        return $comissao;
    }

    /**
     * @param $idVendedor
     * @param $dataIni
     * @param $dataFin
     * @return mixed
     */
    private function getValorFinal($idVendedor, $dataIni, $dataFin)
    {
        $comissao = 0;
        $total    = 0;

        # Recuperando o id das configurações de vendas
        $confVendas = array_values(array_unique($this->getConfVendasId($idVendedor, $dataIni, $dataFin)));

        for($i = 0; $i < count($confVendas); $i++){

            # Fazendo a consulta
            $query = $this->getQuery()
                ->where('pessoas.id', $idVendedor)
                ->select([\DB::raw('SUM(vendas.valor_total) as valor')]);

            // Filtranto por período
            if ($dataIni && $dataFin) {
                //Tratando as datas
                $dataIniUsa = SerbinarioDateFormat::toUsa($dataIni, 'date');
                $dataFimUsa = SerbinarioDateFormat::toUsa($dataFin, 'date');
                $query->whereBetween('vendas.data', array($dataIniUsa, $dataFimUsa));
            }

            # Recuperndo o resultado da query
            $query->where('vendas.conf_venda_id', "=", $confVendas[$i]);
            $result = $query->first();
            $total = $total + $result->valor;
            $comissao = $comissao + ($result->valor * $this->comissao($idVendedor, $confVendas[$i])) / 100;
        }

        # Recuperando a premiação
        $resultPremiacao = $this->getPremiacao($idVendedor, $dataIni, $dataFin);

        # Calculando o valor final e Retorno
        return ($total - $comissao) - $resultPremiacao;
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
                \DB::raw('SUM(vendas.valor_total) as valor_total')
            ]);
        
        #Editando a grid
        return Datatables::of($rows)
            ->addColumn('premiacao', function ($row) use ($request) {
                # retorno
                return number_format($this->getPremiacao($row->id, $request->get('data_inicio'),
                    $request->get('data_fim'), 2, ',', '.'));
            })
            ->addColumn('comissao', function ($row) use ($request) {
                # Retorno
                return number_format($this->getComissao($row->id, $request->get('data_inicio'),
                    $request->get('data_fim')), 2, ',', '.');
            })
            ->addColumn('valor_final', function ($row) use ($request) {
                # Retorno
                return number_format($this->getValorFinal($row->id, $request->get('data_inicio'),
                    $request->get('data_fim')), 2, ',', '.');
            })
            ->filter(function ($query) use ($request) {
                // Filtranto por vestibular
                if ($request->has('data_inicio') && $request->has('data_fim')) {
                    //Tratando as datas
                    $dataIni = SerbinarioDateFormat::toUsa($request->get('data_inicio'), 'date');
                    $dataFim = SerbinarioDateFormat::toUsa($request->get('data_fim'), 'date');
                    $query->whereBetween('vendas.data', array($dataIni, $dataFim));
                }

                # Verificando a se a area foi passado por parâmetro
                if($request->has('area') && $request->get('area') != 0) {
                    $query->where('areas.id', $request->get('area'));
                }

                # Verificando a se o vendedor foi passado por parâmetro
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
    public function reportFinanceiroSum(Request $request)
    {
        try {
            # Criando a query principal
            $query = $this->getQuery()
                ->groupBy('pessoas.id', 'areas.id')
                ->select([
                    'pessoas.id',
                    \DB::raw('SUM(vendas.valor_total) valor_total'),
                ]);

            // Filtranto por períodos
            if ($request->has('data_inicio') && $request->has('data_fim')) {
                //Tratando as datas
                $dataIni = SerbinarioDateFormat::toUsa($request->get('data_inicio'), 'date');
                $dataFim = SerbinarioDateFormat::toUsa($request->get('data_fim'), 'date');
                $query->whereBetween('vendas.data', array($dataIni, $dataFim));
            }

            # Verificando a se a área foi passado por parâmetro
            if($request->has('area') && $request->get('area') != 0) {
                $query->where('areas.id', $request->get('area'));
            }

            # Verificando a se o vendedor foi passado por parâmetro
            if($request->has('vendedor') && $request->get('vendedor') != 0) {
                $query->where('pessoas.id', $request->get('vendedor'));
            }

            # Variáveis de soma
            $sumPremiacao  = 0;
            $sumComissao   = 0;
            $sumvalorTotal = 0;
            $sumvalorFinal = 0;

            # Percorrendo o o retorno da query
            foreach ($query->get() as $row) {
                $sumPremiacao  += $this->getPremiacao($row->id, $request->get('data_inicio'), $request->get('data_fim'));
                $sumComissao   += $this->getComissao($row->id, $request->get('data_inicio'), $request->get('data_fim'));
                $sumvalorTotal += $row->valor_total;
                $sumvalorFinal +=  $this->getValorFinal($row->id, $request->get('data_inicio'), $request->get('data_fim'));
            }

            # Variável de retorno
            $result = (object) [
                'premiacao' => number_format($sumPremiacao, 2, ',', '.'),
                'comissao' => number_format($sumComissao, 2, ',', '.'),
                'valor_final' => number_format($sumvalorFinal, 2, ',', '.'),
                'valor_total' => number_format($sumvalorTotal, 2, ',', '.')
            ];

            # Verificando o tipo de requisição
            if($request->has('tipo_requisicao') && $request->get('tipo_requisicao') == '1') {
                # Retorno
                return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $result]);
            } else {
                # Retorno
                return $result;
            }
        } catch (\Throwable $e) {
            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
        }
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
                    'pessoas.id',
                    'pessoas.nome',
                    'areas.nome as nome_area',
                    \DB::raw('SUM(vendas.valor_total) valor_total'),
                ]);

            // Filtranto por períodos
            if ($request->has('data_inicio') && $request->has('data_fim')) {
                //Tratando as datas
                $dataIni = SerbinarioDateFormat::toUsa($request->get('data_inicio'), 'date');
                $dataFim = SerbinarioDateFormat::toUsa($request->get('data_fim'), 'date');
                $query->whereBetween('vendas.data', array($dataIni, $dataFim));
            }

            # Verificando a se a área foi passado por parâmetro
            if($request->has('area') && $request->get('area') != 0) {
                $query->where('areas.id', $request->get('area'));
            }

            # Verificando a se o vendedor foi passado por parâmetro
            if($request->has('vendedor') && $request->get('vendedor') != 0) {
                $query->where('pessoas.id', $request->get('vendedor'));
            }

            # Array dos dados
            $result = [];
            $count = 0;

            # Recupeando os dados da query
            $rows = $query->get();

            # Percorrendo o o retorno da query
            foreach ($rows as $row) {
                # Armazenando os dados
                $result[$count]['nome'] = $row->nome;
                $result[$count]['nome_area'] = $row->nome_area;
                $result[$count]['premiacao'] = ($result[$count]['sumPremiacao'] ?? 0.00) + $this->getPremiacao($row->id, $request->get('data_inicio'), $request->get('data_fim'));
                $result[$count]['comissao'] = ($result[$count]['sumComissao'] ?? 0.00) + $this->getComissao($row->id, $request->get('data_inicio'), $request->get('data_fim'));
                $result[$count]['valor_total'] = ($result[$count]['sumvalorTotal'] ?? 0.00) + $row->valor_total;
                $result[$count]['valor_final'] =  ($result[$count]['sumvalorFinal'] ?? 0.00) + $this->getValorFinal($row->id, $request->get('data_inicio'), $request->get('data_fim'));

                # Convertendo
                $result[$count] = (object) $result[$count];

                # Incrementando
                $count++;
            }

            # Retorno
            return $result;
        } catch (\Throwable $e) {dd( $e);
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
        $sum = $this->reportFinanceiroSum($request);
        
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