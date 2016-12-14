<?php

namespace Softage\Http\Controllers;

use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Softage\Http\Requests;
use Softage\Http\Controllers\Controller;
use Softage\Services\UserService;
use Softage\Validators\UserValidator;
use Yajra\Datatables\Datatables;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * @var UserValidator
     */
    private $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Role',
        'Permission'
    ];

    /**
     * @param UserService $service
     * @param UserValidator $validator
     */
    public function __construct(UserService $service, UserValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $users = \DB::table('users')->select(['id', 'name', 'email']);

        #Editando a grid
        return Datatables::of($users)->addColumn('action', function ($row) {
            # Html de retorno
            $html = "";

            # Recuperando o usuário;
            $user = Auth::user();

            # Checando permissão
            //if($user->can('usuario.update')) {
            if(true) {
                $html .= '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
            }

            return $html;
        })->make(true);
    }

    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('user.create', compact('loadFields'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
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
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) { dd($e->getMessage());
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
            #Recuperando o crud
            $user = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('user.edit', compact('user', 'loadFields'));
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
}
