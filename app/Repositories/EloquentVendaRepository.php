<?php

namespace App\Repositories;

use App\Models\Venda;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentVendaRepository implements VendaRepository
{
    public function listar(): Collection
    {
        return Venda::with(['carro.modelo.marca'])->get();
    }

    public function criar(array $dados): Venda
    {
        return DB::transaction(function () use ($dados) {
            try {
                return Venda::create($dados);
            } catch (QueryException $e) {
                throw new \Exception('Erro ao cadastrar o venda. Verifique os dados fornecidos.');
            }
        });
    }

    public function buscarPorId(int $id): ?Venda
    {
        return Venda::with(['carro'])->find($id);
    }

    public function excluir(Venda $venda): void
    {
        DB::transaction(function () use ($venda) {
            try {
                $venda->delete();
            } catch (QueryException $e) {
                throw new \Exception('Erro ao excluir venda. Verifique se ela está em uso');
            }
        });
    }
}
