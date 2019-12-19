<?php

namespace Tests\Feature\TicketsCRUD;

use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_create_ticket()
    {
        $ticket = make(Ticket::class);

        $this->json('POST', '/api/tickets', $ticket->toArray())
            ->assertUnauthorized();
    }

    /** @test */
    public function an_user_can_create_ticket()
    {
        $this->signIn();

        $ticket = make(Ticket::class);

        $this->json('POST', '/api/tickets', $ticket->toArray(), $this->headers)
            ->assertStatus(201);

        $this->assertDatabaseHas('tickets', [
            'title' => $ticket->title,
            'content' => $ticket->content,
        ]);
    }
}