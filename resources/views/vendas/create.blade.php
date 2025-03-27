@extends('layouts.app')

@section('title', 'Registrar Venda')

@section('content')
<div class="container">
    <h1>Nova Venda</h1>
    @include('partials.errors')

    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="carro_id" class="form-label">Selecione o carro</label>
            <select name="carro_id" id="carro_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($carros as $carro)
                    <option value="{{ $carro->id }}" data-cor="{{ $carro->cor }}" {{ old('carro_id') == $carro->id ? 'selected' : '' }}>
                        {{ $carro->placa }} - {{ $carro->modelo->marca->nome }} {{ $carro->modelo->nome }} ({{ $carro->cor }}) - R$ {{ $carro->preco }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="opcionais-area" class="mb-3 d-none">
            <label class="form-label">Opcionais (somente para carros pretos)</label>
            {{-- <div class="opcionais-wrapper"></div> --}}
            <div class="opcionais-wrapper">
                @if(old('opcionais'))
                    @foreach(old('opcionais') as $opcional)
                        <div class="d-flex align-items-center">
                            <input type="text" name="opcionais[]" class="form-control mb-2" value="{{ $opcional }}">
                            <button type="button" class="btn btn-sm btn-danger mb-2 ms-2" onclick="this.parentElement.remove()">Remover</button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button id="add-opcional" class="btn btn-secondary mt-2">Adicionar Opcional</button>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venda</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.querySelector('.opcionais-wrapper');
    const addBtn = document.getElementById('add-opcional');
    const selectCarro = document.getElementById('carro_id');
    const opcionaisArea = document.getElementById('opcionais-area');

    const carroSelecionado = selectCarro.options[selectCarro.selectedIndex];
    if (carroSelecionado && carroSelecionado.getAttribute('data-cor') === 'Preto') {
        opcionaisArea.classList.remove('d-none');
    }

    addBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'opcionais[]';
        input.classList.add('form-control', 'mb-2');
        input.placeholder = 'Novo opcional';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remover';
        removeBtn.classList.add('btn', 'btn-sm', 'btn-danger', 'mb-2', 'ms-2');
        removeBtn.onclick = () => {
            wrapper.removeChild(inputDiv);
        };

        const inputDiv = document.createElement('div');
        inputDiv.classList.add('d-flex', 'align-items-center');
        inputDiv.appendChild(input);
        inputDiv.appendChild(removeBtn);

        wrapper.appendChild(inputDiv);
    });

    selectCarro.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const cor = selectedOption.getAttribute('data-cor');
        if (cor === 'Preto') {
            opcionaisArea.classList.remove('d-none');
        } else {
            opcionaisArea.classList.add('d-none');
            wrapper.innerHTML = '';
        }
    });
});
</script>
@endsection
