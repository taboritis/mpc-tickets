<?php

namespace Tests\Feature\TicketsCRUD;

use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class TicketUpdateTest
 * @package Tests\Feature\TicketsCRUD
 */
class TicketUpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Ticket
     */
    private $ticket;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticket = create(Ticket::class);
    }

    /** @test */
    public function a_guest_cannot_update_ticket()
    {
        $inputs = [
            'content' => $this->faker->paragraph,
        ];

        $this->json('PUT', '/api' . $this->ticket->path(), $inputs, $this->headers)
            ->assertUnauthorized();
    }

    /** @test */
    public function author_can_update_ticket()
    {
        $this->signIn($this->ticket->author);

        $this->assertAuthenticatedAs($this->ticket->author);

        $inputs = [
            'content' => $this->faker->paragraph,
        ];

        $res = $this->json('PUT', '/api' . $this->ticket->path(), $inputs, $this->headers)
            ->assertStatus(200);

        $this->assertEquals($inputs['content'], $this->ticket->fresh()->content);
    }

    /** @test */
    public function non_author_cannot_update_ticket()
    {
        $this->signIn();

        $inputs = [ 'content' => $this->faker->paragraph ];

        $res = $this->json('PUT', '/api' . $this->ticket->path(), $inputs, $this->headers)
            ->assertStatus(403);

        $this->assertNotEquals($inputs['content'], $this->ticket->fresh()->content);
    }

    /** @test */
    public function support_member_can_update_ticket()
    {
        $this->signInAsSupportMember();
        $inputs = [
            'content' => $this->faker->paragraph,
        ];

        $res = $this->json('PUT', '/api' . $this->ticket->path(), $inputs, $this->headers)
            ->assertStatus(200);

        $this->assertEquals($inputs['content'], $this->ticket->fresh()->content);
    }
}