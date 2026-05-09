<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateNoteTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function can_create_note(): void
    {
        $response = $this->postJson('api/notes');

        $response->assertSuccessful();

        $notes = Note::all();

        $this->assertCount(1, $notes);
    }
}
