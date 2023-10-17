<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users); // -> Retorna os dados que eu quero dentro de um data
    }

    public function store(StoreUpdateUserRequest $request) // -> injeção de dependência
    {
        $data = $request->validated(); // -> Nesse caso posso usar esse método pra pegar apenas os dados validados na requisição
        $data['password'] = bcrypt($request->password); // -> criptografando a senha
        $user = User::create($data); // -> Estou salvando esses dados na tabela usuário
        return new UserResource($user); // -> retorna o usuário cadastrado no formato que foi definido no UserResource
    }
}
