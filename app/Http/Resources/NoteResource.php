<?php

namespace App\Http\Resources;

use App\Support\Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'content' => $this->content,
            'created_at' => Date::toIsoString($this->created_at),
            'updated_at' => Date::toIsoString($this->updated_at),
        ];
    }
}
