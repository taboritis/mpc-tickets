<?php

namespace Tests\Unit;

use App\User;
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
        $this->assertNotFalse(filter_var($this->user->email, FILTER_VALIDATE_EMAIL));
    }
}
