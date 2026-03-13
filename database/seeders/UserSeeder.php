<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Adrian',
            'email' => 'test@test.com',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'full_name' => 'Jose',
            'email' => 'josetest@test.com',
            'password' => Hash::make('1235678'),
        ]);

//aqui cremos la cantidad de usuarios que se hacen en este caso 10
                User::factory(10)->create();



        //Hash:: bcrypt('123') este es para incryptar la contrase;a
    }
}
