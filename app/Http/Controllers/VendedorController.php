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
     */
    public function __construct(VendedorService $service, VendedorValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
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
        $rows = \DB::table('vendedor')->select(['id', 'nome']);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })->make(true);
    }

    /**
     * @return mixed
     */
    public function gridConfig($id)
    {
        #Criando a consulta
        $rows = \DB::table('conf_vendas')
            ->leftJoin('tipo_cotacao', 'tipo_cotacao.id', '=', 'conf_vendas.tipo_cotacao_id')
            ->leftJoin('status', 'status.id', '=', 'conf_vendas.status_id')
            ->where('vendedor_id', '=', $id)
            ->orderBy('status.nome', 'desc')
            ->select(['conf_vendas.id as id',
                'conf_vendas.limite_vendas as vendas',
                'conf_vendas.comissao as comissao',
                'conf_vendas.cotacao as cotacao',
                'tipo_cotacao.nome as tipo',
                'tipo_cotacao.id as id_tipo',
                'status.nome as status',
                \DB::raw("to_char(conf_vendas.data, 'DD/MM/YYYY') as data"),
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<a href="" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('vendedor.create', compact('loadFields'));
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

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('vendedor.edit', compact('model', 'loadFields'));
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
}
