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


}
