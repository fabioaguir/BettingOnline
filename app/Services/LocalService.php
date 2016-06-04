<?php

namespace Softage\Services;

use Softage\Repositories\LocalRepository;
use Softage\Entities\Local;

class LocalService
{
    /**
     * @var LocalRepository
     */
    private $repository;

    /**
     * @param LocalRepository $repository
     */
    public function __construct(LocalRepository $repository)
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
        $local = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$local) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $local;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Local
    {
        #Salvando o registro pincipal
        $local =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$local) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $local;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Local
    {
        #Atualizando no banco de dados
        $local = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$local) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $local;
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
            $result[strtolower($model)] = $nameModel::lists('nome', 'id');
        }

        #retorno
        return $result;
    }
}