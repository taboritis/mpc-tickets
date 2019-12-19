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

    /**
     * @var string
     */
    private $userEndpoint;

    /**
     * @var string
     */
    private $ticketEndpoint;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class);
        $this->user = create(User::class);
        $this->userEndpoint = "/api{$this->user->path()}/notes";
        $this->ticketEndpoint = "/api{$this->ticket->path()}/notes";
    }

    /** @test */
    public function a_guest_cannot_add_any_notes()
    {
        $note = [ 'content' => $this->faker->paragraph ];

        $this->json('POST', $this->userEndpoint, $note, $this->headers)
            ->assertUnauthorized();
        $this->json('POST', $this->ticketEndpoint, $note, $this->headers)
            ->assertUnauthorized();
    }

    /** @test */
    public function an_authenticated_user_can_create_note_related_to_ticket()
    {
        $this->signIn();

        $note = [ 'content' => $this->faker->paragraph ];

        $this->json('POST', $this->ticketEndpoint, $note, $this->headers)
            ->assertStatus(201);

        $this->assertDatabaseHas('notes', [
            'referable_type' => Ticket::class,
            'referable_id' => $this->ticket->id,
            'content' => $note['content'],
        ]);
    }

    /** @test */
    public function a_support_member_can_create_note_related_to_user()
    {
        $this->signInAsSupportMember();
        $note = [ 'content' => $this->faker->paragraph ];

        $this->json('POST', $this->userEndpoint, $note, $this->headers)
            ->assertStatus(201);

        $this->assertDatabaseHas('notes', [
            'referable_type' => User::class,
            'referable_id' => $this->user->id,
            'content' => $note['content'],
        ]);
    }

    /** @test */
    public function a_typical_user_cannot_create_note_related_to_user()
    {
        $this->signIn();

        $note = [ 'content' => $this->faker->paragraph ];

        $this->json('POST', $this->userEndpoint, $note, $this->headers)
            ->assertStatus(403);

        $this->assertDatabaseMissing('notes', [
            'referable_type' => User::class,
            'referable_id' => $this->user->id,
            'content' => $note['content'],
        ]);
    }
}