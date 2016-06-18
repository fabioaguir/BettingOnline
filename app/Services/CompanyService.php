<?php

namespace Softage\Services;

use Softage\Repositories\CompanyRepository;
use Softage\Entities\Company;

class CompanyService
{
    /**
     * @var CompanyRepository
     */
    private $repository;

    /**
     * @param CompanyRepository $repository
     */
    public function __construct(CompanyRepository $repository)
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
        $company = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$company) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $company;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Company
    {
        #Salvando o registro pincipal
        $company =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$company) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $company;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Company
    {
        #Atualizando no banco de dados
        $company = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$company) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $company;
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