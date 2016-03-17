<?php

namespace Seracademico\Services;

use Seracademico\Repositories\DisciplinaRepository;
use Seracademico\Entities\Disciplina;

class DisciplinaService
{
    /**
     * @var DisciplinaRepository
     */
    private $repository;

    /**
     * @param DisciplinaRepository $repository
     */
    public function __construct(DisciplinaRepository $repository)
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
        $disciplina = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$disciplina) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $disciplina;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Disciplina
    {
        #Salvando o registro pincipal
        $disciplina =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$disciplina) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $disciplina;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Disciplina
    {
        #Atualizando no banco de dados
        $disciplina = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$disciplina) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $disciplina;
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
            $nameModel = "Seracademico\\Entities\\$model";

            #Recuperando o registro e armazenando no array
            $result[strtolower($model)] = $nameModel::lists('nome', 'id');
        }

        #retorno
        return $result;
    }
}