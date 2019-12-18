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

    protected function signIn(User $user = null)
    {
        $user = $user ?? create(User::class);
        $this->actingAs($user);

        return $user;
    }
}
