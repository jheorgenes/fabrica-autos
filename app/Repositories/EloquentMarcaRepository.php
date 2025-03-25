<?php

namespace App\Repositories;

use App\Models\Marca;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentMarcaRepository implements MarcaRepository
{

    public function buscarPorId(int $id): Marca
    {
        return Marca::findOrFail($id);
    }


    public function listar(): Collection
    {
        return Marca::all();
    }

    public function criar(array $dados): Marca
    {
        return DB::transaction(function () use ($dados) {
            try {
                return Marca::create($dados);
            } catch (QueryException $e) {
                throw new \Exception('Erro ao cadastrar a marca. Verifique se o ID já existe ou se o nome já está cadastrado.');
            }
        });
    }

    public function atualizar(Marca $marca, array $dados): Marca
    {
        return DB::transaction(function () use ($marca, $dados) {
            try {
                $marca->update($dados);
                return $marca;
            } catch (QueryException $e) {
                throw new \Exception('Erro ao atualizar a marca. O nome pode estar duplicado.');
            }
        });
    }

    public function excluir(Marca $marca): void
    {
        DB::transaction(function () use ($marca) {
            try {
                $marca->delete();
            } catch (QueryException $e) {
                throw new \Exception('Erro ao excluir a marca. Verifique se ela está em uso.');
            }
        });
    }
}
