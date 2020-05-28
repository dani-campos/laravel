<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivrosFormRequest;
use App\Livro;
use App\Services\CriadorDeLivro;
use App\Services\RemovedorDeLivros;
use Illuminate\Http\Request;


class LivrosController extends Controller
{
    public function index (Request $request) {
        $livros = Livro::query()
                ->orderBy('nome')
                ->get();

        $mensagem = $request
                    ->session()
                    ->get('mensagem');

        return view('livros.index', compact('livros', 'mensagem'));
    }

    public function create () {

        return view('livros.create') ;
    }

    public function store (
        LivrosFormRequest $request,
        CriadorDeLivro $criadorDeLivro,
        RemovedorDeLivros $removedorDeLivros
    ) {
        $livro = $criadorDeLivro->criarLivro(
            $request->nome,
            $request->qtd_capitulos,
            $request->pg_por_capitulo
        );
        $request->session()
            ->flash
                (
                    'mensagem',
                    "Livro de número: {$livro->id} Título: {$livro->nome} e seus capítulos e páginas inserido com sucesso"
                );
        return redirect()->route('listar_livros');
    }

    public function destroy (Request $request,
        RemovedorDeLivros $removedorDeLivros
    ) {

        $nomeLivro = $removedorDeLivros->removerLivro($request->id);
        $request->session()
            ->flash
                (
                    'mensagem',
                    "Livro $nomeLivro excluído com sucesso"
                );
        return redirect()->route('listar_livros');

    }

    public function editaNome ($id, Request $request) {

        $novoNome = $request->nome;
        $livro = Livro::find($id);
        $livro->nome = $novoNome;
        $livro->save();

    }

}
