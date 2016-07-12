<?php

namespace Softage\Services;

use Softage\Repositories\ModalidadesRepository;
use Softage\Entities\Modalidades;

class ModalidadesService
{
    /**
     * @var ModalidadesRepository
     */
    private $repository;

    /**
     * @param ModalidadesRepository $repository
     */
    public function __construct(ModalidadesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Modalidades
     * @throws \Exception
     */
    public function store(array $data) : Modalidades
    {
        #Salvando o registro pincipal
        $modalidade =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$modalidade) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $modalidade;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Modalidades
     * @throws \Exception
     */
    public function update(array $data, int $id) : Modalidades
    {
        #Atualizando no banco de dados
        $modalidade = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$modalidade) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $modalidade;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        #deletando o curso
        $modalidade = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$modalidade) {
            throw new \Exception('Ocorreu um erro ao tentar remover a modalidade!');
        }

        #retorno
        return true;
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
            $model     = isset($expressao[2]) ? $expressao[2] : $model;

            if ($ajax) {
                if(count($expressao) > 1) {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->orderBy('nome', 'asc')->get(['nome', 'id']);
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::orderBy('nome', 'asc')->get(['nome', 'id']);
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