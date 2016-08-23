<?php

namespace Softage\Services;

use Softage\Repositories\CotacoesRepository;
use Softage\Entities\Cotacoes;
use Softage\Repositories\PartidasRepository;

class CotacoesService
{
    use TraitService;

    /**
     * @var CotacoesRepository
     */
    private $repository;

    /**
     * @var PartidasRepository
     */
    private $partidasRepository;

    /**
     * @param CotacoesRepository $repository
     */
    public function __construct(CotacoesRepository $repository, PartidasRepository $partidasRepository)
    {
        $this->repository = $repository;
        $this->partidasRepository = $partidasRepository;
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

        //Valida se o time casa está na lista de times em alta
        $validarTimeAltaCasa = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_casa', '=', true)
            ->get();


        //Valida se o time fora está na lista de times em alta
        $validarTimeAltaFora = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_fora', '=', true)
            ->get();

        //Caso o time casa ou fora esteja na lista de times em alta, a partida recebe status de partida multipla
        if(count($validarTimeAltaCasa) >= 1 && count($validarTimeAltaFora) >= 1) {
            $diferenca = abs($validarTimeAltaCasa[0]->valor - $validarTimeAltaFora[0]->valor);
            $partida = $this->partidasRepository->find($data['partida_id']);

            if($diferenca > 0.50) {
                $partida->multipla = true;
            } else {
                $partida->multipla = false;
            }

            $partida->save();
        }

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

        //Valida se o time casa está na lista de times em alta
        $validarTimeAltaCasa = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_casa', '=', true)
            ->get();


        //Valida se o time fora está na lista de times em alta
        $validarTimeAltaFora = \DB::table('cotacoes')
            ->join('modalidades', 'modalidades.id', '=', 'cotacoes.modalidade_id')
            ->join('partidas', 'partidas.id', '=', 'cotacoes.partida_id')
            ->where('partidas.id', '=', $data['partida_id'])
            ->where('modalidades.t_fora', '=', true)
            ->get();

        //Caso o time casa ou fora esteja na lista de times em alta, a partida recebe status de partida multipla
        if(count($validarTimeAltaCasa) >= 1 && count($validarTimeAltaFora) >= 1) {
            $diferenca = abs($validarTimeAltaCasa[0]->valor - $validarTimeAltaFora[0]->valor);
            $partida = $this->partidasRepository->find($data['partida_id']);

            if($diferenca > 0.50) {
                $partida->multipla = true;
            } else {
                $partida->multipla = false;
            }

            $partida->save();
        }

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