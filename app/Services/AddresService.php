<?php

namespace Softage\Services;

use Softage\Repositories\AddresRepository;
use Softage\Entities\Addres;

class AddresService
{
    /**
     * @var AddresRepository
     */
    private $repository;

    /**
     * @param AddresRepository $repository
     */
    public function __construct(AddresRepository $repository)
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
        $address = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$address) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $address;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Addres
    {
        #Salvando o registro pincipal
        $address =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$address) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $address;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Addres
    {
        #Atualizando no banco de dados
        $address = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$address) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $address;
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