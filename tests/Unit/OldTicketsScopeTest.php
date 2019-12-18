<?php

namespace Tests\Unit;

use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class OldTicketsScopeTest
 * @package Tests\Unit
 */
class OldTicketsScopeTest extends TestCase
{
    use RefreshDatabase;

    protected $daysNo;

    /**
     * @var mixed
     */
    private $ticket;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class, [ 'closed_at' => null ]);
        $this->daysNo = config('ticket.old');
    }

    /** @test */
    public function a_scope_old_not_contains_not_closed_tickets()
    {
        $tickets = Ticket::old()->count();

        $this->assertEquals(0, $tickets);
    }

    /** @test */
    public function a_scope_old_contains_only_tickets_where_closed_date_is_lesser_than_defined()
    {
        create(Ticket::class, [ 'closed_at' => now()->subDays($this->daysNo + 1) ], 3);
        create(Ticket::class, [ 'closed_at' => now()->subDays($this->daysNo - 1) ]);

        $ticketsNo = Ticket::old()->count();

        $this->assertEquals(3, $ticketsNo);
    }
}