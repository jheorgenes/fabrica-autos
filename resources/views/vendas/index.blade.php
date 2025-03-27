@extends('layouts.app')

@section('title', 'Vendas Realizadas')

@section('content')
<div class="container">
    <h1>Lista de Vendas</h1>
    <a href="{{ route('vendas.create') }}" class="btn btn-success mb-3">Nova Venda</a>

    @include('partials.messages')
    @include('partials.errors')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Preço Original</th>
                <th>Acréscimo</th>
                <th>Desconto</th>
                <th>Preço Final</th>
                <th>Opcionais</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->carro->placa }}</td>
                    <td>{{ $venda->carro->modelo->marca->nome }}</td>
                    <td>{{ $venda->carro->modelo->nome }}</td>
                    <td>{{ $venda->carro->cor }}</td>
                    <td>R$ {{ number_format($venda->carro->preco, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($venda->valor_acrescimo ?? 0, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($venda->valor_desconto ?? 0, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($venda->preco_final, 2, ',', '.') }}</td>
                    <td>
                        @if (!empty($venda->opcionais))
                            <ul>
                                @foreach($venda->opcionais as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            Nenhum
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" class="text-end">
                    <strong>Total vendido:</strong> R$ {{ $totalVendas }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
