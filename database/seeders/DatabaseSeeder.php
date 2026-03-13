<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Profile;
use App\Models\User;
use Database\Factories\ProfilesFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Eliminar carpetas
        Storage::deleteDirectory('article');
        Storage::deleteDirectory('categories');

        //Crear carpetas
        Storage::makeDirectory('article');
        Storage::makeDirectory('categories');

        // aqui llamamos al seeder de usuarios
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);



        // aqui llamamos al factorys de usuarios

        Category::factory(8)->create();
        Article::factory(20)->create();
        Comments::factory(20)->create();
    }
}
