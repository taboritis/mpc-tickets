<?php

use App\User;
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
            'password' => env('ADMIN_PASSWORD', 'password'),
        ]);
    }
}
