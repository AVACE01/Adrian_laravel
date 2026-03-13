<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'value' => $this->faker->numberBetween($min=1, $max=9),
            'description' => $this->faker->unique()->realText(255),
            //aqui se hace una relacion
            'user_id' => User::all()->random()->id,
            'article_id' => Article::all()->random()->id,
        ];
    }
}
