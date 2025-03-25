<?php

namespace App\Services;

use App\Models\Marca;
use App\Repositories\MarcaRepository;

class MarcaService
{
    public function __construct(protected MarcaRepository $marcaRepository) {}

    public function listar()
    {
        return $this->marcaRepository->listar();
    }

    public function criar(array $dados)
    {
        return $this->marcaRepository->criar($dados);
    }

    public function atualizar(Marca $marca, array $dados)
    {
        return $this->marcaRepository->atualizar($marca, $dados);
    }

    public function excluir(Marca $marca)
    {
        return $this->marcaRepository->excluir($marca);
    }
}
