@extends('layout')

@section('cabecalho')
Adicionar
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])
<form method="post">
@csrf
<div class="row">
    <div class="col col-8">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome">
    </div>
    <div class="col col-2">
        <label for="qtd_capitulos">Número de capítulos</label>
        <input type="number" class="form-control" name="qtd_capitulos" id="qtd_capitulos">
    </div>
    <div class="col col-2">
        <label for="pg_por_capitulo">Pag. por capítulo</label>
        <input type="number" class="form-control" name="pg_por_capitulo" id="pg_por_capitulo">
    </div>
</div>

<button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection

