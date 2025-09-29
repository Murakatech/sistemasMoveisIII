<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserServices $userServices){}

    // Mostra o formulário de criação de usuário
    public function create()
    {
        return view('app.register');
    }

    // Armazena os dados do usuário
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $this->userServices->store($data);
        return redirect()->route('user.create')->with('success', 'Cadastro realizado com sucesso! Faça login para acessar o sistema.');
    }

    // Mostra o formulário de edição de usuário
    public function edit()
    {
        $user = $this->userServices->edit();
        return view('app.users.edit', compact('user'));
    }

    // Atualiza os dados do usuário
    public function update(UserRequest $request)
    {

        $user = auth()->user();
        $data = $request->validated();
        $this->userServices->update($data, $user);
        return redirect()->route('user.edit')->with('success', 'Dados atualizados com sucesso!');

    }



}
