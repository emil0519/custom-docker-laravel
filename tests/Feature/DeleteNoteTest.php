<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteNoteTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function can_delete_note(): void
    {
        $note = Note::factory()->create();

        $response = $this->deleteJson("api/notes/{$note->uuid}");

        $response->assertSuccessful();

        $this->assertModelMissing($note);

    }
}
