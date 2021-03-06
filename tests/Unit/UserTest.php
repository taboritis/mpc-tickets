<?php

namespace Tests\Unit;

use App\User;
use App\Note;
use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = create(User::class);
    }

    /** @test */
    public function an_user_factory_works_as_expected()
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertNotNull($this->user->name);
        $this->assertNotNull($this->user->surname);
        $this->assertNotNull($this->user->type);
        $this->assertNotFalse(filter_var($this->user->email, FILTER_VALIDATE_EMAIL));
    }

    /** @test */
    public function an_user_has_many_tickets()
    {
        $ticketsCreatedByUser = create(Ticket::class, [
            'requested_by' => $this->user->id,
        ], 2);
        $otherTicket = create(Ticket::class, [ 'requested_by' => create(User::class)->id ]);

        $this->assertCount(2, $this->user->tickets);
    }

    /** @test */
    public function an_user_has_many_notes()
    {
        $relatedNotes = create(Note::class, [
            'referable_type' => User::class,
            'referable_id' => $this->user->id,
        ], 2);

        $unrelatedNotes = create(Note::class, [ 'referable_id' => create(User::class)->id ]);

        $this->assertEquals(3, Note::count());
        $this->assertCount(2, $this->user->notes);
    }

    /** @test */
    public function a_user_has_a_fullname()
    {
        $fullname = $this->user->name . ' ' . $this->user->surname;
        $this->assertEquals($fullname, $this->user->fullname());
    }

    /** @test */
    public function an_user_has_a_path()
    {
        $path = '/users/' . $this->user->id;
        $this->assertEquals($path, $this->user->path());
    }
}
