<?php

namespace Softage\Services;

use Softage\Repositories\GuestRepository;
use Softage\Entities\Guest;

class GuestService
{
    /**
     * @var GuestRepository
     */
    private $repository;

    /**
     * @param GuestRepository $repository
     */
    public function __construct(GuestRepository $repository)
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
        $guest = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$guest) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $guest;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Guest
    {
        #Salvando o registro pincipal
        $guest =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$guest) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $guest;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Guest
    {
        #Atualizando no banco de dados
        $guest = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$guest) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $guest;
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