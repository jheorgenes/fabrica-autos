<?php

namespace App\Repositories;

use App\Models\Carro;
use App\Models\Modelo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;

class EloquentCarroRepository implements CarroRepository
{
    public function buscarPorId(int $id): ?Carro
    {
        return Carro::with(['modelo.marca'])->find($id);
    }

    public function listar(): Collection
    {
        return Carro::with(['modelo.marca'])->get();
    }

    public function criar(array $dados): Carro
    {
        return DB::transaction(function () use ($dados) {
            try {
                return Carro::create($dados);
            } catch (QueryException $e) {
                throw new \Exception('Erro ao cadastrar o carro. Verifique os dados fornecidos.');
            }
        });
    }

    public function atualizar(Carro $carro, array $dados): Carro
    {
        return DB::transaction(function () use ($carro, $dados) {
            try {
                $carro->update($dados);
                return $carro;
            } catch (QueryException $e) {
                throw new \Exception('Erro ao atualizar o carro. Verifique os dados fornecidos.');
            }
        });
    }

    public function excluir(Carro $carro): void
    {
        DB::transaction(function () use ($carro) {
            try {
                $carro->delete();
            } catch (QueryException $e) {
                throw new \Exception('Erro ao excluir o carro. Verifique se ele já foi vendido.');
            }
        });
    }

    public function marcarComoVendido(Carro $carro): void
    {
        DB::transaction(function () use ($carro) {
            try {
                $carro->update(['vendido' => true]);
            } catch (QueryException $e) {
                throw new \Exception('Erro ao marcar o carro como vendido.');
            }
        });
    }

    public function desmarcarComoVendido(Carro $carro): void
    {
        DB::transaction(function () use ($carro) {
            try {
                $carro->update(['vendido' => false]);
            } catch (QueryException $e) {
                throw new \Exception('Erro ao desmarcar o carro como vendido.');
            }
        });
    }

    public function listarDisponiveis(): Collection
    {
        return Carro::with(['modelo.marca'])
            ->where('vendido', false)
            ->get();
    }
}
