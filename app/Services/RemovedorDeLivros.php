<?php

namespace App\Services;

use App\{Livro, Capitulo, Pagina};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemovedorDeLivros {

    public function removerLivro(int $livroId):String
    {
        $nomeLivro = '';
        DB::transaction(function () use ($livroId, &$nomeLivro){
            $livro = Livro::find($livroId);
            $nomeLivro = $livro->nome;
            $this->removerCapitulos($livro);
            $livro->delete();
        });

        return $nomeLivro;
    }

    private function removerCapitulos($livro): Void
    {
        $livro->capitulos->each(function (Capitulo $capitulo) {
            $this->removerPaginas($capitulo);
            $capitulo->delete();
        });

    }

    private function removerPaginas(Capitulo $capitulo): Void
    {
        $capitulo->paginas->each(function (Pagina $pagina) {
            $pagina->delete();
        });

    }

}
