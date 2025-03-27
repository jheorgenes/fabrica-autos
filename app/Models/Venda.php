<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['carro_id', 'preco_final', 'opcionais', 'valor_acrescimo', 'valor_desconto'];

    protected $casts = ['opcionais' => 'array'];

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }
}
