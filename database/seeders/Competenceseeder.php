<?php

namespace Database\Seeders;
use App\Models\Competence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Competenceseeder extends Seeder
{
    /**
     * Run the database seeds.+
     */
    public function run(): void
    {
        Competence::factory(100)->create(); // pour générer 100 éléments
    }
}
