<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@dev.com',
            'user_type'=>'ADM',
            'email_verified_at' => now(),
            'password' => bcrypt('Pa$$w0rd!'),
            'remember_token' => str()->random(10),
        ]);

        User::factory(10)->create();
    }
}
