<?php

namespace Softage\Uteis;


use Softage\Entities\Apostas;
use Softage\Repositories\ParametrosRepository;

class AlgForSevenSort extends AlgResponsibility
{
    /**
     * @var AlgResponsibility
     */
    private $sucessor;

    /**
     * @var ParametrosRepository
     */
    private $parametrosRepository;

    /**
     * AlgForSimple constructor.
     */
    public function __construct(ParametrosRepository $parametrosRepository)
    {
        $this->parametrosRepository = $parametrosRepository;
    }

    /**
     * @param AlgResponsibility $sucessor
     */
    public function setSucessor(AlgResponsibility $sucessor)
    {
        $this->sucessor = $sucessor;
    }

    /**
     * @param Apostas $aposta
     * @return bool
     */
    public function executeResponsibility(Apostas $aposta)
    {
        # verificando se o algoritimo é simples
        if($aposta->venda->tipo_aposta_id !== 3) {
            # Passando para o próxima na cadeia
            return $this->sucessor->executeResponsibility($aposta);
        }

        # Verificando se a partida foi cancelada
        if($aposta->partida->status_id == 1) {
            # Atualizando a aposta como premiada
            $aposta->premiada = 1;
            $aposta->save();
        }

        # Recuperando a venda
        $venda = $aposta->venda;

        # Booleano e valor que determinará
        # se o bonus será acrescentado
        $isValorBonus = true;
        $valorBonus   = 0;

        # Verificando se as apostas da venda foram todas acertadas
        $apostasPremiadasDaVenda = $venda->apostas->filter(function ($apostaDaVenda) use ($aposta) {
            # Verificando se a aposta foi premiada
            if($apostaDaVenda->premiada !== 1) {
                # Retorno
                return false;
            }

            # Verificando se a partida foi cancelada
            if(!$apostaDaVenda->partida->status_id == 2) {
                # Não terá bonus acrescentado
                $isValorBonus = false;

                # Retorno
                return false;
            }

            # Retorno
            return true;
        });

        # Verificando se todas as apostas foram premiadas
        # Segundo a regra especificada nos requisitos
        if(count($venda->apostas) !== count($apostasPremiadasDaVenda) &&
            count(count($apostasPremiadasDaVenda)) !== 7) {
            return false;
        }

        # Variável que armazenará a soma do premio
        $somaValoresCotacao = 0;

        # Percorrendo as apostas para calcular o prêmio
        foreach($apostasPremiadasDaVenda as $aposta) {
            $somaValoresCotacao += $aposta->cotacao->valor;
        }

        # Recuperando o parametro
        $parametros = $this->parametrosRepository->all();

        # Tratando o valor do bonus
        if(count($parametros) > 0 && $isValorBonus) {
            $valorBonus = (double) $parametros->last()->premio_sete_da_sorte;
        }

        # Atualizando os dados da venda
        $venda->premiacao_id = 1;
        //$venda->retorno = ($venda->valor_total * $somaValoresCotacao) + $valorBonus; // somar com o valor do bonus por partida 7 da sorte
        $venda->save();

        # Retorno
        return true;
    }
}