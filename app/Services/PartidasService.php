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

        //Valida se o time casa está na lista de times em alta
        $validarTimeAltaCasa = \DB::table('times')->join('times_alta', 'times_alta.time_id', '=', 'times.id')
            ->where('times.id', '=', $data['time_casa_id'])->get();

        //Valida se o time fora está na lista de times em alta
        $validarTimeAltaFora = \DB::table('times')->join('times_alta', 'times_alta.time_id', '=', 'times.id')
            ->where('times.id', '=', $data['time_fora_id'])->get();

        //Caso o time casa ou fora esteja na lista de times em alta, a partida recebe status de partida multipla
        if(count($validarTimeAltaCasa) >= 1 || count($validarTimeAltaFora) >= 1) {
            $data['multipla'] = 1;
        } else {
            $data['multipla'] = 0;
        }

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