<?php

namespace Softage\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Softage\Repositories\GolsRepository;
use Softage\Repositories\PartidasRepository;
use Softage\Services\GolsService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Validators\GolsValidator;
use Yajra\Datatables\Datatables;


class GolsController extends Controller
{
    /**
     * @var GolsRepository
     */
    private $repository;

    /**
     * @var GolsService
     */
    private $service;
    /**
     * @var GolsValidator
     */
    private $validator;

    /**
     * @var array
     *
     * Arrays de models para carregamento
     */
    private $loadFields = [
        'Tempos'
    ];
    
    /**
     * @var PartidasRepository
     */
    private $partidasRepository;

    /**
     * GolsController constructor.
     * @param GolsRepository $repository
     * @param GolsService $service
     * @param GolsValidator $validator
     */
    public function __construct(GolsRepository $repository,
                                GolsService $service,
                                GolsValidator $validator, 
                                PartidasRepository $partidasRepository)
    {
        $this->repository = $repository;
        $this->service    = $service;
        $this->validator  = $validator;
        $this->partidasRepository = $partidasRepository;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('gols.index', compact('loadFields'));
    }

    /**
     * @return mixed
     */
    public function grid($idPartida)
    {
        #Criando a consulta de Gols
        $rows = \DB::table('gols')
            ->join('tempos', 'tempos.id', '=', 'gols.tempo_id')
            ->join('partidas', 'partidas.id', '=', 'gols.partida_id')
            ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
            ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
            ->join('times', 'times.id', '=', 'gols.time_id')
            ->where('partidas.id', $idPartida)
            ->select([
                'gols.id',
                \DB::raw("concat(time_casa.nome,' x ',time_fora.nome) as partida"),
                \DB::raw("to_char(partidas.data, 'DD/MM/YYYY') as data"),
                'tempos.nome as nomeTempo',
                'times.nome as time',
                'gols.minutos'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Html de retorno
            $html = '';

            # Recuperando o usuário;
            $user = Auth::user();

            # Checando permissão
            if($user->can('resultado.destroy')) {
                // $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';
                $html = '<a href="destroy/' . $row->id . '" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-delete"></i> Remover</a>';
            }
            
            # retorno
            return $html;
        })->make(true);
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
            $gol = $this->service->store($data);

            #Retorno para a view
            return response()->json(['success' => true, 'data' => $gol]);
        } catch (ValidatorException $e) {
            return response()->json(['success' => false, 'msg' => $this->validator->errors()]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
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
            $gol = $this->repository->find($id);

            # verificando se o registro foi recuperado
            if(!$gol) {
                throw new \Exception('Gol não encontrado!');
            }

            # Recuperando o id da partida
            $idPartida = $gol->partida->id;

            # Removendo o registro do banco de dados
            $this->repository->delete($gol->id);

            #Retorno para a view
            return response()->json(['success' => true, 'data' => $idPartida]);
        } catch (\Throwable $e) {
            return  response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * @param $idPartida
     * @return mixed
     */
    public function conclude($idPartida)
    {
        try {
            #Executando a ação
            $this->service->conclude($idPartida);

            #Retorno para a view
            return response()->json(['success' => true]);
        } catch (ValidatorException $e) {
            return response()->json(['success' => false, 'msg' => $this->validator->errors()]);
        } catch (\Throwable $e) { dd($e);
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getTimes(Request $request)
    {
        try {
            # Recuperando a requisição
            $data = $request->get('data');

            # Recuperando a partida
            $partida = $this->partidasRepository->find($data);

            # verificando se o registro foi recuperado
            if(!$partida) {
                throw new \Exception('Times não encontrados!');
            }

            # Array que armazenará os times
            $times = [];

            # Atribuindo o time da casa
            $times[0] = $partida->casa;

            # Atribuindo o time de fora
            $times[1] = $partida->fora;

            #Retorno para a view
            return response()->json(['success' => true, 'data' => $times]);
        } catch (\Throwable $e) {
            return  response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * @param $idPartida
     * @return mixed
     */
    public function getResultado($idPartida)
    {
        try {
            # Recuperando o resultado da partida
            $resultado = \DB::table('partidas')
                ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
                ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
                ->where('partidas.id', $idPartida)
                ->select([
                    'time_casa.nome as time_casa',
                    'time_fora.nome as time_fora',
                    'partidas.processada_id',
                    \DB::raw("(SELECT COUNT(gols.id) FROM gols WHERE gols.partida_id = partidas.id AND gols.time_id = time_casa.id) as gols_casa"),
                    \DB::raw("(SELECT COUNT(gols.id) FROM gols WHERE gols.partida_id = partidas.id AND gols.time_id = time_fora.id) as gols_fora")
                ])
                ->get();

            #Retorno para a view
            return response()->json(['success' => true, 'data' => $resultado]);
        } catch (\Throwable $e) {
            return  response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
