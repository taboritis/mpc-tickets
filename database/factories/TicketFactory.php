<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Ticket;
use App\SupportMember;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'content' => $faker->sentence,
        'requested_by' => create(User::class)->id,
        'assigned_to' => create(SupportMember::class)->id,
    ];
});
