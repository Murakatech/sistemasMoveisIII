<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthServices;

class AuthController extends Controller
{

    public function __construct(public AuthServices $authServices){}

    public function index()
    {
        return view('app.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();

        if ($this->authServices->login($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');
        }
        return back()->withErrors(['email' => 'E-mail ou senha inválidos.'])->withInput();
    }

    public function logout()
    {
        $this->authServices->logout();
        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }

}
