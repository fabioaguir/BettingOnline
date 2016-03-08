<?php

namespace Seracademico\Services;

use Seracademico\Entities\Aluno;
use Seracademico\Repositories\AlunoRepository;
use Seracademico\Validators\AlunoValidator;

class AlunoService
{
    /**
     * @var AlunoRepository
     */
    private $repository;

    /**
     * @param AlunoRepository $repository
     */
    public function __construct(AlunoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $result = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$result) {
            throw new \Exception('Aluno não encontrado!');
        }

        #retorno
        return $result;
    }

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data) : Aluno
    {
        #Criando no banco de dados
        $result =  $this->repository->create($data['aluno']);

        #Verificando se foi criado no banco de dados
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $result;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id) : Aluno
    {
        #Atualizando no banco de dados
        $result = $this->repository->update($data['aluno'], $id);

        #Verificando se foi atualizado no banco de dados
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $result;
    }
}