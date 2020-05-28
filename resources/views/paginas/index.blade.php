@extends('layout')

@section('cabecalho')
Páginas
@endsection

@section('conteudo')
@include('mensagem', ['mensagem' => $mensagem])
<form action="/capitulos/{{ $capituloId }}/paginas/ler" method="post">
    @csrf
    <ul class="list-group">
        @foreach ($paginas as $pagina)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Página {{ $pagina->numero }}
            <input type="checkbox" name="paginas[]" value="{{ $pagina->id }}"
            {{  $pagina->lido ? 'checked' : '' }}>
        </li>
        @endforeach
    </ul>
    <button class="btn btn-primary mt-2 mb-2">Salvar</button>
</form>
@endsection
