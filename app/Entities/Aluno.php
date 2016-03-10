<?php

namespace Seracademico\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Seracademico\Entities\CorRaca;
use Seracademico\Entities\Endereco;
use Seracademico\Entities\Estado;
use Seracademico\Entities\EstadoCivil;
use Seracademico\Entities\Exame;
use Seracademico\Entities\InstituicaoMedio;
use Seracademico\Entities\Profissao;
use Seracademico\Entities\TipoSanguinio;
use Seracademico\Entities\Turno;

class Aluno extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "fac_alunos";

    protected $fillable = [
        'matricula',
        'nome',
        'email',
        'telefone_fixo',
        'celular',
        'celular2',
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
        'uf_nascimento_id',
        'deficiencia_fisica',
        'deficiencia_auditiva',
        'deficiencia_visual',
        'deficiencia_outra',
        'fac_instituicoes_id'
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'enderecos_id');
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'sexos_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turnos_id');
    }

    public function grauInstrucao()
    {
        return $this->belongsTo(GrauInstrucao::class, 'grau_instrucoes_id');
    }

    public function profissao()
    {
        return $this->belongsTo(Profissao::class, 'profissoes_id');
    }

    public function religiao()
    {
        return $this->belongsTo(Religiao::class, 'religioes_id');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estados_civis_id');
    }

    public function tipoSanguinio()
    {
        return $this->belongsTo(TipoSanguinio::class, 'tipos_sanguinios_id');
    }

    public function corRaca()
    {
        return $this->belongsTo(CorRaca::class, 'cores_racas_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }

    public function ufNascimento()
    {
        return $this->belongsTo(Estado::class, 'uf_nascimento_id');
    }

    public function exame1()
    {
        return $this->belongsTo(Exame::class, 'exames1_id');
    }

    public function exame2()
    {
        return $this->belongsTo(Exame::class, 'exames2_id');
    }

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, "fac_instituicoes_id");
    }

}