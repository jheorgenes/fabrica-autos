@extends('layouts.app')

@section('title', 'Novo Modelo')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Modelo</h1>
    @include('partials.errors')
    <form action="{{ route('modelos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Modelo</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="marca_id" class="form-label">Marca</label>
            <select name="marca_id" id="marca_id" class="form-control" required>
                <option value="">Selecione uma Marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
