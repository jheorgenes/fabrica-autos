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

    public function totalVendas()
    {
        return number_format($this->vendaRepository->totalVendas(), 2, ',', '.');
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

        $precoOriginal = $carro->preco;
        $acrescimo = 0;
        $desconto = 0;
        $cor = $carro->cor;
        $marca = $carro->modelo?->marca?->nome;

        // Se carro não for preto, remove opcionais
        $opcionais = [];
        if ($cor === 'Preto') {
            $opcionais = $dados['opcionais'] ?? [];

            // Acréscimo de 5% se não for Fiat
            if ($marca !== 'Fiat' && !empty($opcionais)) {
                $acrescimo = $precoOriginal * 0.05;
            }
        }

        $precoFinal = $precoOriginal + $acrescimo - $desconto;

        // Desconto de 7% se for Hyundai e for Branco ou Prata
        if($marca === 'Hyundai' && in_array($cor, ['Branco', 'Prata'])) {
            $desconto = $precoOriginal * 0.07;
        }

        $venda = $this->vendaRepository->criar([
            'carro_id' => $carro->id,
            'preco_final' => $precoFinal,
            'opcionais' => $opcionais,
            'valor_acrescimo' => $acrescimo,
            'valor_desconto' => $desconto
        ]);

        $this->carroRepository->marcarComoVendido($carro, true);

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

        $this->carroRepository->marcarComoVendido($carro, false);
        $this->vendaRepository->excluir($venda);
    }
}
