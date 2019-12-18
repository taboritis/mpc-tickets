<?php

namespace Tests\Jobs;

use App\Ticket;
use Tests\TestCase;
use App\Jobs\RemoveOldTicketsJob;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemoveOldTicketsJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_selected_job_removes_old_tickets()
    {
        $oldTickets = create(Ticket::class, [ 'closed_at' => now()->subDays(config('ticket.old') + 1) ], 2);
        $openTicket = create(Ticket::class, [ 'closed_at' => null ]);
        $newTicket = create(Ticket::class, [ 'closed_at' => now() ]);

        $this->assertEquals(4, Ticket::count());

        RemoveOldTicketsJob::dispatch();

        $this->assertEquals(2, Ticket::count());

        $this->assertDatabaseHas('tickets', [ 'id' => $openTicket->id ]);
        $this->assertDatabaseHas('tickets', [ 'id' => $newTicket->id ]);
    }
}
