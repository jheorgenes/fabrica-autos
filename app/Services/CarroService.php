<?php

namespace App\Services;

use App\Repositories\CarroRepository;
use App\Models\Carro;
use App\Models\Modelo;
use App\Repositories\ModeloRepository;
use Illuminate\Support\Collection;

class CarroService
{

    public function __construct(
        protected CarroRepository $carroRepository,
        protected ModeloRepository $modeloRepository
    ) {}

    public function buscarPorId(int $id): Carro
    {
        return $this->carroRepository->buscarPorId($id);
    }

    public function listar(): Collection
    {
        return $this->carroRepository->listar();
    }

    public function listarModelos(): Collection
    {
        return $this->modeloRepository->listar();
    }

    public function criar(array $dados): Carro
    {
        $this->validarRegrasDeNegocio($dados);
        return $this->carroRepository->criar($dados);
    }

    public function atualizar(Carro $carro, array $dados): Carro
    {
        $this->validarRegrasDeNegocio($dados);
        return $this->carroRepository->atualizar($carro, $dados);
    }

    public function excluir(Carro $carro): void
    {
        $carroBd = $this->carroRepository->buscarPorId($carro->id);
        if(!$carroBd) {
            throw new \Exception('Carro não encontrado.');
        }
        if($carroBd->vendido) {
            throw new \Exception('O carro selecionado ja foi vendido.');
        }
        $this->carroRepository->excluir($carro);
    }

    public function marcarComoVendido(int $id, bool $boolean): void
    {
        $carro = $this->carroRepository->buscarPorId($id);
        if (!$carro) {
            throw new \Exception('Carro não encontrado.');
        }
        $this->carroRepository->marcarComoVendido($carro, $boolean);
    }

    private function validarRegrasDeNegocio(array &$dados): void
    {
        $modelo = Modelo::with('marca')->findOrFail($dados['modelo_id']);
        $marcaNome = $modelo->marca->nome;

        // Regra de cor para marcas
        if (($marcaNome === 'Fiat' && !in_array($dados['cor'], ['Preto', 'Branco'])) ||
            ($marcaNome === 'Volkswagen' && $dados['cor'] !== 'Prata')) {
            throw new \Exception('A cor selecionada não é permitida para esta marca.');
        }
    }
}
