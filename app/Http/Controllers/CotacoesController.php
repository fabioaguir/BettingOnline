<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Repositories\CotacoesRepository;
use Softage\Services\CotacoesService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\CotacoesCreateRequest;
use Softage\Http\Requests\CotacoesUpdateRequest;
use Softage\Validators\CotacoesValidator;
use Yajra\Datatables\Datatables;


class CotacoesController extends Controller
{
    /**
     * @var CotacoesRepository
     */
    private $repository;

    /**
     * @var CotacoesService
     */
    private $service;
    /**
     * @var CotacoesValidator
     */
    private $validator;

    /**
     * @var array
     *
     * Arrays de models para carregamento
     */
    private $loadFields = [
        'Status',
        'Modalidades'
    ];

    /**
     * CotacoesController constructor.
     * @param CotacoesRepository $repository
     * @param CotacoesService $service
     * @param CotacoesValidator $validator
     */
    public function __construct(CotacoesRepository $repository, CotacoesService $service, CotacoesValidator $validator)
    {
        $this->repository = $repository;
        $this->service    = $service;
        $this->validator  = $validator;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cotacoes.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta de Cotacoes
        $rows = \DB::table('cotacoes')
            ->join('cotacaos', 'cotacaos.id', '=', 'cotacoes.cotacao_id')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('status', 'status.id', '=', 'cotacoes.status_id')
            ->select([
                'cotacoes.id',
                'modalidades.nome',
                'cotacoes.valor',
                'status.nome as status'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <a href="destroy/'.$row->id.'" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-delete"></i> Remover</a>';
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
        return view('cotacoes.create', compact('loadFields'));
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
            return redirect()->back()->withErrors($e->getMessage());
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
            $model = $this->repository->with('status')->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('cotacoes.edit', compact('model', 'loadFields'));
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
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

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            # Recuperando o registro do banco de dados
            $cotacao = $this->repository->find($id);

            # verificando se o registro foi recuperado
            if(!$cotacao) {
                throw new \Exception('Cotação não encontrado!');
            }

            # Removendo o registro do banco de dados
            $this->repository->delete($cotacao->id);

            #Retorno para a view
            return redirect()->back()->with("message", "Remoção realizada com sucesso!");
        } catch (\Throwable $e) {
            return redirect()->back()->withErros($e->getMessage());
        }
    }
}
