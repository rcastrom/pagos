<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'IT Ensenada',
            'email'=>'ensenada@congresoescala.com',
            'password'=>bcrypt('123456'),
        ]);
    }
}
