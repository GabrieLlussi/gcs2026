<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
    $user = Usuario::where('login', $request->login)->first();

    if ($user && Hash::check($request->senha, $user->senha)) {
        session(['usuario' => $user]);
        return redirect('/lancamentos');
    }

    return back()->with('erro', 'Login inválido');
    }

    public function logout()
    {
        session()->forget('usuario');
        return redirect('/');
    }

    public function erroPipeline()
    {
    $teste = 123;
    }
}
