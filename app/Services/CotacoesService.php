<?php

namespace Softage\Services;

use Softage\Repositories\CotacoesRepository;
use Softage\Entities\Cotacoes;

class CotacoesService
{
    use TraitService;

    /**
     * @var CotacoesRepository
     */
    private $repository;

    /**
     * @param CotacoesRepository $repository
     */
    public function __construct(CotacoesRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param array $data
     * @return Cotacoes
     * @throws \Exception
     */
    public function store(array $data) : Cotacoes
    {
        # Aplicando regras de negócios
        $this->rnFieldsForeignKey($data);
        
        #Salvando o registro pincipal
        $cotacao =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$cotacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $cotacao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Cotacoes
     * @throws \Exception
     */
    public function update(array $data, int $id) : Cotacoes
    {
        #Atualizando no banco de dados
        $cotacao = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$cotacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $cotacao;
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