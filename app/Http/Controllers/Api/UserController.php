<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        protected User $repository, // -> Tranformei todos os Models nesse atributo respository porque o próprio Model é um repositório.
    )
    {

    }
    public function index()
    {
        $users = $this->repository->all();
        return UserResource::collection($users); // -> Retorna os dados que eu quero dentro de um data
    }

    public function show(string $id)
    {
        //1ª forma:
        // $user =  $this->repository->find($id);

        //2ª forma:
        // $user = $this->repository->where('id', '=', $id)->first();
        // if (!$user) {
        //     return response()->json(['message' => 'USER NOT FOUND'], 404); // -> manda uma mensagem manualmente informando que o ususário não foi encontrado.
        // } else {
        //     return new UserResource($user);
        // }

        //3ª forma:
        $user = $this->repository->findOrFail($id); // -> Pega o usuário que veio pelo get ou já manda um response caso não exista.
        return new UserResource($user);
    }

    public function store(StoreUpdateUserRequest $request) // -> injeção de dependência
    {
        $data = $request->validated(); // -> Nesse caso posso usar esse método pra pegar apenas os dados validados na requisição
        $data['password'] = bcrypt($request->password); // -> criptografando a senha
        $user = $this->repository->create($data); // -> Estou salvando esses dados na tabela usuário
        return new UserResource($user); // -> retorna o usuário cadastrado no formato que foi definido no UserResource
    }

    public function update(StoreUpdateUserRequest $request, string $id) // -> aqui estou recebendo tanto o id do usuário que será modificado, como as modificações.
    {
        $user = $this->repository->findOrFail($id);

        $data = $request->validated();

        if ($request->password)
            $data['password'] = bcrypt($request->getPassword());


        $user->update($data); // -> Estando tudo certo com $user a requição faz atualização dos dados.

        return new UserResource($user);
    }

    public function destroy(string $id)
    {
        $user = $this->repository->findOrFail($id);
        $user->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
