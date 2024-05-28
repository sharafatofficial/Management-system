<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'      => 'Qaiser',
            'email'     => 'qaiser@sis.com',
            'user_type' => 1,
            'password'  => bcrypt(123456)
        ]);
    }
}
