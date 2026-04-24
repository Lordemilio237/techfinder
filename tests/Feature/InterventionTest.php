<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Intervention;
use App\Models\Utilisateur;
use App\Models\Competence;

class InterventionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // 1. Liste toutes les interventions
    public function testInterventionList(): void
    {
        $response = $this->get("/api/interventions");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['code_int', 'date_int', 'note_int', 'code_user_client', 'code_user_techn', 'code_comp']
        ]);
    }

    // 2. Crée une intervention
    public function testInterventionStore(): void
    {
        $client = Utilisateur::where('role_user', 'client')->first();
        $technicien = Utilisateur::where('role_user', 'technicien')->first();
        $competence = Competence::first();

        $response = $this->post("/api/interventions", [
            'date_int' => '2026-04-20',
            'note_int' => 5,
            'commentaire_int' => 'Test intervention',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp
        ]);
        $response->assertStatus(201);
    }

    // 3. Affiche une intervention
    public function testInterventionShow(): void
    {
        $intervention = Intervention::first();
        $response = $this->get("/api/interventions/{$intervention->code_int}");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'code_int' => $intervention->code_int
        ]);
    }

    // 4. Met à jour une intervention
    public function testInterventionUpdate(): void
    {
        $intervention = Intervention::first();
        $response = $this->put("/api/interventions/{$intervention->code_int}", [
            'note_int' => 10,
            'commentaire_int' => 'Updated comment'
        ]);
        $response->assertStatus(200);
    }

    // 5. Supprime une intervention
    public function testInterventionDestroy(): void
    {
        $intervention = Intervention::first();
        $response = $this->delete("/api/interventions/{$intervention->code_int}");
        $response->assertStatus(200);
    }

    // 6. Validation création intervention - retourne 500 car le contrôleur catch l'exception
    public function testInterventionStoreValidation(): void
    {
        $response = $this->post("/api/interventions", []);
        $response->assertStatus(500);
    }

    // 7. Validation mise à jour intervention - retourne 500 car le contrôleur catch l'exception
    public function testInterventionUpdateValidation(): void
    {
        $intervention = Intervention::first();
        $response = $this->put("/api/interventions/{$intervention->code_int}", [
            'note_int' => 'invalid'
        ]);
        $response->assertStatus(500);
    }

    // 8. Intervention non trouvée
    public function testInterventionShowNotFound(): void
    {
        $response = $this->get("/api/interventions/99999");
        $response->assertStatus(404);
    }

    // 9. Suppression intervention non trouvée
    public function testInterventionDestroyNotFound(): void
    {
        $response = $this->delete("/api/interventions/99999");
        $response->assertStatus(404);
    }
}
