@extends('layouts.app')

@section('title', 'Marcas')

@section('content')
<div class="container">
    <h1>Lista de Marcas</h1>
    <a href="{{ route('marcas.create') }}" class="btn btn-primary">Nova Marca</a>
    @include('partials.messages')
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marcas as $marca)
                <tr>
                    <td>{{ $marca->id }}</td>
                    <td>{{ $marca->nome }}</td>
                    <td>
                        <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" style="display: inline;">
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
