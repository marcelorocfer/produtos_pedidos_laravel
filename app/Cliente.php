<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'endereco',
        'complemento',
        'bairro',
        'cep',
        'data_cadastro'
    ];

    public $timestamps = false;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
