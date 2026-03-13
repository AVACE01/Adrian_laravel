<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->realText(55);


        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'introduccion' => $this->faker->realText(255),
            'imagen' => 'articles/'.$this->faker->image('public/storage/article', 640, 480, null, false),
            //'imagen' => $this->faker->image('public/storage/article', 640, 480, null, true),
            //esto es lo que generara con true public/storage/article/foto.png (true)
            //esto es lo que generara con false foto.png (false)
            //esta es la que utilizamos:article/foto.png (false)
            'body' => $this->faker->text(2000),
            'status'=> $this->faker->boolean(),
            //aqui se hace una relacion
            'user_id'=> User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }
}
