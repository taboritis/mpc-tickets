<?php

namespace Tests\Feature\TicketsCRUD;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketReadTest extends TestCase
{
    use RefreshDatabase;

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
}