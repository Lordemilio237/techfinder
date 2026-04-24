<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\UserCompetence;
use App\Models\Utilisateur;
use App\Models\Competence;

class UserCompetenceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // 1. Liste toutes les associations user-competence
    public function testUserCompetenceList(): void
    {
        $response = $this->get("/api/user-competences");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['code_user', 'code_comp']
        ]);
    }

    // 2. Crée une association user-competence
    public function testUserCompetenceStore(): void
    {
        $utilisateur = Utilisateur::first();
        $competence = Competence::first();

        $response = $this->post("/api/user-competences", [
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp
        ]);
        $response->assertStatus(201);
    }

    // 3. Affiche une association spécifique
    public function testUserCompetenceShow(): void
    {
        $userComp = UserCompetence::first();
        $response = $this->get("/api/user-competences/{$userComp->code_user}/{$userComp->code_comp}");
        $response->assertStatus(200);
    }

    // 4. Met à jour une association
    public function testUserCompetenceUpdate(): void
    {
        $userComp = UserCompetence::first();
        $competence2 = Competence::where('code_comp', '!=', $userComp->code_comp)->first();
        
        if ($competence2) {
            $response = $this->put("/api/user-competences/{$userComp->code_user}/{$userComp->code_comp}", [
                'code_comp' => $competence2->code_comp
            ]);
            $response->assertStatus(200);
        }
    }

    // 5. Supprime une association
    public function testUserCompetenceDestroy(): void
    {
        $userComp = UserCompetence::first();
        $response = $this->delete("/api/user-competences/{$userComp->code_user}/{$userComp->code_comp}");
        $response->assertStatus(200);
    }

    // 6. Validation création association
    public function testUserCompetenceStoreValidation(): void
    {
        $response = $this->post("/api/user-competences", []);
        $response->assertStatus(302);
    }

    // 7. Validation mise à jour association
    public function testUserCompetenceUpdateValidation(): void
    {
        $userComp = UserCompetence::first();
        $response = $this->put("/api/user-competences/{$userComp->code_user}/{$userComp->code_comp}", [
            'code_user' => 'invalid'
        ]);
        $response->assertStatus(302);
    }

    // 8. Association non trouvée
    public function testUserCompetenceShowNotFound(): void
    {
        $response = $this->get("/api/user-competences/99999/99999");
        $response->assertStatus(404);
    }

    // 9. Suppression association non trouvée
    public function testUserCompetenceDestroyNotFound(): void
    {
        $response = $this->delete("/api/user-competences/99999/99999");
        $response->assertStatus(404);
    }
}
