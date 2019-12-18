<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use App\User;
use App\SupportMember;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'author_id' => existedOrNew(SupportMember::class)->id,
        'content' => $faker->sentence,
        'referable_type' => User::class,
        'referable_id' => existedOrNew(User::class)->id,
    ];
});
