<?php

namespace Softage\Uteis;


use Softage\Entities\Apostas;

class AlgForSimple extends AlgResponsibility
{
    /**
     * @var AlgResponsibility
     */
    private $sucessor;

    /**
     * AlgForSimple constructor.
     */
    public function __construct()
    {
        $this->setSucessor(new AlgForMultiple());
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
        if($aposta->venda->tipo_aposta_id !== 1) {
            # Passando para o próxima na cadeia
            $this->sucessor->executeResponsibility($aposta);
        }
        
        # Recuperando a venda
        $venda = $aposta->venda;

        # Setando o o status de premiada da venda
        if($venda->premiacao_id) {
            $venda->premiacao_id = 1;
        }

        # Setando o valor de retorno
        $venda->retorno += $aposta->valor * $aposta->cotacao->valor;
        $venda->save();

        # Alterando o status de premiada da aposta
        $aposta->premiada = 1;
        $aposta->save();

        # Retorno
        return true;
    }
}