<?php

namespace Tests\Feature;

use App\Livro;
use App\Services\CriadorDeLivro;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorDeLivroTest extends TestCase
{
    use RefreshDatabase;
    public function testCriarLivro()
    {
        $criadoDeLivro = new CriadorDeLivro();
        $nomeLivro = 'Teste';
        $livroCriado = $criadoDeLivro->criarLivro($nomeLivro, 1, 1);

        $this->assertInstanceOf(Livro::class, $livroCriado);
        $this->assertDatabaseHas('livros', ['nome' => $nomeLivro]);
        $this->assertDatabaseHas('capitulos', ['livro_id' => $livroCriado->id, 'numero' => 1]);
        $this->assertDatabaseHas('paginas',['numero' => 1]);
    }
}
