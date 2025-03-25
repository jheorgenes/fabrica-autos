@extends('layouts.app')

@section('title', 'Modelos')

@section('content')
<div class="container">
    <h1>Lista de Modelos</h1>
    <a href="{{ route('modelos.create') }}" class="btn btn-primary">Novo Modelo</a>
    @include('partials.messages')
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modelos as $modelo)
                <tr>
                    <td>{{ $modelo->id }}</td>
                    <td>{{ $modelo->nome }}</td>
                    <td>{{ $modelo->marca->nome }}</td>
                    <td>
                        <a href="{{ route('modelos.edit', $modelo->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('modelos.destroy', $modelo->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
