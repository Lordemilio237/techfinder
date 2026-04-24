<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use App\Models\Competence;
use App\Models\Intervention;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_int' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'note_int' => $this->faker->numberBetween(0, 10),
            'commentaire_int' => $this->faker->sentence(10),
            'code_user_client' => Utilisateur::factory(),
            'code_user_techn' => Utilisateur::factory(),
            'code_comp' => Competence::factory(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Intervention $intervention) {
            // Optionally set the relations after creation
            $intervention->client;
            $intervention->technicien;
            $intervention->competence;
        });
    }
}
