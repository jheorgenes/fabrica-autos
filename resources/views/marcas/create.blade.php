@extends('layouts.app')

@section('title', 'Nova Marca')

@section('content')
<div class="container">
    <h1>Cadastrar Nova Marca</h1>
    @include('partials.errors')
    <form action="{{ route('marcas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Marca</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
