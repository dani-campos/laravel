@extends('layout')

@section('cabecalho')
Capítulos de {{ $livro->nome }}
@endsection

@section('conteudo')
<ul class="list-group">
    @foreach ($capitulos as $capitulo)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="/capitulos/{{ $capitulo->id }}/paginas">
            Capitulo {{ $capitulo->numero }}
        </a>
        <span class="badge badge-secondary">
            {{ $capitulo->getPaginasLidas()->count() }} /{{ $capitulo->paginas->count() }}
        </span>
    </li>
    @endforeach
</ul>
@endsection
