<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capitulo;
use App\Pagina;

class PaginasController extends Controller
{
    public function index(Capitulo $capitulo, Request $request)
    {
        $paginas = $capitulo->paginas;
        $capituloId = $capitulo->id;
        $mensagem = $request->session()->get('mensagem');

        return view('paginas.index', compact('paginas', 'capituloId', 'mensagem'));
    }

    public function ler(Capitulo $capitulo, Request $request)
    {
        $paginasLidas = $request->paginas;
        $capitulo->paginas->each(function (Pagina $pagina)
            use ($paginasLidas) {
            $pagina->lido = in_array(
                $pagina->id,
                $paginasLidas
            );
        });
        $capitulo->push();
        $request->session()->flash('mensagem', 'Páginas marcadas como lidas.');
        return redirect()->back();
    }
}
