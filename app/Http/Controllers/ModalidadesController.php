<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Repositories\ModalidadesRepository;
use Softage\Services\ModalidadesService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\ModalidadesCreateRequest;
use Softage\Http\Requests\ModalidadesUpdateRequest;
use Softage\Validators\ModalidadesValidator;
use Yajra\Datatables\Datatables;


class ModalidadesController extends Controller
{
    /**
     * @var ModalidadesRepository
     */
    private $repository;

    /**
     * @var ModalidadesService
     */
    private $service;
    /**
     * @var ModalidadesValidator
     */
    private $validator;

    /**
     * @var array
     *
     * Arrays de models para carregamento
     */
    private $loadFields = [
        'Status'
    ];

    /**
     * ModalidadesController constructor.
     * @param ModalidadesRepository $repository
     * @param ModalidadesService $service
     * @param ModalidadesValidator $validator
     */
    public function __construct(ModalidadesRepository $repository, ModalidadesService $service, ModalidadesValidator $validator)
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
        return view('modalidades.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta de Modalidades
        $rows = \DB::table('modalidades')
            ->join('status', 'status.id', '=', 'modalidades.status_id')
            ->select([
                'modalidades.id',
                'modalidades.nome',
                'modalidades.limite_cotacao',
                'status.nome as status'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Html de retorno
            $html = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';

            # Recuperando a modalidade
            $mdalidade = $this->repository->find($row->id);

            # Validando a possibilidade de remoção
            if(!count($mdalidade->cotacoes) > 0) {
                $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-delete"></i> Remover</a>';
            }

            # retorno
            return $html;
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
        return view('modalidades.create', compact('loadFields'));
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
            return view('modalidades.edit', compact('model', 'loadFields'));
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
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            # Recuperando o registro do banco de dados
            $partida = $this->repository->find($id);

            # verificando se o registro foi recuperado
            if(!$partida) {
                throw new \Exception('Modalidade não encontrado!');
            }

            # Removendo o registro do banco de dados
            $this->repository->delete($partida->id);

            #Retorno para a view
            return redirect()->back()->with("message", "Remoção realizada com sucesso!");
        } catch (\Throwable $e) {
            return redirect()->back()->withErros($e->getMessage());
        }
    }
}
