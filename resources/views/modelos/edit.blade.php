@extends('layouts.app')

@section('title', 'Editar Modelo')

@section('content')
<div class="container">
    <h1>Editar Modelo</h1>
    @include('partials.errors')
    <form action="{{ route('modelos.update', $modelo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Modelo</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $modelo->nome }}" required>
        </div>
        <div class="mb-3">
            <label for="marca_id" class="form-label">Marca</label>
            <select name="marca_id" id="marca_id" class="form-control" required>
                <option value="">Selecione uma Marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}" {{ $marca->id == $modelo->marca_id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection


