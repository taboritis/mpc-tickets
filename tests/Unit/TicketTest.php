<?php

namespace Tests\Unit;

use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class TicketTest
 * @package Tests\Unit
 */
class TicketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Ticket
     */
    private $ticket;

    public function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class);
    }

    /** @test */
    public function a_ticket_factory_works_as_expected()
    {
        $this->assertInstanceOf(Ticket::class, $this->ticket);
        $this->assertNotNull($this->ticket->title);
        $this->assertNotNull($this->ticket->content);
        $this->assertDatabaseHas('users', [ 'id' => $this->ticket->requested_by ]);
    }
}