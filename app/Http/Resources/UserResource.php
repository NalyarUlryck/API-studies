<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //setando os dados que serão retornados ao endpoint
            'id' => $this->id,
            'name' => strtoupper($this->name),
            'email' => $this->email,
            'created' => $this->created_at,
        ];
    }
}
