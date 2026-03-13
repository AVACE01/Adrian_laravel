<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             // Foto de perfil (imagen de placeholder)
            'photo'=>'categories/'.$this->faker->image('public/storage/categories', 640, 480, null, false),

            // Profesión (texto corto, máximo 60)
            'profession' => $this->faker->jobTitle(),

            // Sobre mí (texto realista, máximo 255)
            'about'      => $this->faker->realText(255), // dejamos margen

            // Fecha de nacimiento (formato Y-m-d, anterior a 2005)
            'birthday'   => $this->faker->date('Y-m-d', '2005-01-01'),

            // Redes sociales (nombre de usuario, máximo 100)
            'twitter'    => $this->faker->userName(),
            'linkedin'   => $this->faker->userName(),
            'facebook'   => $this->faker->userName(),
            
            //este ya no se usa por que ya se asigna los id en el ProfileSeeder
            //'user_id' => User::all()->random()->id,
        ];
    }
}
