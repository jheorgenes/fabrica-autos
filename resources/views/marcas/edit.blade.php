@extends('layouts.app')

@section('title', 'Editar Marca')

@section('content')
<div class="container">
    <h1>Editar Marca</h1>
    @include('partials.errors')
    <form action="{{ route('marcas.update', $marca->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Marca</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $marca->nome }}" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
