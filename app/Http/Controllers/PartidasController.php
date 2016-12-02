<?php

namespace Softage\Http\Controllers;

use Carbon\Carbon;
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
        'Campeonatos',
        'Status'
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
            # Html de retorno
            $html = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';

            # Recuperando a partida
            $partida = $this->repository->find($row->id);

            # Validando a possibilidade de remoção
            if(!count($partida->gols) > 0 && !count($partida->cotacoes) > 0 && !count($partida->apostas) > 0) {
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
            $model = $this->repository->with('status')->find($id);

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPartidas(Request $request)
    {
        try {
            # Recuperando a data da requisição
            $data  = Carbon::createFromFormat('d/m/Y', $request->get('data'));

            # Fazendo a consulta
            $query = \DB::table('partidas')
                ->join('status', 'status.id', '=', 'partidas.status_id')
                ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
                ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
                ->where('partidas.data', $data->format('Y-m-d'))
                ->whereExists(function ($query) {
                    $query->select('apostas.id')
                        ->from('apostas')
                        ->whereRaw('apostas.partida_id = partidas.id');
                })
                ->select([
                    'partidas.id',
                    'time_casa.nome as timeCasa',
                    'time_fora.nome as timeFora'
                ])->get();

            # retorno
            return response()->json(['success' => true, 'data' => $query]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['success' => false, 'msg' => 'Data inválida!']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'msg' => 'Ocorreu um erro, contate o suporte.']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPartidasSemApostas(Request $request)
    {
        try {
            # Recuperando a data da requisição
            $data  = Carbon::createFromFormat('d/m/Y', $request->get('data'));

            # Fazendo a consulta
            $query = \DB::table('partidas')
                ->join('status', 'status.id', '=', 'partidas.status_id')
                ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
                ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
                ->where('partidas.data', $data->format('Y-m-d'))
                ->orderBy('time_casa.nome', 'asc')
                ->select([
                    'partidas.id',
                    'time_casa.nome as timeCasa',
                    'time_fora.nome as timeFora'
                ])->get();

            # retorno
            return response()->json(['success' => true, 'data' => $query]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['success' => false, 'msg' => 'Data inválida!']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'msg' => 'Ocorreu um erro, contate o suporte.']);
        }
    }
}
