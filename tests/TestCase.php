<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var array
     */
    protected $headers;

    protected function signIn(User $user = null)
    {
        $user = $user ?? create(User::class);
        $this->setHeaders($user);
        $this->actingAs($user);

        return $user;
    }

    /**
     * @param User $user
     */
    protected function setHeaders(User $user): void
    {
        $this->headers = [ 'Authorization' => 'Bearer ' . $user->api_token ];
    }
}
