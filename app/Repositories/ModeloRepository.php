<?php

namespace App\Repositories;

use App\Models\Modelo;
use Illuminate\Support\Collection;

interface ModeloRepository
{
    public function listar(): Collection;
    public function criar(array $dados);
    public function atualizar(Modelo $modelo, array $dados);
    public function excluir(Modelo $modelo);
}
