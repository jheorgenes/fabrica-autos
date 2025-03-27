@extends('layouts.app')

@section('title', 'Carros')

@section('content')
<div class="container">
    <h1>Lista de Carros</h1>
    <a href="{{ route('carros.create') }}" class="btn btn-primary">Novo Carro</a>
    @include('partials.messages')
    @include('partials.errors')
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Cor</th>
                <th>Preço</th>
                <th>Vendido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carros as $carro)
                <tr>
                    <td>{{ $carro->id }}</td>
                    <td>{{ $carro->placa }}</td>
                    <td>{{ $carro->modelo->nome }}</td>
                    <td>{{ $carro->modelo->marca->nome }}</td>
                    <td>{{ $carro->cor }}</td>
                    <td>R$ {{ number_format($carro->preco, 2, ',', '.') }}</td>
                    <td class="w-25">{{ $carro->vendido ? 'Sim' : 'Nao' }}</td>
                    <td>
                        <a href="{{ route('carros.edit', $carro->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('carros.destroy', $carro) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                        {{-- @if (!$carro->vendido)
                            <form action="{{ route('carros.marcar_vendido', $carro->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Marcar como Vendido</button>
                            </form>
                        @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
