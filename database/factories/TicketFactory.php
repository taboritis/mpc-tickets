<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Ticket;
use App\SupportMember;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraphs(3, true),
        'requested_by' => existedOrNew(User::class)->id,
        'assigned_to' => existedOrNew(SupportMember::class)->id,
        'closed_at' => $faker->randomElement([ now(), null ]),
    ];
});
