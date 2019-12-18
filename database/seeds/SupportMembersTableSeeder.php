<?php

use Illuminate\Database\Seeder;

class SupportMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        create(SupportMembersTableSeeder::class, [], 10);
    }
}
