<?php

namespace App\Services;

use App\Models\Modelo;
use App\Repositories\MarcaRepository;
use App\Repositories\ModeloRepository;

class ModeloService
{
    public function __construct(
        protected ModeloRepository $modeloRepository,
        protected MarcaRepository $marcaRepository
    ) {}

    public function listar() {
        return $this->modeloRepository->listar();
    }

    public function listarMarcas()
    {
        return $this->marcaRepository->listar();
    }

    public function criar(array $dados)
    {
        return $this->modeloRepository->criar($dados);
    }

    public function atualizar(Modelo $modelo, array $dados)
    {
        return $this->modeloRepository->atualizar($modelo, $dados);
    }

    public function excluir(Modelo $modelo)
    {
        return $this->modeloRepository->excluir($modelo);
    }
}
