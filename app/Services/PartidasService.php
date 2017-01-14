<?php

namespace Softage\Services;

use Softage\Repositories\PartidasRepository;
use Softage\Entities\Partidas;

class PartidasService
{
    use TraitService;

    /**
     * @var PartidasRepository
     */
    private $repository;

    /**
     * @param PartidasRepository $repository
     */
    public function __construct(PartidasRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param array $data
     * @return Partidas
     * @throws \Exception
     */
    public function store(array $data) : Partidas
    {
        # Aplicando regras de negócios
        $this->rnFieldsForeignKey($data);

        #Salvando o registro pincipal
        $partida['processada_id'] = 2;
        $partida =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$partida) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $partida;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Partidas
     * @throws \Exception
     */
    public function update(array $data, int $id) : Partidas
    {

        # Aplicando regras de negócios
        $this->rnFieldsForeignKey($data);

        #Atualizando no banco de dados
        $partida = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$partida) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $partida;
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
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}()->get(['nome', 'id']);
                            break;
                        case 2 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->get(['nome', 'id']);
                            break;
                        case 3 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1], $expressao[2])->get(['nome', 'id']);
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
    public function load2(array $models) : array
    {
        #Declarando variáveis de uso
        $result = [];

        #Criando e executando as consultas
        foreach ($models as $model) {
            #qualificando o namespace
            $nameModel = "Softage\\Entities\\$model";

            #Recuperando o registro e armazenando no array
            $result[strtolower($model)] = $nameModel::lists('nome', 'id');
        }

        #retorno
        return $result;
    }
}