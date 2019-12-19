<?php

use App\User;
use App\Note;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        create(User::class, [
            'name' => 'Piotr',
            'surname' => 'Skrobol',
            'email' => 'pio.skro@gmail.com',
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
        ]);

        create(User::class, [
            'name' => 'Typical',
            'surname' => 'User',
            'email' => 'typical.user@example.com',
        ]);

        $users = create(User::class, [], 10);

        foreach ($users as $user) {
            create(Note::class, [
                'referable_id' => $user->id,
            ], random_int(1, 4));
        }
    }
}
