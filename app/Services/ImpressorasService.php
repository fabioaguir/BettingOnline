<?php

namespace Softage\Services;

use Softage\Repositories\ImpressorasRepository;
use Softage\Entities\Impressoras;

class ImpressorasService
{
    /**
     * @var ImpressorasRepository
     */
    private $repository;

    /**
     * @param ImpressorasRepository $repository
     */
    public function __construct(ImpressorasRepository $repository)
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
        $relacionamentos = [
            'vendedores'
        ];
        
        #Recuperando o registro no banco de dados
        $endereco = $this->repository->with($relacionamentos)->find($id);

        #Verificando se o registro foi encontrado
        if(!$endereco) {
            throw new \Exception('Área não encontrada!');
        }

        #retorno
        return $endereco;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Impressoras
    {
        #Salvando o registro pincipal
        $endereco =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$endereco) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $endereco;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Impressoras
    {
        #Atualizando no banco de dados
        $endereco = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$endereco) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $endereco;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        #deletando o curso
        $result = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao tentar remover o responsável!');
        }

        #retorno
        return true;
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