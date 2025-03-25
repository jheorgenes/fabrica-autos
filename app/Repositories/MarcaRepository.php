<?php

namespace App\Repositories;

use App\Models\Marca;
use Illuminate\Support\Collection;

interface MarcaRepository
{
    public function listar(): Collection;
    public function criar(array $dados): Marca;
    public function atualizar(Marca $marca, array $dados): Marca;
    public function excluir(Marca $marca): void;
}
