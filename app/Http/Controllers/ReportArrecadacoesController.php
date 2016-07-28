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
    public function reportArrecadacoesView()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('reports.reportArrecadacoes', compact('loadFields'));
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
            'vendas.valor_total as valor_vendido',
            \DB::raw("to_char((vendas.valor_total - ((conf_vendas.comissao * vendas.valor_total) / 100))::real, '9999999999D99') as valor_arrecadado"),
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
            \DB::raw("SUM(to_number(to_char((vendas.valor_total - ((conf_vendas.comissao * vendas.valor_total) / 100))::real, '9999999999D99'), '9999999999D99')) as total_arrecadado")
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
            ->join('conf_vendas', 'conf_vendas.vendedor_id', '=', 'vendedor.id')
            ->join('vendas', 'vendas.conf_venda_id', '=', 'conf_vendas.id')
            ->leftJoin('users', 'users.id', '=', 'arrecadacoes.user_id')
            ->join('areas', 'areas.id', '=', 'vendedor.area_id')
            ->whereBetween('arrecadacoes.data', array($dataIni, $dataFim))
            ->Where(function ($query) {
                $query->orWhere('users.name', 'like', "%{$this->data['arrecadador']}%")
                ->orWhere('arrecadador.nome', 'like', "%{$this->data['arrecadador']}%");
            });

        return $query;
    }
    
}