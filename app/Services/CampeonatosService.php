<?php

namespace Softage\Services;

use Softage\Repositories\CampeonatosRepository;
use Softage\Entities\Campeonatos;

class CampeonatosService
{
    /**
     * @var CampeonatosRepository
     */
    private $repository;

    /**
     * @param CampeonatosRepository $repository
     */
    public function __construct(CampeonatosRepository $repository)
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
            'partidas'
        ];
        
        #Recuperando o registro no banco de dados
        $campeonato = $this->repository->with($relacionamentos)->find($id);

        #Verificando se o registro foi encontrado
        if(!$campeonato) {
            throw new \Exception('Área não encontrada!');
        }

        #retorno
        return $campeonato;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Campeonatos
    {
        #Salvando o registro pincipal
        $campeonato =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$campeonato) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $campeonato;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Campeonatos
    {
        #Atualizando no banco de dados
        $campeonato = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$campeonato) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $campeonato;
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