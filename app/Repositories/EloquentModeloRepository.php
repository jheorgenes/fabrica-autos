<?php

namespace App\Repositories;

use App\Models\Modelo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentModeloRepository implements ModeloRepository
{
    public function listar(): Collection
    {
        return Modelo::with('marca')->get();
    }
    public function criar(array $dados)
    {
        return DB::transaction(function () use ($dados) {
            try {
                return Modelo::create($dados);
            } catch (QueryException $e) {
                throw new \Exception('Erro ao cadastrar o modelo. Verifique se o ID já existe ou se o nome já está cadastrado.');
            }
        });
    }
    public function atualizar(Modelo $modelo, array $dados)
    {
        return DB::transaction(function () use ($modelo, $dados) {
            try {
                $modelo->update($dados);
                return $modelo;
            } catch (QueryException $e) {
                throw new \Exception('Erro ao atualizar o modelo. O nome pode estar duplicado.');
            }
        });
    }
    public function excluir(Modelo $modelo)
    {
        DB::transaction(function () use ($modelo) {
            try {
                $modelo->delete();
            } catch (QueryException $e) {
                throw new \Exception('Erro ao excluir o modelo. Verifique se ele está em uso.');
            }
        });
    }
}
 