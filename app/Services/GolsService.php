<?php

namespace Softage\Services;

use Softage\Entities\Gols;
use Softage\Repositories\GolsRepository;
use Softage\Repositories\PartidasRepository;
use Softage\Uteis\AlgForResult;

class GolsService
{
    use TraitService;

    /**
     * @var GolsRepository
     */
    private $repository;

    /**
     * @var PartidasRepository
     */
    private $partidasRepository;

    /**
     * @var AlgForResult
     */
    private $algForResult;

    /**
     * GolsService constructor.
     * @param GolsRepository $repository
     * @param PartidasRepository $partidasRepository
     * @param AlgForResult $algForResult
     */
    public function __construct(GolsRepository $repository, PartidasRepository $partidasRepository, AlgForResult $algForResult)
    {
        $this->repository = $repository;
        $this->partidasRepository = $partidasRepository;
        $this->algForResult = $algForResult;
    }

    /**
     * @param array $data
     * @return Gols
     * @throws \Exception
     */
    public function store(array $data) : Gols
    {
        # Aplicando regras de negócios
        $this->rnFieldsForeignKey($data);
        
        #Salvando o registro pincipal
        $gol =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$gol) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $gol;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Gols
     * @throws \Exception
     */
    public function update(array $data, int $id) : Gols
    {
        #Atualizando no banco de dados
        $gol = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$gol) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $gol;
    }

    /**
     * @param $idPartida
     * @return bool
     * @throws \Exception
     */
    public function conclude($idPartida)
    {
        # Recuperando a partida
        $partida = $this->partidasRepository->find($idPartida);

        # Verificando se a partida foi encontrada
        if(!$partida) {
            throw new \Exception("Partida não encontrada");
        }

        # Alterando o status da partida
        $partida->processada_id = 1;
        $partida->save();

        # Algoritmo para tratamento do resultado
        $this->algForResult->execute($partida);

        # Retorno
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