<?php

namespace Tests\Unit;

use App\Ticket;
use Tests\TestCase;
use App\SupportMember;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupportMemberTest extends TestCase
{
    use RefreshDatabase;

    private $supportMember;

    protected function setUp(): void
    {
        parent::setUp();
        $this->supportMember = create(SupportMember::class);
    }

    /** @test */
    public function a_support_member_factory_works_as_expected()
    {
        $this->assertInstanceOf(SupportMember::class, $this->supportMember);
        $this->assertNotNull($this->supportMember->name);
        $this->assertNotNull($this->supportMember->surname);
        $this->assertNotNull($this->supportMember->type);
        $this->assertNotFalse(filter_var($this->supportMember->email, FILTER_VALIDATE_EMAIL));
    }

    /** @test */
    public function a_support_member_has_assigned_tickets()
    {
        $assignedTickets = create(Ticket::class, [
            'assigned_to' => $this->supportMember->id,
        ], 2);

        $otherTickets = create(Ticket::class, [
            'assigned_to' => create(SupportMember::class)->id,
            'requested_by' => $this->supportMember->id,
        ]);

        $this->assertCount(2, $this->supportMember->tickets);
    }
}