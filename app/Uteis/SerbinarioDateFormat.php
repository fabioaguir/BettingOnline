<?php

namespace Seracademico\Uteis;

use Carbon\Carbon;

class SerbinarioDateFormat
{
    /**
     * @param string $dateText
     * @return string
     */
    public static function toBrazil(string $dateText)
    {
        #Transformando em data
        $date = Carbon::createFromFormat('Y-m-d', $dateText);

        #retorno da data em portugues (string)
        return $date->format('d/m/Y');
    }
}