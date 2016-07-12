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
     * @return Vendedor
     * @throws \Exception
     */
    public function store(array $data) : Vendedor
    {

        $codigo = \DB::table('vendedor')->max('codigo');
        $codigoMax = $codigo != null ? $codigoMax = $codigo + 1 : $codigoMax = "1";
        
        #Salvando o registro pincipal
        $data['codigo'] = $codigoMax;
        $vendedor =  $this->repository->create($data);

        $dateObj = new \DateTime('now');

        $data['config']['vendedor_id']= $vendedor->id;
        $data['config']['status_id']= '1';
        $data['config']['data']= $dateObj->format('d-m-Y');
        $data['config'] = $this->tratamentoCampos($data['config']);
        $confVendas = $this->repoConfVendas->create($data['config']);

        #Verificando se foi criado no banco de dados
        if(!$vendedor || !$confVendas) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $vendedor;
    }

    /**
     * @param array $data
     * @return bool|mixed
     * @throws \Exception
     */
    public function storeConfig(array $data)
    {
        #Salvando o registro pincipal

        $dateObj = new \DateTime('now');

        $data['status_id']= '1';
        $data['data']= $dateObj->format('d-m-Y');

        //buscando registro com status igual a 1
        $validacao = $this->repoConfVendas->findWhere(['status_id' => '1', 'vendedor_id' => $data['vendedor_id']]);

        //validando a consulta , caso seja verdadeiro o cadastro será interrompido
        if(count($validacao) > 0) {
            return false;
        }

        //salvando o registro no banco
        $confVendas = $this->repoConfVendas->create($data);

        #Verificando se foi criado no banco de dados
        if(!$confVendas) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $confVendas;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Vendedor
     * @throws \Exception
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
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function updateConfig(array $data)
    {
        #Atualizando no banco de dados
        $config = $this->repoConfVendas->update($data, $data['idConfig']);

        #Verificando se foi atualizado no banco de dados
        if(!$config) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $config;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function zerar(int $id)
    {
        #deletando o curso
        $result = $this->repoConfVendas->find($id);
        $result->status_id = '2';
        $result->save();
        
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
    public function load(array $models, $ajax = false) : array
    {
        #Declarando variáveis de uso
        $result    = [];
        $expressao = [];

        #Criando e executando as consultas
        foreach ($models as $model) {
            # separando as strings
            $explode   = explode("|", $model);

            # verificando a condição
            if(count($explode) > 1) {
                $model     = $explode[0];
                $expressao = explode(",", $explode[1]);
            }

            #qualificando o namespace
            $nameModel = "\\Softage\\Entities\\$model";

            #Verificando se existe sobrescrita do nome do model
            $model     = isset($expressao[2]) ? $expressao[2] : $model;

            if ($ajax) {
                if(count($expressao) > 1) {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->orderBy('nome', 'asc')->get(['nome', 'id']);
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::orderBy('nome', 'asc')->get(['nome', 'id']);
                }
            } else {
                if(count($expressao) > 1) {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->lists('nome', 'id');
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::lists('nome', 'id');
                }
            }

            # Limpando a expressão
            $expressao = [];
        }

        #retorno
        return $result;
    }

    /**
     * @param array $data
     * @return array
     */
    public function tratamentoCampos(array &$data)
    {
        # Tratamento de campos de chaves estrangeira
        foreach ($data as $key => $value) {

            if ($value == null) {
                unset($data[$key]);
            }
        }
        #Retorno
        return $data;
    }
}