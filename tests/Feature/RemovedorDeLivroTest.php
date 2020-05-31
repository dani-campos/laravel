<?php

namespace Tests\Feature;
use App\Livro;
use App\Services\CriadorDeLivro;
use App\Services\RemovedorDeLivros;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeLivroTest extends TestCase
{
    use RefreshDatabase;
    private $livro;

    protected function setUp(): void
    {
        parent::setUp();

        $criadorDeLivro = new CriadorDeLivro;
        $this->livro = $criadorDeLivro->criarLivro('Teste Livro', 1, 1);

    }
    public function testRemoverUmaLivro()
    {
       $this->assertDatabaseHas('livros', ['id' => $this->livro->id]);
       $removedorDeLivro = new RemovedorDeLivros;
       $nomeLivro = $removedorDeLivro->removerLivro($this->livro->id);
       $this->assertIsString($nomeLivro);
       $this->assertEquals('Teste Livro', $this->livro->nome);
       $this->assertDatabaseMissing('livros', ['id' => $this->livro->id]);
    }
}
