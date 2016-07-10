<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Http\Requests;
use Softage\Http\Controllers\Controller;
use Softage\Repositories\TipoCotacaoRepository;

class DefaultController extends Controller
{

    /**
     * @var TipoCotacaoRepository
     */
    private $TipoCotacaoRepository;
    
    /**
     * DefaultController constructor.
     * @param TipoCotacaoRepository $TipoCotacaoRepository
     */
    public function __construct(TipoCotacaoRepository $TipoCotacaoRepository)
    {
        $this->TipoCotacaoRepository = $TipoCotacaoRepository;
    }
    
    public function index()
    {
        return view('default.index');
    }

    public function allTipoCotacao()
    {
        
        $tipoCotacaoes = $this->TipoCotacaoRepository->all();
        
        return compact('tipoCotacaoes');
    }
}
