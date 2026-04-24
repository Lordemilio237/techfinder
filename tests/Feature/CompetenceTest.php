<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Competence;

class CompetenceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // 1. Liste toutes les compétences
    public function testCompetenceList(): void
    {
        $response = $this->get("/api/competences");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['code_comp', 'label_comp', 'description_comp']
        ]);
    }

    // 2. Crée une compétence
    public function testCompetenceStore(): void
    {
        $response = $this->post("/api/competences", [
            'label_comp' => 'Test Competence',
            'description_comp' => 'Test Description'
        ]);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'label_comp' => 'Test Competence'
        ]);
    }

    // 3. Affiche une compétence
    public function testCompetenceShow(): void
    {
        $competence = Competence::first();
        $response = $this->get("/api/competences/{$competence->code_comp}");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'code_comp' => $competence->code_comp
        ]);
    }

    // 4. Met à jour une compétence
    public function testCompetenceUpdate(): void
    {
        $competence = Competence::first();
        $response = $this->put("/api/competences/{$competence->code_comp}", [
            'label_comp' => 'Updated Competence',
            'description_comp' => 'Updated Description'
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'label_comp' => 'Updated Competence'
        ]);
    }

    // 5. Supprime une compétence
    public function testCompetenceDestroy(): void
    {
        $competence = Competence::first();
        $response = $this->delete("/api/competences/{$competence->code_comp}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('competences', [
            'code_comp' => $competence->code_comp
        ]);
    }

    // 6. Validation création compétence
    public function testCompetenceStoreValidation(): void
    {
        $response = $this->post("/api/competences", []);
        $response->assertStatus(302);
    }

    // 7. Validation mise à jour compétence
    public function testCompetenceUpdateValidation(): void
    {
        $competence = Competence::first();
        $response = $this->put("/api/competences/{$competence->code_comp}", [
            'label_comp' => ''
        ]);
        $response->assertStatus(302);
    }

    // 8. Compétence non trouvée - retourne 200 avec erreur dans le JSON
    public function testCompetenceShowNotFound(): void
    {
        $response = $this->get("/api/competences/99999");
        $response->assertStatus(200);
        $response->assertJsonStructure(['error']);
    }

    // 9. Suppression compétence non trouvée - retourne 200 avec erreur dans le JSON
    public function testCompetenceDestroyNotFound(): void
    {
        $response = $this->delete("/api/competences/99999");
        $response->assertStatus(200);
        $response->assertJsonStructure(['error']);
    }
}
