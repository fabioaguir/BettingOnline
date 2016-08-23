<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Services\TimesAltaService;
use Softage\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Softage\Http\Requests\AreasCreateRequest;
use Softage\Http\Requests\AreasUpdateRequest;
use Yajra\Datatables\Datatables;
use \Illuminate\Support\Facades\Response;


class TimesAltaController extends Controller
{
    
    /**
     * @var TimesAltaService
     */
    private $service;
    

    /**
     * @var array
     */
    private $loadFields = [
        'Times'
    ];

    public function __construct(TimesAltaService $service)
    {
        $this->service = $service;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('timesAlta.index', compact('loadFields'));
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('times_alta')
            ->join('times', 'times.id', '=', 'times_alta.time_id')
            ->select([
                    'times_alta.id as id',
                    'times.nome as nome'
                ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = "";
            $html .= '<a href="delete/'.$row->id.'" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-edit"></i> Deletar</a> ';
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
            //$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Executando a ação
            $retorno = $this->service->store($data);

            if(!$retorno) {
                return Response::json(['success' => false,'msg' => 'Este time já está inserido na lista!']);
            }
            
            #Retorno para a view
            return Response::json(['success' => true,'msg' => 'Cadastro realizado com sucesso!']);
        } catch (ValidatorException $e) {
            return Response::json(['success' => false,'msg' => $e->getMessage()]);
        } catch (\Throwable $e) {print_r($e->getMessage()); exit;
            return Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function delete($id)
    {
        try {
            #Executando a ação
            $this->service->delete($id);

            #Retorno para a view
            return redirect()->back()->with("message", "Remoção realizada com sucesso!");
        } catch (\Throwable $e) { dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
