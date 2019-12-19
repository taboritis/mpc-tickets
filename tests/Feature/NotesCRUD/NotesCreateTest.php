<?php

namespace Tests\Feature\NotesCRUD;

use App\User;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class NotesCreateTest
 * @package Tests\Feature\NotesCRUD
 */
class NotesCreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class);
        $this->user = create(User::class);
    }

    /** @test */
    public function a_guest_cannot_add_any_notes()
    {
        $note = [ 'content' => $this->faker->paragraph ];

        $this->json('POST', "/api{$this->user->path()}/notes", $note, $this->headers)
            ->assertUnauthorized();
        $this->json('POST', "/api{$this->ticket->path()}/notes", $note, $this->headers)
            ->assertUnauthorized();
    }
}