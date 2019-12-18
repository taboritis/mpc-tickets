<?php

namespace Tests\Feature\NotesCRUD;

use App\Note;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotesReadTest extends TestCase
{
    use RefreshDatabase;

    private $note1;

    private $note2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->note1 = create(Note::class);
        $this->note2 = create(Note::class, [
            'referable_type' => Ticket::class,
            'referable_id' => create(Ticket::class)->id,
        ]);
    }

    /** @test */
    public function a_guest_cannot_see_list_of_notes()
    {
        $this->get('/notes')->assertRedirect('/login');
    }

    /** @test */
    public function a_typical_user_cannot_see_list_of_notes()
    {
        $this->signIn();
        $this->get('/notes')
            ->assertRedirect('/tickets')
            ->assertSessionHasErrors();
    }
}