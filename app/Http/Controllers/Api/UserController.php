<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // -> aqui posso usar o paginate pra retornar os dados paginados.
        return UserResource::collection($users); // -> Retorna os dados que eu quero dentro de um data
    }

    public function store(Request $request) // -> injeção de dependência
    {
        $data = $request->all(); // -> Estou pegando todos os dados da requisição
        $data['password'] = bcrypt($request->password); // -> criptografando a senha
        $user = User::create($data); // -> Estou salvando esses dados na tabela usuário
        return new UserResource($user); // -> retorna o usuário cadastrado no formato que foi definido no UserResource
    }
}
