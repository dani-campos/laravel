<?php

namespace App\Http\Controllers;

use App\Livro;
use Illuminate\Http\Request;

class CapitulosController extends Controller
{
    public function index (int $livroId){
        $livro = Livro::find($livroId);
        $capitulos = $livro->capitulos;
        return view('capitulos.index', compact('livro', 'capitulos'));
    }
}
