<?php

use App\Note;
use App\Ticket;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        create(Ticket::class, [], 30);

        foreach (Ticket::all() as $ticket) {
            create(Note::class, [
                'referable_type' => Ticket::class,
                'referable_id' => $ticket->id,
            ], random_int(1, 5));
        }
    }
}
