<?php

namespace Tests\Unit;

use App\Pagina;
use App\Capitulo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class apituloTest extends TestCase
{
    /** @var capitulo */
    private $capitulo;

    protected function setUp(): void
    {
        parent::setUp();
        $capitulo = new Capitulo();
        $pagina1 = new Pagina();
        $pagina1->lido = true;
        $pagina2 = new Pagina();
        $pagina2->lido = false;
        $pagina3 = new Pagina();
        $pagina3->lido = true;
        $capitulo->paginas->add($pagina1);
        $capitulo->paginas->add($pagina2);
        $capitulo->paginas->add($pagina3);

        $this->capitulo = $capitulo;
    }

    public function testBuscaPorPaginasLidas()
    {
        $paginasLidas = $this->capitulo->getPaginasLidas();

        $this->assertCount(2, $paginasLidas);
        foreach ($paginasLidas as $pagina) {
            $this->assertTrue($pagina->lido);
        }
    }

    public function testBuscaTodosAsPaginas()
    {
        $paginas = $this->capitulo->paginas;
        $this->assertCount(3, $paginas);
    }
}
