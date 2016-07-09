<?php

namespace Softage\Services;

use Softage\Repositories\ConfVendasRepository;
use Softage\Repositories\VendedorRepository;
use Softage\Entities\Vendedor;

class VendedorService
{
    /**
     * @var VendedorRepository
     */
    private $repository;

    /**
     * @var ConfVendasRepository
     */
    private $repoConfVendas;

    /**
     * @param VendedorRepository $repository
     */
    public function __construct(VendedorRepository $repository, ConfVendasRepository $repoConfVendas)
    {
        $this->repository = $repository;
        $this->repoConfVendas = $repoConfVendas;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
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
    public function store(array $data) : Vendedor
    {
        #Salvando o registro pincipal
        $vendedor =  $this->repository->create($data);
        $data['config']['vendedor_id']= $vendedor->id;
        $data['config']['status_id']= '1';

        $confVendas = $this->repoConfVendas->create($data['config']);
        

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
    public function update(array $data, int $id) : Vendedor
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