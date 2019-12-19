<?php

namespace Tests\Unit;

use App\Note;
use App\User;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    private $note;

    protected function setUp(): void
    {
        parent::setUp();
        $this->note = create(Note::class);
    }

    /** @test */
    public function a_note_factory_works_as_expected()
    {
        $this->assertInstanceOf(Note::class, $this->note);
        $this->assertIsNumeric($this->note->author_id);
        $this->assertNotNull($this->note->content);
        $this->assertNotNull($this->note->created_at);
        $this->assertNotNull($this->note->updated_at);
    }

    /** @test */
    public function a_note_has_an_author()
    {
        $this->assertInstanceOf(User::class, $this->note->author);
    }

    /** @test */
    public function a_note_can_refers_to_user()
    {
        $this->assertInstanceOf(User::class, $this->note->referable);
    }

    /** @test */
    public function a_note_can_refers_to_ticket()
    {
        $note = create(Note::class, [
            'referable_type' => Ticket::class,
            'referable_id' => create(Ticket::class)->id,
        ]);

        $this->assertInstanceOf(Ticket::class, $note->referable);
    }
}