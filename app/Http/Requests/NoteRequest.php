<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['prohibited'],
            'uuid' => ['prohibited'],
            'created_at' => ['prohibited'],
            'updated_at' => ['prohibited'],
            'name' => ['sometimes', 'string', 'max:255'],
            'content' => ['sometimes', 'nullable', 'string'],
        ];
    }

    public function noteInfo(): array
    {
        return $this->only(['name', 'content']);
    }
}
