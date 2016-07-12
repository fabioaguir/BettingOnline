<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Repositories\PartidasRepository;
use Softage\Services\PartidasService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\PartidasCreateRequest;
use Softage\Http\Requests\PartidasUpdateRequest;
use Softage\Validators\PartidasValidator;
use Yajra\Datatables\Datatables;


class PartidasController extends Controller
{
    /**
     * @var PartidasRepository
     */
    private $repository;

    /**
     * @var PartidasService
     */
    private $service;
    /**
     * @var PartidasValidator
     */
    private $validator;

    /**
     * @var array
     *
     * Arrays de models para carregamento
     */
    private $loadFields = [
        'Times',
        'Status',
        'Campeonatos'
    ];

    /**
     * PartidasController constructor.
     * @param PartidasRepository $repository
     * @param PartidasService $service
     * @param PartidasValidator $validator
     */
    public function __construct(PartidasRepository $repository, PartidasService $service, PartidasValidator $validator)
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
        return view('partidas.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta de partidas
        $rows = \DB::table('partidas')
            ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
            ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
            ->join('campeonatos', 'campeonatos.id', '=', 'partidas.campeonato_id')
            ->join('status', 'status.id', '=', 'partidas.status_id')
            ->select([
                'partidas.id',
                \DB::raw("TO_CHAR(partidas.data, 'DD/MM/YYYY') as data"),
                'partidas.hora',
                'time_casa.nome as timeCasa',
                'time_fora.nome as timeFora',
                'campeonatos.nome as campeonato',
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
        return view('partidas.create', compact('loadFields'));
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
            $model = $this->repository->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('partidas.edit', compact('model', 'loadFields'));
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
            $partida = $this->repository->find($id);

            # verificando se o registro foi recuperado
            if(!$partida) {
                throw new \Exception('Partida não encontrado!');
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