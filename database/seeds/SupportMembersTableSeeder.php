<?php

use App\SupportMember;
use Illuminate\Database\Seeder;

class SupportMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        create(SupportMember::class, [
            'name' => 'Support',
            'surname' => 'Member',
            'email' => 'support.member@example.com',
        ]);

        create(SupportMember::class, [], 5);
    }
}
