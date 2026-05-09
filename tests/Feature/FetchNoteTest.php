<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FetchNoteTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function can_fetch_note(): void
    {
        $note = Note::factory()->create();

        $response = $this->getJson("/api/notes/{$note->uuid}");

        $response->assertSuccessful();

        $this->assertSame($note->uuid, $response->json('data.uuid'));
    }
}
