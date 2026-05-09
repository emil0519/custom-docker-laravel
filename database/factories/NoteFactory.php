<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),

            'name' => fake()->sentence(3),

            'content' => fake()->optional(0.8)->paragraphs(
                nb: fake()->numberBetween(1, 5),
                asText: true
            ),
        ];
    }
}