<?php
/**
 * Created by PhpStorm.
 * User: AndreyPriscila
 * Date: 12/10/2016
 * Time: 18:25
 */

namespace Softage\Uteis;

use Softage\Entities\Apostas;

/**
 * Class AlgResponsibility
 * @package Softage\Uteis
 */
abstract class AlgResponsibility
{
    public abstract function setSucessor(AlgResponsibility $sucessor);

    public abstract function executeResponsibility(Apostas $aposta);
}