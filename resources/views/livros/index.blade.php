@extends('layout')

@section('cabecalho')
Livros
@endsection

@section('conteudo')
@include('mensagem', ['mensagem' => $mensagem])
@auth
<a href="{{ route('criar_livro') }}" class="btn btn-dark mb-2">Adicionar</a>
@endauth

<ul class="list-group">
    @foreach ($livros as $livro)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="nome-livro-{{ $livro->id }}">{{ $livro->nome }}</span>
        <div class="input-group w50" hidden id="input-nome-livro-{{ $livro->id }}">
            <input type="text" class="form-control" value="{{ $livro->nome }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarLivro({{ $livro->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $livro->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            <a href="/livros/{{ $livro->id }}/capitulos" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-external-link-alt"></i>
            </a>
            @auth
            <form method="post" action="/livros/{{ $livro->id }}"
                onsubmit="return confirm('Tem certeza que deseja excluir esse livro?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            @endauth
        </span>
    </li>
    @endforeach
</ul>
<script>
    function toggleInput(livroId)
    {
        const nomeLivroEl = document.getElementById(`nome-livro-${livroId}`);
        const inputLivroEl = document.getElementById(`input-nome-livro-${livroId}`);
        if (nomeLivroEl.hasAttribute('hidden'))
        {
            nomeLivroEl.removeAttribute('hidden');
            inputLivroEl.hidden = true;
        } else {
            inputLivroEl.removeAttribute('hidden');
            nomeLivroEl.hidden = true;
        }

    }

    function editarLivro(livroId)
    {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-livro-${livroId} > input`)
            .value;
        const token = document.querySelector('input[name="_token"]').value;
        formData.append('nome', nome);
        formData.append('_token', token);

        const url = `/livros/${livroId}/editaNome`;
        fetch(url, {
            body: formData,
            method: 'POST'
        }).then(() => {
            toggleInput(livroId);
            document.getElementById(`nome-livro-${livroId}`).textContent = nome;
        });
    }
</script>
@endsection
