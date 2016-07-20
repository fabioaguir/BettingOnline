<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\AreasCreateRequest;
use Softage\Http\Requests\AreasUpdateRequest;
use Softage\Repositories\ConfVendasRepository;
use Softage\Services\VendedorService;
use Softage\Validators\VendedorValidator;
use Softage\Validators\ConfgVendasValidator;
use Yajra\Datatables\Datatables;


class VendedorController extends Controller
{
    
    /**
     * @var VendedorService
     */
    private $service;

    /**
     * @var VendedorValidator
     */
    private $validator;

    /**
     * @var ConfgVendasValidator
     */
    private $configValidator;

    /**
     * @var array
     */
    private $loadFields = [
        'Status',
        'TipoCotacao',
        'Areas',
        'EstornoVendedor'
    ];

    /**
     * VendedorController constructor.
     * @param VendedorService $service
     * @param VendedorValidator $validator
     * @param ConfgVendasValidator $configValidator
     */
    public function __construct(VendedorService $service, VendedorValidator $validator, ConfgVendasValidator $configValidator)
    {
        $this->service = $service;
        $this->validator  = $validator;
        $this->configValidator = $configValidator;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vendedor.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('pessoas')
            ->join('areas', 'areas.id', '=', 'pessoas.area_id')
            ->join('estorno_vendedor', 'estorno_vendedor.id', '=', 'pessoas.estorno_id')
            ->join('status', 'status.id', '=', 'pessoas.status_id')
            ->leftJoin(\DB::raw('conf_vendas'), function ($join) {
                $join->on(
                    'conf_vendas.id', '=',
                    \DB::raw("(SELECT conf_atual.id FROM conf_vendas as conf_atual 
                    where conf_atual.vendedor_id = pessoas.id AND conf_atual.status_id = 1  ORDER BY conf_vendas.id DESC LIMIT 1)")
                );
            })
            ->select([
                'pessoas.id as id',
                'pessoas.usuario as usuario',
                'pessoas.nome as nome',
                'pessoas.codigo as codigo',
                'areas.nome as nome_area',
                'estorno_vendedor.nome as estorno',
                'status.nome as status',
                'conf_vendas.limite_vendas as limite',
                'conf_vendas.comissao as comissao',
                'conf_vendas.cotacao as cotacao',
                'conf_vendas.id as conf_id',
                \DB::raw("(SELECT SUM(vendas.valor_total) FROM vendas WHERE vendas.conf_venda_id = conf_vendas.id ) as valor_total")
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = "";
            $html .= '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';
            if(isset($row->conf_id)){
                $html .= '<a href="zerar/'.$row->conf_id.'" class="btn btn-xs btn-warning zerar"><i class="glyphicon glyphicon-edit"></i> Zerar</a>';
            }
            return $html;
        })->make(true);
    }

    /**
     * @return mixed
     */
    public function gridConfig($id)
    {
        #Criando a consulta
        $rows = \DB::table('conf_vendas')
            ->join('tipo_cotacao', 'tipo_cotacao.id', '=', 'conf_vendas.tipo_cotacao_id')
            ->join('status', 'status.id', '=', 'conf_vendas.status_id')
            ->where('vendedor_id', '=', $id)
            ->orderBy('status.nome', 'desc')
            ->select(['conf_vendas.id as id',
                'conf_vendas.limite_vendas as vendas',
                'conf_vendas.comissao as comissao',
                'conf_vendas.cotacao as cotacao',
                'tipo_cotacao.nome as tipo',
                'tipo_cotacao.id as id_tipo',
                'status.nome as status',
                'status.id as status_id',
                \DB::raw("to_char(conf_vendas.data, 'DD/MM/YYYY') as data"),
                \DB::raw("(SELECT SUM(vendas.valor_total) FROM vendas WHERE vendas.conf_venda_id = conf_vendas.id ) as total")
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            if($row->status_id == '1') {
                return '<a href="" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
            }
            return "";
        })->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);
        $areas = \DB::table('areas')->where('status', '=', '1')->lists('nome', 'id');

        #Retorno para view
        return view('vendedor.create', compact('loadFields', 'areas'));
    }

    /**
     * @param Request $request
     * @return $this|array|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Executando a ação
            $this->service->store($data);

            #Retorno para a view
            return redirect()->back()->with("message", "Cadastro realizado com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return $this|array|\Illuminate\Http\RedirectResponse
     */
    public function storeConfig(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #Executando a ação
            $resultado = $this->service->storeConfig($data);

            if($resultado == false) {
                return redirect()->back()->withErrors("Você não pode cadastrar uma configuração de vendas, com uma ainda não zerada")->withInput();
            }
            
            #Retorno para a view
            return redirect()->back()->with("message", "Cadastro realizado com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            #Recuperando a empresa
            $model = $this->service->find($id);
            $areas = \DB::table('areas')->where('status', '=', '1')->lists('nome', 'id');

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('vendedor.edit', compact('model', 'loadFields', 'areas'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #tratando as rules
            $this->validator->replaceRules(ValidatorInterface::RULE_UPDATE, ":id", $id);

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
            $this->service->update($data, $id);

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateConfig(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #Executando a ação
            $this->service->updateConfig($data);

            #Retorno para a view
            return array('msg' => 'Configuração de vendas alterada com sucesso!');
        } catch (ValidatorException $e) {
            return $this->validator->errors();
        } catch (\Throwable $e) {print_r($e->getMessage()); exit;
            return $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function zerar($id)
    {
        try {
            #Executando a ação
            $this->service->zerar($id);

            #Retorno para a view
            return redirect()->back()->with("message", "Limite de vendas zerado com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
