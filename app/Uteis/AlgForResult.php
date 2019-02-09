<?php
namespace Softage\Uteis;


use Illuminate\Support\Collection;
use Softage\Entities\Partidas;
use Softage\Repositories\ModalidadesRepository;

class AlgForResult
{
    /**
     * @var ModalidadesRepository
     */
    private $modalidadesRepository;

    /**
     * @var AlgForSimple
     */
    private $algForSimple;

    /**
     * AlgForResult constructor.
     * @param ModalidadesRepository $modalidadesRepository
     */
    public function __construct(ModalidadesRepository $modalidadesRepository, AlgForSimple $algForSimple)
    {
        $this->modalidadesRepository = $modalidadesRepository;
        $this->algForSimple = $algForSimple;
    }

    /**
     * @param Partidas $partida
     * @return bool
     */
    public function execute(Partidas $partida)
    { 
        # Recuperando as modalidades compatíveis com a partida
        $modalidadesGenericas = $this->getModalidades($partida);

        # Recuperando as apostas
        $apostas = $partida->apostas;

        # Apostas premiadas
        # Filtro que recuperarão as apostas premiadas 
        $premiadas = $apostas->filter(function ($aposta) use($modalidadesGenericas) {
            # Verificando se existe alguma aposta premiada
            foreach ($modalidadesGenericas as $modalidade) {
                if($modalidade->id === $aposta->cotacao->modalidade->id) {
                    # Retorno caso verdadeiro
                    return true;
                }
            }

            # Retorno caso falso
            return false;
        });

        # Tratamendo das apostas premiadas
        foreach ($premiadas as $premiada) {
            # Iniciando a cadeia de algoritmos
            $this->algForSimple->executeResponsibility($premiada);
        }

        # retorno
        return true;
    }

    /**
     * @param Partidas $partida
     * @param $gols
     * @return array
     */
    private function getGolsThePartida(Partidas $partida, $gols)
    {
        # Definindo o resultado da partida
        # Recuperando a qtd de gols do time da casa
        $golsCasa = $gols->filter(function ($gol) use ($partida) { return $partida->casa->id == $gol->time_id; })->count();

        # Recuperando a qtd de gols do time visitante
        $golsFora = $gols->filter(function ($gol) use ($partida) { return $partida->fora->id == $gol->time_id; })->count();

        # Retorno do array
        return ['golsCasa' => $golsCasa, 'golsFora' => $golsFora];
    }

    private function getGolsTempos(Partidas $partida, $gols)
    {
        $golsCasaPrimeiroTempo = $gols->filter(function ($gol) use ($partida) { return ($partida->casa->id == $gol->time_id) && $gol->tempo_id = 1; })->count();
        $golsForaPrimeiroTempo = $gols->filter(function ($gol) use ($partida) { return ($partida->fora->id == $gol->time_id) && $gol->tempo_id = 1; })->count();

        $golsCasaSegundoTempo = $gols->filter(function ($gol) use ($partida) { return ($partida->casa->id == $gol->time_id) && $gol->tempo_id = 2; })->count();
        $golsForaSegundoTempo = $gols->filter(function ($gol) use ($partida) { return ($partida->fora->id == $gol->time_id) && $gol->tempo_id = 2; })->count();

        return [
            'golsCasaPrimeiroTempo' => $golsCasaPrimeiroTempo,
            'golsForaPrimeiroTempo' => $golsForaPrimeiroTempo,
            'golsCasaSegundoTempo' => $golsCasaSegundoTempo,
            'golsForaSegundoTempo' => $golsForaSegundoTempo
        ];
    }

    /**
     * @param Partidas $partida
     */
    private function getModalidadesByStatus(Partidas $partida)
    {
        # Variávies para armazenamento de resultados genéricos
        $vCasa = false; $vFora = false; $empate = false;

        # Recuperando todas as modalidades
        $modalidades = $this->modalidadesRepository->all();

        # Recuperando os gols da partida
        $arrayGols = $this->getGolsThePartida($partida, $partida->gols);

        # Verificando qual foi o tipo de resultado genérico
        if($arrayGols['golsCasa'] > $arrayGols['golsFora']) {
            # Se a vitória for do time da casa
            $vCasa = true;
        } elseif ($arrayGols['golsCasa'] < $arrayGols['golsFora']) {
            # Se a vitória for do visitante
            $vFora = true;
        } else {
            # Se for empate
            $empate = true;
        }

        # Ação que verifica as modalidades compatíveis com
        # o resultado da partida (Verificando as modalidades Genéricas)
        $modalidadesByStatus = $modalidades->filter(function ($modalidade) use ($vCasa, $vFora, $empate, $partida) {
            # Filtrando as modalidades da partida pela modalidade premiada em questão
            $resultFilterCotacao = $partida->cotacoes->filter(function ($cotacao) use ($modalidade) {
                return $cotacao->modalidade->id == $modalidade->id;
            });

            # verificando se a modalidade está configurada para essa partida
            if(count($resultFilterCotacao) !== 1) {
                return false;
            }

            # Veridicando se a modalidade atende os requisitos
            if(($vCasa == true && $vCasa == $modalidade->vitoria_casa) ||
                ($vFora == true && $vFora == $modalidade->vitoria_fora) ||
                ($empate == true && $empate == $modalidade->empate)) {
                return true;
            }
        });

        # Retorno das modalidades
        return $modalidadesByStatus;
    }

    /**
     * @param Partidas $partida
     * @return mixed
     */
    private function getModalidadesByInduction(Partidas $partida)
    {
        # Recuperando todas as modalidades
        $modalidades = $this->modalidadesRepository->all();

        # Recuperando os gols da partida
        $arrayGols = $this->getGolsThePartida($partida, $partida->gols);

        # Recuperando os gols da partida por tempo
        $arrayGolsPorTempo = $this->getGolsTempos($partida, $partida->gols);

        # Ação que verifica as modalidades as modalidades
        # compatíveis com indução são retornadas
        $modalidadesByInduction = $modalidades->filter(function ($modalidade) use ($arrayGols, $partida, $arrayGolsPorTempo) {
            # Filtrando as modalidades da partida pela modalidade premiada em questão
            $resultFilterCotacao = $partida->cotacoes->filter(function ($cotacao) use ($modalidade) {
                return $cotacao->modalidade->id == $modalidade->id;
            });

            # verificando se a modalidade está configurada para essa partida
            if(count($resultFilterCotacao) !== 1) {
                return false;
            }

            # Recuperando o tipo de indução
            $tipoInducaoId = $modalidade->tipo_inducao_id == null ? 0 : $modalidade->tipo_inducao_id;

            # Variável que armazenará o retorno booleano
            $resultBoolean = false;

            # escolha da ação correspondente
            switch($tipoInducaoId) {
                case 1 :
                    if($arrayGols['golsCasa'] > $modalidade->gols_inducao) $resultBoolean = true;
                    break;
                case 2 :
                    if($arrayGols['golsCasa'] < $modalidade->gols_inducao)  $resultBoolean = true;
                    break;
                case 3 :
                    if($arrayGols['golsFora'] > $modalidade->gols_inducao) $resultBoolean = true;
                    break;
                case 4 :
                    if($arrayGols['golsFora'] < $modalidade->gols_inducao)  $resultBoolean = true;
                    break;
                case 5 :
                    if(($arrayGols['golsCasa'] + $arrayGols['golsFora']) > $modalidade->gols_inducao) $resultBoolean = true;
                    break;
                case 6 :
                    if(($arrayGols['golsCasa'] + $arrayGols['golsFora']) < $modalidade->gols_inducao) $resultBoolean = true;
                    break;
                case 7 :
                    if(($arrayGols['golsCasa'] > 0) && ($arrayGols['golsFora'] > 0)) $resultBoolean = true;
                    break;
                case 8 :
                    if(($arrayGols['golsCasa'] == 0) && ($arrayGols['golsFora'] == 0)) $resultBoolean = true;
                    break;
                case 9 :
                    if(($arrayGols['golsCasa'] > 0 && $arrayGols['golsFora'] > 0) && ($arrayGols['golsCasa'] > $arrayGols['golsFora'])) $resultBoolean = true;
                    break;
                case 10 :
                    if(($arrayGols['golsCasa'] > 0 && $arrayGols['golsFora'] > 0) && ($arrayGols['golsCasa'] < $arrayGols['golsFora'])) $resultBoolean = true;
                    break;
                case 11 :
                    if(($arrayGolsPorTempo['golsCasaPrimeiroTempo'] > $arrayGolsPorTempo['golsForaPrimeiroTempo'])) $resultBoolean = true;
                    break;
                case 12 :
                    if(($arrayGolsPorTempo['golsCasaPrimeiroTempo'] < $arrayGolsPorTempo['golsForaPrimeiroTempo'])) $resultBoolean = true;
                    break;
                case 13 :
                    if(($arrayGolsPorTempo['golsCasaSegundoTempo'] > $arrayGolsPorTempo['golsForaSegundoTempo'])) $resultBoolean = true;
                    break;
                case 14 :
                    if(($arrayGolsPorTempo['golsCasaSegundoTempo'] < $arrayGolsPorTempo['golsForaSegundoTempo'])) $resultBoolean = true;
                    break;
            }

            # Retorno booleano
            return $resultBoolean;
        });

        # Retorno das modalidades
        return $modalidadesByInduction;
    }

    /**
     * @param Partidas $partida
     * @return mixed
     */
    private function getModalidadesByGols(Partidas $partida)
    {
        # Recuperando todas as modalidades
        $modalidades = $this->modalidadesRepository->all();

        # Recuperando os gols da partida
        $arrayGols = $this->getGolsThePartida($partida, $partida->gols);

        # Ação que verifica as modalidades compatíveis com
        # placares certos fixos
        $modalidadesByGols = $modalidades->filter(function ($modalidade) use($arrayGols, $partida) {
            # Filtrando as modalidades da partida pela modalidade premiada em questão
            $resultFilterCotacao = $partida->cotacoes->filter(function ($cotacao) use ($modalidade) {
                return $cotacao->modalidade->id == $modalidade->id;
            });

            # verificando se a modalidade está configurada para essa partida
            if(count($resultFilterCotacao) !== 1) {
                return false;
            }

            # Veridicando se a modalidade é por gols fixos
            if(is_numeric($modalidade->gols_casa) && is_numeric($modalidade->gols_fora)) {
                return (($modalidade->gols_casa == $arrayGols['golsCasa']) &&
                    ($modalidade->gols_fora == $arrayGols['golsFora']));
            }

            # Retorno booleano
            return false;
        });

        # Retorno das modalidades
        return $modalidadesByGols;
    }

    /**
     * @param Partidas $partida
     * @return Collection
     */
    private function getModalidades(Partidas $partida)
    {
        # Instância da coleção de modalidades
        $modalidades = new Collection();

        # Unions das modalidades recuperadas
        $modalidades = $modalidades->merge($this->getModalidadesByStatus($partida));
        $modalidades = $modalidades->merge($this->getModalidadesByInduction($partida));
        $modalidades = $modalidades->merge($this->getModalidadesByGols($partida));

        # retorno das modalidades
        return $modalidades;
    }
}