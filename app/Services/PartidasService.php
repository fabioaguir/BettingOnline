<?php

namespace Softage\Services;

use Softage\Repositories\PartidasRepository;
use Softage\Entities\Partidas;

class PartidasService
{
    use TraitService;

    /**
     * @var PartidasRepository
     */
    private $repository;

    /**
     * @param PartidasRepository $repository
     */
    public function __construct(PartidasRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param array $data
     * @return Partidas
     * @throws \Exception
     */
    public function store(array $data) : Partidas
    {
        # Aplicando regras de negócios
        $this->rnFieldsForeignKey($data);

        #Salvando o registro pincipal
        $partida =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$partida) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $partida;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Partidas
     * @throws \Exception
     */
    public function update(array $data, int $id) : Partidas
    {
        #Atualizando no banco de dados
        $partida = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$partida) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $partida;
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