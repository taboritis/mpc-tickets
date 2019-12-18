<?php

use App\Note;
use App\Ticket;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $tickets = create(Ticket::class, [
            'closed_at' => $faker->randomElement([
                null,
                $faker->dateTimeBetween('-3 months', 'now'),
            ]),
        ], 1000);

        foreach ($tickets as $ticket) {
            create(Note::class, [
                'referable_type' => Ticket::class,
                'referable_id' => $ticket->id,
            ], random_int(1, 5));
        }
    }
}
