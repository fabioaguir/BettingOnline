<?php

namespace Softage\Services;

use Softage\Repositories\ServiceRepository;
use Softage\Entities\Service;

class ServiceService
{
    /**
     * @var ServiceRepository
     */
    private $repository;

    /**
     * @param ServiceRepository $repository
     */
    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $service = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$service) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $service;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Service
    {
        #Salvando o registro pincipal
        $service =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$service) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $service;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Service
    {
        #Atualizando no banco de dados
        $service = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$service) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $service;
    }

    /**
     * @param array $models
     * @return array
     */
    public function load(array $models) : array
    {
        #Declarando variáveis de uso
        $result = [];

        #Criando e executando as consultas
        foreach ($models as $model) {
            #qualificando o namespace
            $nameModel = "Softage\\Entities\\$model";

            #Recuperando o registro e armazenando no array
            $result[strtolower($model)] = $nameModel::lists('sev_name', 'id');
        }

        #retorno
        return $result;
    }
}