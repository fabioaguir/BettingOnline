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


class ReportArrecadacoesController extends Controller
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
     * @var
     */
    private $queryArrecadacoes;

    /**
     * @var
     */
    private $querySum;
    
    /**
     * @var array
     */
    private $loadFields = [
        'Arrecadador|Arrecadadores,2'
    ];

    /**
     * @var array
     */
    private $loadFields2 = [
        'User'
    ];

    public function __construct(ReportService $service, ParametrosRepository $parametros)
    {
        $this->service    = $service;
        $this->parametros = $parametros;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportArrecadacoesView()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);
        $loadFields2 = $this->service->loadUser($this->loadFields2);
        
        #Retorno para view
        return view('reports.reportArrecadacoes', compact('loadFields', 'loadFields2'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportArrecadacoesSearch(Request $request)
    {
        $consulta  = $this->queryArrecadacoes($request);
        
        #Editando a grid
        return Datatables::of($consulta)->addColumn('action', function ($row) {
            $html = "";
            //$html .= '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';
            return $html;
        })->make(true);
    }
    

    /**
     * @param $dados
     * @return mixed
     */
    public function queryArrecadacoes($dados)
    {
        $query = $this->struturaQuery($dados);

        $consulta = $query->select([
            'arrecadacoes.id as id',
            'areas.nome as area_nome',
            'vendedor.nome as vendedor_nome',
            \DB::raw("concat(arrecadador.nome,' ',users.name) as usuario"),
            'arrecadacoes.valor as valor_vendido',
            \DB::raw("to_char((arrecadacoes.valor - ((conf_vendas.comissao * arrecadacoes.valor) / 100))::real, '9999999999D99') as valor_arrecadado"),
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
            \DB::raw("SUM(arrecadacoes.valor) as total_vendido"),
            \DB::raw("SUM(to_number(to_char((arrecadacoes.valor - ((conf_vendas.comissao * arrecadacoes.valor) / 100))::real, '9999999999D99'), '9999999999D99')) as total_arrecadado")
        ])->get();
        
        return $sum;
    }

    /**
     * @param $dados
     */
    public function struturaQuery($dados)
    {
        $this->data = $dados;

        //Tratando as datas
        $dataIni = SerbinarioDateFormat::toUsa($this->data['data_inicio'], 'date');
        $dataFim = SerbinarioDateFormat::toUsa($this->data['data_fim'], 'date');

        #Criando a consulta
        $query = \DB::table('arrecadacoes')
            ->join('pessoas as vendedor', 'vendedor.id', '=', 'arrecadacoes.vendedor_id')
            ->leftJoin('pessoas as arrecadador', 'arrecadador.id', '=', 'arrecadacoes.arrecadador_id')
            ->join(\DB::raw('conf_vendas'), function ($join) {
                $join->on(
                    'conf_vendas.id', '=',
                    \DB::raw("(SELECT conf_atual.id FROM conf_vendas as conf_atual
                    where conf_atual.vendedor_id = vendedor.id AND conf_atual.status_id = 1  ORDER BY conf_vendas.id DESC LIMIT 1)")
                );
            })
            //->join('conf_vendas', 'conf_vendas.vendedor_id', '=', 'vendedor.id')
            ->leftJoin('users', 'users.id', '=', 'arrecadacoes.user_id')
            ->join('areas', 'areas.id', '=', 'vendedor.area_id')
            ->whereBetween('arrecadacoes.data', array($dataIni, $dataFim));

        if (($this->data->has('user') && $this->data->get('user')) != 0) {
            $query->Where(function ($query) {
                $query->orWhere('arrecadacoes.user_id', '=', "{$this->data['user']}");
            });
        }

        if (($this->data->has('arrecadador') && $this->data->get('arrecadador')) != 0) {
            $query->Where(function ($query) {
                $query->orWhere('arrecadacoes.arrecadador_id', '=', "{$this->data['arrecadador']}");
            });
        }

        return $query;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exporteArrecadacoes(Request $request)
    {
        $dados = $request->request->all();

        $arrecadacoes = $this->queryArrecadacoes($request);
        $sum    = $this->querySum($request);

        $this->queryArrecadacoes = $arrecadacoes->get();
        $this->querySum = $sum;

        if($dados['exportar'] == '1') {

            return \PDF::loadView('reports.reportArrecadacoesPDF', ['arrecadacoes' => $arrecadacoes->get(), 'sum' => $sum])->stream();

        } else if ($dados['exportar'] == '2') {

            \Excel::create('Relatório de vendas', function($excel) {

                $excel->sheet('Excel', function($sheet) {

                    $sheet->loadView('reports.reportArrecadacoesExcel', array('arrecadacoes' => $this->queryArrecadacoes, 'sum' => $this->querySum));

                });

            })->download('xls');
        }

    }
    
}
