<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    use HasFactory;

    protected $table = 'lista_chamadas';

    protected $fillable = [
        'id_chamada',
        'nome_paciente',
        'dt_nascimento',
        'id_medico',
        'id_status',
        'sn_mostra_painel',
    ];

    public function create(array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->save();
    }

}
