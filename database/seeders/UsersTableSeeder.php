<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $users = [];

    for ($a = 0; $a < 20; $a++) {
        $users[] = [
            'username' => $a . '@gmail.com',
            'password' => bcrypt($a),
            'created_at' => now(),
        ];
    }

    DB::table('users')->insert($users);
}

}
