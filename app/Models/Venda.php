<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['carro_id', 'preco_final', 'opcionais'];

    protected $casts = ['opcionais' => 'array'];

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }
}
