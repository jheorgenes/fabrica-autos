@extends('layouts.app')

@section('title', 'Novo Carro')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Carro</h1>
    @include('partials.errors')
    <form action="{{ route('carros.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" id="placa" class="form-control" value="{{ old('placa') }}" required>
        </div>

        <div class="mb-3">
            <label for="modelo_id" class="form-label">Modelo</label>
            <select name="modelo_id" id="modelo_id" class="form-control" required>
                <option value="">Selecione um modelo</option>
                @foreach($modelos as $modelo)
                    <option value="{{ $modelo->id }}" {{ old('modelo_id') == $modelo->id ? 'selected' : '' }}>
                        {{ $modelo->nome }} - {{ $modelo->marca->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cor" class="form-label">Cor</label>
            <select name="cor" id="cor" class="form-select" required>
                <option value="">Selecione uma Cor</option>
                <option value="Preto">Preto</option>
                <option value="Branco">Branco</option>
                <option value="Prata">Prata</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="{{ old('preco') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
