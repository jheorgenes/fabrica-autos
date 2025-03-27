<?php

namespace App\Repositories;

use App\Models\Carro;
use Illuminate\Support\Collection;

interface CarroRepository
{
    public function buscarPorId(int $id): ?Carro;
    public function listar(): Collection;
    public function criar(array $dados): Carro;
    public function atualizar(Carro $carro, array $dados): Carro;
    public function excluir(Carro $carro): void;
    public function marcarComoVendido(Carro $carro, Bool $vendido): void;
    public function listarDisponiveis(): Collection;
}
