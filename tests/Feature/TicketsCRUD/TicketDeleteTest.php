<?php

namespace Tests\Feature\TicketsCRUD;

use App\User;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketDeleteTest extends TestCase
{
    use RefreshDatabase;

    private $ticket;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class);
    }

    /** @test */
    public function a_guest_cannot_delete_ticket()
    {
        $this->json('DELETE', '/api' . $this->ticket->path())->assertUnauthorized();
    }

    /** @test */
    public function random_user_cant_delete_ticket()
    {
        $this->signIn();
        $this->json('DELETE', '/api' . $this->ticket->path(), [], $this->headers)
            ->assertStatus(403);

        $this->assertDatabaseHas('tickets', [ 'id' => $this->ticket->id ]);
    }

    /** @test */
    public function only_admin_can_delete_tickets()
    {
        $user = create(User::class, [ 'email' => 'admin@admin.com' ]);
        $this->signIn($user);

        $this->json('DELETE', '/api' . $this->ticket->path(), [], $this->headers)
            ->assertStatus(204);

        $this->assertDatabaseMissing('tickets', [ 'id' => $this->ticket->id ]);
    }
}