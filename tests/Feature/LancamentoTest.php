<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Lancamento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LancamentoTest extends TestCase
{
    use RefreshDatabase;

    private function dadosValidos()
    {
        return [
            'descricao' => 'Teste',
            'data_lancamento' => '2026-01-01',
            'valor' => 100,
            'tipo_lancamento' => 'receita',
            'situacao' => 1
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | 1. ROTAS
    |--------------------------------------------------------------------------
    */

    public function test_home()
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_index()
    {
        $this->get('/lancamentos')->assertStatus(200);
    }

    public function test_rota_invalida()
    {
        $this->get('/erro')->assertStatus(404);
    }

    /*
    |--------------------------------------------------------------------------
    | 2. CREATE
    |--------------------------------------------------------------------------
    */

    public function test_criar_lancamento()
    {
        $this->post('/lancamentos', $this->dadosValidos());

        $this->assertDatabaseHas('lancamentos', [
            'descricao' => 'Teste'
        ]);
    }

    public function test_validacao_create()
    {
        $this->post('/lancamentos', [])
            ->assertSessionHasErrors();
    }

    /*
    |--------------------------------------------------------------------------
    | 3. UPDATE
    |--------------------------------------------------------------------------
    */

    public function test_update_lancamento()
    {
        $l = Lancamento::create($this->dadosValidos());

        $this->put('/lancamentos/'.$l->id, [
            'descricao' => 'Atualizado',
            'data_lancamento' => '2026-01-01',
            'valor' => 200,
            'tipo_lancamento' => 'despesa',
            'situacao' => 1
        ]);

        $this->assertDatabaseHas('lancamentos', [
            'descricao' => 'Atualizado'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 4. DELETE
    |--------------------------------------------------------------------------
    */

    public function test_delete_lancamento()
    {
        $l = Lancamento::create($this->dadosValidos());

        $this->delete('/lancamentos/'.$l->id);

        $this->assertDatabaseMissing('lancamentos', [
            'id' => $l->id
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 5. FILTROS
    |--------------------------------------------------------------------------
    */

    public function test_filtro_data()
    {
        $this->get('/lancamentos?data_inicio=2026-01-01')
            ->assertStatus(200);
    }

    public function test_filtro_situacao()
    {
        $this->get('/lancamentos?situacao=1')
            ->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | 6. VIEWS
    |--------------------------------------------------------------------------
    */

    public function test_view_index()
    {
        $this->get('/lancamentos')
            ->assertSee('Controle Financeiro');
    }

    /*
    |--------------------------------------------------------------------------
    | 8. ROTAS EXTRAS
    |--------------------------------------------------------------------------
    */

    public function test_create_page()
    {
        $this->get('/lancamentos/create')->assertStatus(200);
    }

    public function test_edit_page()
    {
        $l = Lancamento::create($this->dadosValidos());

        $this->get('/lancamentos/'.$l->id.'/edit')
            ->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | 9. JSON
    |--------------------------------------------------------------------------
    */

    public function test_json()
    {
        $this->getJson('/lancamentos')
            ->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | 10. CASOS DE ERRO
    |--------------------------------------------------------------------------
    */

    public function test_update_inexistente()
    {
        $this->put('/lancamentos/999', [
            'descricao' => 'Teste',
            'data_lancamento' => '2026-01-01',
            'valor' => 100,
            'tipo_lancamento' => 'receita',
            'situacao' => 1
        ])->assertStatus(404);
    }

    public function test_delete_inexistente()
    {
        $this->delete('/lancamentos/999')
            ->assertStatus(404);
    }

    /*
    |--------------------------------------------------------------------------
    | EXTRA (COMPLETAR 20 TESTES)
    |--------------------------------------------------------------------------
    */

    public function test_criar_varios_registros()
    {
        $this->post('/lancamentos', $this->dadosValidos());
        $this->post('/lancamentos', $this->dadosValidos());

        $this->assertDatabaseCount('lancamentos', 2);
    }

    public function test_valor_decimal()
    {
        $this->post('/lancamentos', [
            'descricao' => 'Decimal',
            'data_lancamento' => '2026-01-01',
            'valor' => 99.99,
            'tipo_lancamento' => 'receita',
            'situacao' => 1
        ]);

        $this->assertDatabaseHas('lancamentos', [
            'valor' => 99.99
        ]);
    }

    public function test_tipo_despesa()
    {
        $this->post('/lancamentos', [
            'descricao' => 'Despesa',
            'data_lancamento' => '2026-01-01',
            'valor' => 50,
            'tipo_lancamento' => 'despesa',
            'situacao' => 1
        ]);

        $this->assertDatabaseHas('lancamentos', [
            'tipo_lancamento' => 'despesa'
        ]);
    }
}