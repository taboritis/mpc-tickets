<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SupportMember;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(SupportMember::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'type' => 'support_member',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'api_token' => Str::random(30),
    ];
});
