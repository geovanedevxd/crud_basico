<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testandotudo extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_create_record()
{
    $response = $this->post('/create', [
        'campo1' => 'valor1',
        'campo2' => 'valor2',
    ]);

    $response->assertRedirect('/'); // Verifica se redireciona corretamente
    $this->assertDatabaseHas('nome_da_tabela', [
        'campo1' => 'valor1',
    ]);
}
}
