@extends('layouts.app')

@section('title', 'Início')

@section('content')
<div id="conteudoPrincipal">
    <h1>Bem-vindo à Fábrica de Automóveis</h1>
    <p>Use o menu à esquerda para navegar entre as seções.</p>
</div>
@endsection

@section('scripts')
<script>
function carregarConteudo(selecao) {
    fetch(`/conteudo/${selecao}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('conteudoPrincipal').innerHTML = html;
        });
}
</script>
@endsection
