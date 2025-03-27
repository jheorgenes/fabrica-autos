@extends('layouts.app')

@section('title', 'Editar Carro')

@section('content')
<div class="container">
    <h1>Editar Carro</h1>
    @include('partials.errors')
    <form action="{{ route('carros.update', $carro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" id="placa" class="form-control" value="{{ old('placa', $carro->placa) }}" required>
        </div>

        <div class="mb-3">
            <label for="modelo_id" class="form-label">Modelo</label>
            <select name="modelo_id" id="modelo_id" class="form-control" required>
                @foreach($modelos as $modelo)
                    <option value="{{ $modelo->id }}" {{ $carro->modelo_id == $modelo->id ? 'selected' : '' }}>
                        {{ $modelo->nome }} - {{ $modelo->marca->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cor" class="form-labe">Cor</label>
            <select name="cor" id="cor" class="form-control" required>
                <option value="Preto" {{ $carro->cor === 'Preto' ? 'selected' : '' }}>Preto</option>
                <option value="Branco" {{ $carro->cor === 'Branco' ? 'selected' : '' }}>Branco</option>
                <option value="Prata" {{ $carro->cor === 'Prata' ? 'selected' : '' }}>Prata</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="{{ $carro->preco }}" required>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
