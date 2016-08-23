<?php

namespace Softage\Uteis;

use Carbon\Carbon;

class SerbinarioDateFormat
{
    /**
     * @param $dateText
     * @return string
     */
    public static function toBrazil($dateText, $type = false)
    {
        #Verificando se o tipo do dado é válido
        if(is_string($dateText) && $dateText != '0000-00-00' &&
            $dateText != '0000-00-00 00:00:00'  && $dateText != '00:00:00') {

            #Verificando se é só o para retorna a hora
            if($type == 'time') {
                #Transformando em data
                $date = Carbon::createFromFormat('H:i:s', $dateText);

                #retorno da hora em string
                return $date->format('H:i:s');
            }

            # Verificando se é só data
            if($type == 'date') {
                #Transformando em data
                $date = Carbon::createFromFormat('Y-m-d', $dateText);

                #retorno da data em portugues (string)
                return $date->format('d/m/Y');
            }
        }

        #retorno caso o valor passado não seja válido
        return null;
    }

    /**
     * @param $dateText
     * @param bool $type
     * @return null|string
     */
    public static function toUsa($dateText, $type = false)
    {
        #Verificando se o tipo do dado é válido
        if(is_string($dateText) && $dateText != "") {

            # Verificando se é só para retornar a data
            if($type == "date") {
                #Transformando em data
                $date = Carbon::createFromFormat('d/m/Y', $dateText);

                #retorno da data em inglês (string)
                return $date->format('Y-m-d');
            }
        }

        #retorno caso o valor passado não seja válido
        return null;
    }
}