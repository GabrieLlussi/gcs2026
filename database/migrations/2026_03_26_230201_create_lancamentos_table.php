<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('lancamentos', function (Blueprint $table) {
        $table->id();
        $table->string('descricao');
        $table->date('data_lancamento');
        $table->decimal('valor', 10, 2);
        $table->string('tipo_lancamento');
        $table->boolean('situacao');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos');
    }
};
