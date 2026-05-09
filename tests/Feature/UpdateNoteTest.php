<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateNoteTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function can_update_note()
    {
        $note = Note::factory()->create();
        $name = 'New note name';
        $content = 'New content name';

        $response = $this->postJson("api/notes/{$note->uuid}", [
            'name' => $name,
            'content' => $content,
        ]);

        $response->assertSuccessful();

        $note->refresh();

        $this->assertSame($name, $note->name);
        $this->assertSame($content, $note->content);
    }

    #[Test]
    public function name_must_be_a_string()
    {
        $this->assertFieldIsInvalid(['name' => 1234]);
    }

    #[Test]
    public function content_must_be_a_string()
    {
        $this->assertFieldIsInvalid(['content' => 1234]);
    }

    #[Test]
    public function other_fields_cannot_be_changed()
    {
        $this->assertFieldIsInvalid(['id' => 'change']);
        $this->assertFieldIsInvalid(['uuid' => 'change']);
        $this->assertFieldIsInvalid(['created_at' => 'change']);
        $this->assertFieldIsInvalid(['updated_at' => 'change']);
    }

    private function assertFieldIsInvalid(array $field)
    {
        $note = Note::factory()->create();

        $name = 'New note name';
        $content = 'New content name';

        $valid = [
            'name' => $name,
            'content' => $content,
        ];

        $response = $this->postJson("api/notes/{$note->uuid}", array_merge($valid, $field));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors(array_key_first($field));
    }
}
