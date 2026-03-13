<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->take(10)->get(); // tomar 10 usuarios al azar
        foreach ($users as $user) {
            Profile::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
