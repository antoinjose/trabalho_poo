<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Veiculo;

class OrdemServico extends Model
{
    protected $table = 'ordens_servico';

    protected $fillable = [
        'cliente_id',
        'veiculo_id',
        'descricao',
        'status',
        'valor',
        'data_entrega',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_entrega' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
