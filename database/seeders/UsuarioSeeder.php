<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $existe = DB::table('usuarios')->where('login', 'admin')->exists();

        if (!$existe) {
            DB::table('usuarios')->insert([
                'nome' => 'admin',
                'login' => 'admin',
                'senha' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}