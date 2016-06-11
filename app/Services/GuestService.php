<?php

namespace Softage\Services;

use Softage\Repositories\AddresRepository;
use Softage\Repositories\GuestRepository;
use Softage\Entities\Guest;

class GuestService
{
    /**
     * @var GuestRepository
     */
    private $repository;

    /**
     * @var AddresRepository
     */
    private $addressRepository;

    /**
     * GuestService constructor.
     * @param GuestRepository $repository
     * @param $addressRepository $addressRepository
     */
    public function __construct(GuestRepository $repository, AddresRepository $addressRepository)
    {
        $this->repository     = $repository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {

        $relacionamentos = [
            'address.state',
            'gender',
        ];
        
        #Recuperando o registro no banco de dados
        $guest = $this->repository->with($relacionamentos)->find($id);

        #Verificando se o registro foi encontrado
        if(!$guest) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $guest;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Guest
    {

        $data = $this->tratamentoCampos($data);

        $address = $this->addressRepository->create($data['address']);

        $data['gue_adr_id'] = $address->id;
        
        #Salvando o registro pincipal
        $guest =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$guest) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $guest;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Guest
    {

        $data = $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $guest = $this->repository->update($data, $id);
        //dd($guest);
        $address = $this->addressRepository->update($data['address'], $guest->address->id);

        #Verificando se foi atualizado no banco de dados
        if(!$guest || !$address) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $guest;
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
            $result[strtolower($model)] = $nameModel::lists('name', 'id');
        }

        #retorno
        return $result;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function tratamentoCampos($data)
    {
        #tratamento de datas do aluno
        $data['gue_dt_birth']           = $this->convertDate($data['gue_dt_birth'], 'en');

        # Tratamento de campos de chaves estrangeira
        foreach ($data as $key => $value) {
            $explodeKey = explode("_", $key);
            if ($explodeKey[count($explodeKey) -1] == "id" && $value == null ) {
                $data[$key] = null;
            }
        }
        #retorno
        return $data;
    }

    /**
     * @param $date
     * @return bool|string
     */
    public function convertDate($date, $format)
    {
        #declarando variável de retorno
        $result = "";
        #convertendo a data
        if (!empty($date) && !empty($format)) {
            #Fazendo o tratamento por idioma
            switch ($format) {
                case 'pt-BR' : $result = date_create_from_format('Y-m-d', $date); break;
                case 'en'    : $result = date_create_from_format('d/m/Y', $date); break;
            }
        }
        #retorno
        return $result;
    }

    /**
     * @param Aluno $aluno
     */
    public function getWithDateFormatPtBr($model)
    {
        #validando as datas
        $model->gue_dt_birth   = $model->gue_dt_birth == '0000-00-00' ? "" : $model->gue_dt_birth;

        #tratando as datas
        $model->gue_dt_birth   = date('d/m/Y', strtotime($model->gue_dt_birth));
        //$aluno->data_exame_nacional_um   = date('d/m/Y', strtotime($aluno->data_exame_nacional_um));
        //$aluno->data_exame_nacional_dois = date('d/m/Y', strtotime($aluno->data_exame_nacional_dois));
        #return
        return $model;
    }
}