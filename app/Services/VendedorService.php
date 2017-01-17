<?php

namespace Softage\Services;

use Softage\Repositories\ArrecadacoesRepository;
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
     * @var ArrecadacoesRepository
     */
    private $repoArrecadacoes;

    /**
     * VendedorService constructor.
     * @param VendedorRepository $repository
     * @param ConfVendasRepository $repoConfVendas
     * @param ArrecadacoesRepository $repoArrecadacoes
     * 
     */
    public function __construct(VendedorRepository $repository, 
                                ConfVendasRepository $repoConfVendas,
                                ArrecadacoesRepository $repoArrecadacoes)
    {
        $this->repository = $repository;
        $this->repoConfVendas = $repoConfVendas;
        $this->repoArrecadacoes = $repoArrecadacoes;
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

        $this->tratamentoCampos($data);

        $codigo = \DB::table('pessoas')->max('codigo');
        $codigoMax = $codigo != null ? $codigoMax = $codigo + 1 : $codigoMax = "1";
        
        #Salvando o registro pincipal
        $data['codigo'] = $codigoMax;
        $data['tipo_pessoa_id'] = '1';
        $vendedor =  $this->repository->create($data);

        $dateObj = new \DateTime('now');

        $data['config']['vendedor_id']= $vendedor->id;
        $data['config']['status_id']= '1';
        $data['config']['data'] = $dateObj->format('Y-m-d');
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
        $data['data']= $dateObj->format('Y-m-d');

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
        $this->tratamentoCampos($data);

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

        //Recuperando a data de hoje
        $date = new \DateTime('now');

        # Criando uma nova configuração de vendas
        $dadosConfvendas = array();
        $dadosConfvendas['limite_vendas'] = $result->limite_vendas;
        $dadosConfvendas['comissao'] = $result->comissao;
        $dadosConfvendas['cotacao'] = $result->cotacao;
        $dadosConfvendas['tipo_cotacao_id'] = $result->tipo_cotacao_id;
        $dadosConfvendas['vendedor_id'] = $result->vendedor_id;
        $dadosConfvendas['status_id'] = '1';
        $dadosConfvendas['data'] = $date->format('Y-m-d');

        //salvando o registro no banco de configuração de vendas
        $this->repoConfVendas->create($dadosConfvendas);

        //Pegando o total das vendas
        $totalVendido = \DB::table('vendas')
            ->join('conf_vendas', 'conf_vendas.id', '=', 'vendas.conf_venda_id')
            ->join('status_vendas', 'status_vendas.id', '=', 'vendas.status_v_id')
            ->where('conf_vendas.id', '=', $id)
            ->where('status_vendas.id', '=', '1')
            ->groupBy('vendas.conf_venda_id')
            ->select([
                \DB::raw("SUM(vendas.valor_total) as total_vendido")
            ])->get();

        #pegando sessão de usuário
        $user = \Auth::user();

        //pegando data atual
        $dateObj = new \DateTime('now');

        //Criando array de dados para insert de arrecadações
        $dadosArrecadacoes = array();
        $dadosArrecadacoes['user_id'] = $user->id;
        $dadosArrecadacoes['vendedor_id'] = $result->vendedor_id;
        $dadosArrecadacoes['valor'] = count($totalVendido) > 0 ? $totalVendido[0]->total_vendido : "0.00";
        $dadosArrecadacoes['data'] = $dateObj->format('Y-m-d');
        $dadosArrecadacoes['hora'] = date("H:i:s", mktime(gmdate("H")-3, gmdate("i"), gmdate("s")));

        //Dando insert em arrecadações
        $arrecadacoes = $this->repoArrecadacoes->create($dadosArrecadacoes);
        
        # Verificando se a execução foi bem sucessida
        if(!$result || !$arrecadacoes) {
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