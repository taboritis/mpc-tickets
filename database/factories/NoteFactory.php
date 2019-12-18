<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use App\User;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'author_id' => 1,
        'content' => $faker->sentence,
        'referable_type' => User::class,
        'referable_id' => create(User::class)->id,
    ];
});
