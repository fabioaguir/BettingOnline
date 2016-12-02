<?php

namespace Softage\Services;

/**
 * Class TraitService
 * @package Softage\Services
 */
trait TraitService
{
    /**
     * @param array $data
     * @return array
     */
    public function rnFieldsForeignKey(array &$data)
    {
        # Tratamento de campos de chaves estrangeira

        if(isset($data['limite_valor_aposta']) && $data['limite_valor_aposta'] == "") {
            $data['limite_valor_aposta'] = null;
        }

        foreach ($data as $key => $value) {
            if(is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    $explodeKey2 = explode("_", $key2);

                    if ($explodeKey2[count($explodeKey2) -1] == "id" && $value2 == null ) {
                        $data[$key][$key2] = null;
                    }
                }
            }

            $explodeKey = explode("_", $key);

            if ($explodeKey[count($explodeKey) -1] == "id" && $value == null ) {
                $data[$key] = null;
            }
        }

        #Retorno
        return $data;
    }
}