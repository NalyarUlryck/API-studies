<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // -> No caso dessa API verificaria se o usuário poderia cadastrar outro usuário.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:2', 'max:24']
        ];

        if ($this->method() === 'PATCH') { // -> se o método for patch essas exceções vão atuar.
            $rules['password'] = [ // -> o password passará pra optativo
                'nullable',
                'min:2',
                'max:24'
            ];

            $rules['email'] = [ // -> o email poderá sofrer modifações ou não.
                'required',
                'email',
                'max:255',
                "unique:users,email,{$this->id},id" // -> 1ª forma: permite salver com o mesmo email e também verifica se um novo email já não foi setado
                // Rule::unique('users')->ignore($this->id), // -> 2ª forma: mesma coisa do anterior, porém, mais legível.
            ];
        }
        return $rules;
    }
}
