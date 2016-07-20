<?php

namespace Softage\Services;

use Softage\Repositories\ArrecadadorRepository;
use Softage\Entities\Arrecadador;

class ArrecadadorService
{
    /**
     * @var ArrecadadorRepository
     */
    private $repository;

    /**
     * @param ArrecadadorRepository $repository
     */
    public function __construct(ArrecadadorRepository $repository)
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
            'status'
        ];
        
        #Recuperando o registro no banco de dados
        $endereco = $this->repository->find($id);

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
    public function store(array $data) : Arrecadador
    {
        $codigo = \DB::table('pessoas')->max('codigo');
        $codigoMax = $codigo != null ? $codigoMax = $codigo + 1 : $codigoMax = "1";

        #Salvando o registro pincipal
        $data['codigo'] = $codigoMax;
        $vendedor =  $this->repository->create($data);
        
        #Verificando se foi criado no banco de dados
        if(!$vendedor) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $vendedor;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Arrecadador
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