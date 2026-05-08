<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('login')->unique();
        $table->string('senha');
        $table->string('situacao')->default('ativo');
        $table->timestamps();
        });
    }

    public function down(): void
    {
    Schema::dropIfExists('usuarios');
    }
};
