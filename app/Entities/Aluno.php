<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Aluno extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "fac_alunos";

    protected $fillable = [
        'matricula',
        'nome',
        'nome_pai',
        'nome_social',
        'nome_mae',
        'identidade',
        'orgao_rg',
        'data_expedicao',
        'cpf',
        'titulo_eleitoral',
        'zona',
        'secao',
        'resevista',
        'catagoria_resevista',
        'data_nasciemento',
        'nacionalidade',
        'naturalidade',
        'ano_conclusao_2_grau',
        'outra_escola',
        'data_exame_nacional_um',
        'nota_exame_nacional_um',
        'data_exame_nacional_dois',
        'nota_exame_nacional_dois',
        'enderecos_id',
        'sexos_id',
        'turnos_id',
        'grau_instrucoes_id',
        'profissoes_id',
        'religioes_id',
        'estados_civis_id',
        'tipos_sanguinios_id',
        'cores_racas_id',
        'estados_id',
        'exames1_id',
        'exames2_id',
        'instituicao_medio_id',
        'instituicao_superior_id'
    ];

}
