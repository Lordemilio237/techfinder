<?php

namespace Database\Factories;

use App\Models\UserCompetence;
use App\Models\Utilisateur;
use App\Models\Competence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserCompetence>
 */
class UserCompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_user' => Utilisateur::factory(),
            'code_comp' => Competence::factory(),
        ];
    }
}
