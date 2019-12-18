<?php

namespace Tests\Unit;

use App\Note;
use App\User;
use App\Ticket;
use Tests\TestCase;
use App\SupportMember;
use Illuminate\Database\Eloquent\Collection;
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
        $this->assertNotNull($this->ticket->closed_at);
        $this->assertDatabaseHas('users', [ 'id' => $this->ticket->requested_by ]);
    }

    /** @test */
    public function a_ticket_has_many_notes()
    {
        $this->assertInstanceOf(Collection::class, $this->ticket->notes);
        $this->assertCount(0, $this->ticket->notes);

        create(Note::class, [ 'referable_type' => Ticket::class, 'referable_id' => $this->ticket->id ]);
        $this->assertCount(1, $this->ticket->fresh()->notes);
    }

    /** @test */
    public function as_ticket_is_deleted_a_refered_notes_are_deleted_aswell()
    {
        create(Note::class, [ 'referable_type' => Ticket::class, 'referable_id' => $this->ticket->id ]);
        $this->ticket->delete();

        $this->assertEquals(0, Note::count());
    }

    /** @test */
    public function a_ticket_has_an_author()
    {
        $this->assertInstanceOf(User::class, $this->ticket->author);
    }

    /** @test */
    public function a_ticket_can_be_assigned()
    {
        $this->assertInstanceOf(SupportMember::class, $this->ticket->assignedTo);
    }
}