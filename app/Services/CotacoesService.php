<?php

namespace Softage\Services;

use Softage\Repositories\CotacoesRepository;
use Softage\Entities\Cotacoes;
use Softage\Repositories\PartidasRepository;

class CotacoesService
{
    use TraitService;

    /**
     * @var CotacoesRepository
     */
    private $repository;

    /**
     * @var PartidasRepository
     */
    private $partidasRepository;

    /**
     * @param CotacoesRepository $repository
     */
    public function __construct(CotacoesRepository $repository, PartidasRepository $partidasRepository)
    {
        $this->repository = $repository;
        $this->partidasRepository = $partidasRepository;
    }
    
    /**
     * @param array $data
     * @return Cotacoes
     * @throws \Exception
     */
    public function store(array $data) : Cotacoes
    {
        # Aplicando regras de negócios
        $this->rnFieldsForeignKey($data);
        
        #Salvando o registro pincipal
        $cotacao =  $this->repository->create($data);

        //Valida se o time casa está na lista de times em alta
        $validarTimeAltaCasa = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_casa', '=', true)
            ->first();


        //Valida se o time fora está na lista de times em alta
        $validarTimeAltaFora = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_fora', '=', true)
            ->first();

        //Caso o time casa ou fora esteja na lista de times em alta, a partida recebe status de partida multipla
        if($validarTimeAltaCasa != null && $validarTimeAltaFora != null) {
            $diferenca = abs($validarTimeAltaCasa->valor - $validarTimeAltaFora->valor);
            $partida = $this->partidasRepository->find($data['partida_id']);

            if($diferenca > 0.50) {
                $partida->simples = false;
            } else {
                $partida->simples = true;
            }

            $partida->save();
        }

        #Verificando se foi criado no banco de dados
        if(!$cotacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $cotacao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Cotacoes
     * @throws \Exception
     */
    public function update(array $data, int $id) : Cotacoes
    {
        #Atualizando no banco de dados
        $cotacao = $this->repository->update($data, $id);

        //Valida se o time casa está na lista de times em alta
        $validarTimeAltaCasa = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_casa', '=', true)
            ->first();


        //Valida se o time fora está na lista de times em alta
        $validarTimeAltaFora = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_fora', '=', true)
            ->first();

        //Caso o time casa ou fora esteja na lista de times em alta, a partida recebe status de partida multipla
        if($validarTimeAltaCasa != null && $validarTimeAltaFora != null) {
            $diferenca = abs($validarTimeAltaCasa->valor - $validarTimeAltaFora->valor);
            $partida = $this->partidasRepository->find($data['partida_id']);

            if($diferenca > 0.50) {
                $partida->simples = false;
            } else {
                $partida->simples = true;
            }

            $partida->save();
        }

        #Verificando se foi atualizado no banco de dados
        if(!$cotacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $cotacao;
    }

    /**
     * @param array $models
     * @return array
     */
    public function load(array $models, $ajax = false) : array
    {
        #Declarando variáveis de uso
        $result    = [];
        $expressao = [];
        #Criando e executando as consultas
        foreach ($models as $model) {
            # separando as strings
            $explode   = explode("|", $model);
            # verificando a condição
            if(count($explode) > 1) {
                $model     = $explode[0];
                $expressao = explode(",", $explode[1]);
            }
            #qualificando o namespace
            $nameModel = "\\Softage\\Entities\\$model";
            #Verificando se existe sobrescrita do nome do model
            //$model     = isset($expressao[2]) ? $expressao[2] : $model;
            if ($ajax) {
                if(count($expressao) > 0) {
                    switch (count($expressao)) {
                        case 1 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}()->orderBy('nome', 'asc')->get(['nome', 'id']);
                            break;
                        case 2 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->orderBy('nome', 'asc')->get(['nome', 'id']);
                            break;
                        case 3 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1], $expressao[2])->orderBy('nome', 'asc')->get(['nome', 'id']);
                            break;
                    }
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::orderBy('nome', 'asc')->get(['nome', 'id']);
                }
            } else {
                if(count($expressao) > 1) {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->orderBy('nome', 'asc')->lists('nome', 'id');
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::orderBy('nome', 'asc')->lists('nome', 'id');
                }
            }
            # Limpando a expressão
            $expressao = [];
        }
        #retorno
        return $result;
    }

    /**
     * @param array $models
     * @return array
     */
    public function load2(array $models, $ajax = false) : array
    {
        #Declarando variáveis de uso
        $result    = [];
        $expressao = [];

        #Criando e executando as consultas
        foreach ($models as $model) {
            # separando as strings
            $explode   = explode("|", $model);

            # verificando a condição
            if(count($explode) > 1) {
                $model     = $explode[0];
                $expressao = explode(",", $explode[1]);
            }

            #qualificando o namespace
            $nameModel = "\\Softage\\Entities\\$model";

            #Verificando se existe sobrescrita do nome do model
            $model     = isset($expressao[2]) ? $expressao[2] : $model;

            if ($ajax) {
                if(count($expressao) > 1) {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->get(['nome', 'id']);
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::get(['nome', 'id']);
                }
            } else {
                if(count($expressao) > 1) {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->lists('nome', 'id');
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::lists('nome', 'id');
                }
            }

            # Limpando a expressão
            $expressao = [];
        }

        #retorno
        return $result;
    }
}