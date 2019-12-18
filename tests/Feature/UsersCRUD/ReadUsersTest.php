<?php

namespace Tests\Feature\UsersCRUD;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadUsersTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = create(User::class);
    }

    /** @test */
    public function a_guest_cannot_see_list_of_users()
    {
        $this->get('/users')->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_see_list_of_users()
    {
        $this->signIn();

        $this->get('/users')
            ->assertOk()
            ->assertSee('List of Users');
    }
}
