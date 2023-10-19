<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'name' => mb_strtoupper($this->name,'UTF-8'),
            'email' => $this->email,
            'created' => Carbon::make($this->created_at)->format('Y-m-d'),
        ];
    }
}
