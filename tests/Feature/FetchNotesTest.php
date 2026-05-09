<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FetchNotesTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function can_fetch_notes(): void
    {
        Note::factory()->count(10)->create();

        $response = $this->getJson('/api/notes');

        $response->assertSuccessful();

        $this->assertCount(10, $response->json('data'));
    }
}
