<?php

namespace App\Services;

use App\Repositories\CarroRepository;
use App\Repositories\VendaRepository;
use Illuminate\Support\Collection;

class VendaService
{
    public function __construct(
        protected VendaRepository $vendaRepository,
        protected CarroRepository $carroRepository
    ) {}

    public function listar(): Collection
    {
        return $this->vendaRepository->listar();
    }

    public function carrosDisponiveis(): Collection
    {
        return $this->carroRepository->listarDisponiveis();
    }

    public function registrar(array $dados)
    {
        $carro = $this->carroRepository->buscarPorId($dados['carro_id']);

        if($carro->vendido) {
            throw new \Exception('O carro selecionado ja foi vendido.');
        }

        $preco = $carro->preco;
        $cor = $carro->cor;
        $marca = $carro->modelo?->marca?->nome;

        // Se carro não for preto, remove opcionais
        $opcionais = [];
        if ($cor === 'Preto') {
            $opcionais = $dados['opcionais'] ?? [];

            // Acréscimo de 5% se não for Fiat
            if ($marca !== 'Fiat' && !empty($opcionais)) {
                $preco *= 1.05;
            }
        }

        // Desconto de 7% se for Hyundai e for Branco ou Prata
        if($marca === 'Hyundai' && in_array($cor, ['Branco', 'Prata'])) {
            $preco *= 0.93;
        }

        $venda = $this->vendaRepository->criar([
            'carro_id' => $carro->id,
            'preco_final' => $preco,
            'opcionais' => $opcionais
        ]);

        $this->carroRepository->marcarComoVendido($carro);

        return $venda;
    }

    public function excluir(int $vendaId): void
    {
        $venda = $this->vendaRepository->buscarPorId($vendaId);

        if(!$venda) {
            throw new \Exception('Venda nao encontrada.');
        }

        $carro = $venda->carro;

        if(!$carro->vendido) {
            throw new \Exception('Não é possível excluir. Carro ainda não está marcado como vendido');
        }

        $this->carroRepository->desmarcarComoVendido($carro);
        $this->vendaRepository->excluir($venda);
    }
}
