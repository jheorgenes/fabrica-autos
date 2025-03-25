<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = ['placa', 'cor', 'preco', 'vendido', 'modelo_id'];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
