<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'email', 'telefone'];

    public function veiculos()
{
    return $this->hasMany(Veiculo::class);
}
}
