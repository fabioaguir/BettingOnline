<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Softage\Http\Requests;
use Softage\Http\Controllers\Controller;
use Softage\Services\RoleService;
use Yajra\Datatables\Datatables;
use Prettus\Validator\Contracts\ValidatorInterface;

class RoleController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * @var array
     */
    private $loadFields = [
        'Permission'
    ];

    /**
     * RoleController constructor.
     * @param RoleService $service
     */
    public function __construct(RoleService $service)
    {
        $this->service   = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('role.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $roles = \DB::table('roles')->select(['id', 'name', 'description']);

        #Editando a grid
        return Datatables::of($roles)->addColumn('action', function ($role) {
            # Html de retorno
            $html = "";

            # Recuperando o usuário;
            $user = Auth::user();

            # Checando permissão
            if($user->can('role.update')) {
                $html .= '<a href="edit/'.$role->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
            }
            
            return $html;
        })->make(true);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields['permission'] = \DB::table('permissions')->select('id', 'name', 'model', 'slug')->get();
        $loadFields['model'] = \DB::table('permissions')->groupBy('model')->orderBy('model')->lists('model');
        
        #Retorno para view
        return view('role.create', compact('loadFields'));
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            #Recuperando a role
            $role = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields['permission'] = \DB::table('permissions')->select('id', 'name', 'model', 'slug')->get();
            $loadFields['model'] = \DB::table('permissions')->groupBy('model')->orderBy('model')->lists('model');

            #retorno para view
            return view('role.edit', compact('role', 'loadFields'));
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
