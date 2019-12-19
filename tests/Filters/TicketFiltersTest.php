<?php

namespace Tests\Filters;

use App\Ticket;
use Tests\TestCase;
use App\SupportMember;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function scope_assigned_show_tickets_related_to_assigned_to_user()
    {
        $this->signIn();

        $supportMember1 = create(SupportMember::class, [ 'name' => 'John', 'surname' => 'Doe' ]);
        $supportMember2 = create(SupportMember::class, [ 'name' => 'Mary', 'surname' => 'Smith' ]);
        create(Ticket::class, [ 'assigned_to' => $supportMember1->id ], 2);
        create(Ticket::class, [ 'assigned_to' => $supportMember2->id ]);

        $this->json('GET', '/api/tickets', [ 'assignedTo' => 'Joh' ], $this->headers)
            ->assertJsonCount(2, 'data');
    }
}
