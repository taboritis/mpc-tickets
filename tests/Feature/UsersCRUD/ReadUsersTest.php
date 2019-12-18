<?php

namespace Tests\Feature\UsersCRUD;

use App\User;
use App\Note;
use Tests\TestCase;
use App\SupportMember;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadUsersTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $note;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = create(User::class);
        $this->note = create(Note::class, [ 'referable_id' => $this->user->id ]);
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
            ->assertSee($this->user->name)
            ->assertSee($this->user->surname)
            ->assertSee($this->user->email)
            ->assertSee($this->user->ticketsNo)
            ->assertSee('List of Users');
    }

    /** @test */
    public function non_auth_user_cannot_get_users_index()
    {
        $this->json('GET', '/api/users')->assertUnauthorized();
    }

    /** @test */
    public function an_auth_user_can_get_users_index()
    {
        $this->signIn();

        $this->withHeaders($this->headers)->json('GET', '/api/users')
            ->assertStatus(200)
            ->assertSee($this->user->name);
    }

    /** @test */
    public function a_typical_user_cannot_see_notes()
    {
        $user = $this->signIn();
        $this->assertFalse($user->can('view', $this->note));

        $this->get('/users')->assertOK();
    }

    /** @test */
    public function only_support_member_can_see_notes()
    {
        $supportMember = create(SupportMember::class);

        $this->signIn($supportMember);

        $this->assertTrue($supportMember->can('viewAny', $this->note));

        $this->get('/users')->assertSee($this->note->content);
    }
}
