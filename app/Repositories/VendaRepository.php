<?php

namespace App\Repositories;

use App\Models\Venda;
use Illuminate\Support\Collection;

interface VendaRepository
{
    public function listar(): Collection;
    public function criar(array $dados): Venda;
    public function buscarPorId(int $id): ?Venda;
    public function excluir(Venda $venda): void;
}
