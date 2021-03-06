<?php

namespace Softage\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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
        'Modalidades'
    ];

    private $loadFields2 = [
        'Status',
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
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->join('times as time_casa', 'time_casa.id', '=', 'partidas.time_casa_id')
            ->join('times as time_fora', 'time_fora.id', '=', 'partidas.time_fora_id')
            ->join('status', 'status.id', '=', 'cotacoes.status_id')
            ->select([
                'cotacoes.id',
                'modalidades.nome',
                \DB::raw("concat(time_casa.nome,' x ',time_fora.nome) as partida"),
                \DB::raw("to_char(partidas.data, 'DD/MM/YYYY') as data"),
                'cotacoes.valor',
                'status.nome as status'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Html de retorno
            $html = "";

            # Recuperando o usuário;
            $user = Auth::user();

            # Checando permissão
            if($user->can('cotacao.update')) {
                # Html de retorno
                $html = '<a href="edit/' . $row->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';
            }

            # Recuperando a cotação
            $cotacao = $this->repository->find($row->id);
            
            # Validando a possibilidade de remoção
            if(!count($cotacao->apostas) > 0) {
                # Checando permissão
                if($user->can('cotacao.destroy')) {
                    $html .= '<a href="destroy/' . $row->id . '" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-delete"></i> Remover</a>';
                }
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
        $loadFields2 = $this->service->load2($this->loadFields2);

        #Retorno para view
        return view('cotacoes.create', compact('loadFields', 'loadFields2'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createMultiplo()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);
        $loadFields2 = $this->service->load2($this->loadFields2);

        $modalidades = \DB::table('modalidades')->orderBy('modalidades.id', 'asc')->get();

        #Retorno para view
        return view('cotacoes.createMultiplo', compact('loadFields', 'modalidades', 'loadFields2'));
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
     * @param Request $request
     * @return $this|array|\Illuminate\Http\RedirectResponse
     */
    public function storeMultiplo(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();
            
            #Executando a ação
            $this->service->storeMultiplo($data);

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
            $model = $this->repository->with('status', 'partida')->find($id);
            
            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);
            $loadFields2 = $this->service->load2($this->loadFields2);

            #retorno para view
            return view('cotacoes.edit', compact('model', 'loadFields', 'loadFields2'));
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
