<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = ['cliente_id', 'marca', 'modelo', 'placa', 'cor', 'ano'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
