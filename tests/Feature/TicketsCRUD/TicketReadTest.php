<?php

namespace Tests\Feature\TicketsCRUD;

use App\Note;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketReadTest extends TestCase
{
    use RefreshDatabase;

    private $ticket;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class);
    }

    /** @test */
    public function a_guest_cannot_see_ticket_list()
    {
        $this->get('/tickets')->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_see_ticket_list()
    {
        $this->signIn();

        $this->get('/tickets')->assertOk();
    }

    /** @test */
    public function a_guest_cannot_get_of_tickets()
    {
        $this->withHeaders($this->headers)
            ->json('GET', '/api/tickets')
            ->assertUnauthorized();
    }

    /** @test */
    public function an_auth_user_can_get_list_of_tickets()
    {
        $this->signIn();

        $this->withHeaders($this->headers)
            ->json('GET', '/api/tickets')
            ->assertSee($this->ticket->title)
            ->assertSee($this->ticket->content)
            ->assertSee($this->ticket->assignedTo->fullname())
            ->assertSee($this->ticket->author->fullname());
    }

    /** @test */
    public function limit_response_to_100_tickets()
    {
        $this->signIn();
        create(Ticket::class, [], 150);

        $response = $this->withHeaders($this->headers)
            ->json('GET', '/api/tickets', [ 'limit' => 300 ])
            ->assertJsonCount(100, 'data');
    }

    /** @test */
    public function a_guest_cannot_see_details_page()
    {
        $this->get($this->ticket->path())->assertRedirect('/login');
    }

    /** @test */
    public function owner_can_see_ticket()
    {
        $this->signIn($this->ticket->author);

        $note = create(Note::class, [ 'referable_type' => Ticket::class, 'referable_id' => $this->ticket->id ]);

        $this->get($this->ticket->path())
            ->assertSee($note->content)
            ->assertSee($this->ticket->title)
            ->assertSee($this->ticket->content)
            ->assertOk();
    }
}