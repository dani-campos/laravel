<?php

namespace App\Services;

use App\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriadorDeLivro {
    public function criarLivro(
        string $nomeLivro,
        int $qtd_capitulos,
        int $pg_por_capitulo
    ):Livro
    {
        DB::beginTransaction();
        $livro = Livro::create(['nome' => $nomeLivro]);
        $this->criaCapitulo($qtd_capitulos, $pg_por_capitulo, $livro);
        DB::commit();
        return $livro;
    }

    public function criaCapitulo(int $qtd_capitulos, int $pg_por_capitulo, Livro $livro)
    {
        for($i = 1; $i <= $qtd_capitulos; $i++) {
            $capitulo = $livro->capitulos()->create(['numero' => $i]);
            $this->criaPaginas($pg_por_capitulo, $capitulo);
        }
    }

    public function criaPaginas($pg_por_capitulo, \Illuminate\Database\Eloquent\Model $capitulo): void
    {
        for($j = 1; $j <= $pg_por_capitulo; $j++){
            $capitulo->paginas()->create(['numero' => $j]);
        }
    }
}
