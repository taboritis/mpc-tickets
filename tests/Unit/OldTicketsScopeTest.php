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

    /**
     * @var mixed
     */
    private $ticket;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class, [ 'closed_at' => null ]);
    }

    /** @test */
    public function a_scope_old_not_contains_not_closed_tickets()
    {
        $tickets = Ticket::old()->count();

        $this->assertEquals(0, $tickets);
    }
}