<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        "code_user"=>$this ->faker->unique()->bothify("USR ####"),
        "nom_user" =>$this ->faker->lastname(),
        "prenom_user"=>$this ->faker->firstname(),
        "login_user"=>$this ->faker->unique()->userName(),
        "password_user"=>Hash::make("password"),
        "tel_user"=>$this ->faker->phoneNumber(),
        "sexe_user"=>$this ->faker->randomElement(["M","F"]),
        "role_user"=>$this ->faker->randomElement(["technicien","client","admin"]),
        "etat_user"=>$this ->faker->randomElement(["actif","inactif","bloquer"]),

        ];
    }
}
