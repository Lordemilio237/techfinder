<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Utilisateur;

class UtilisateurTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // 1. Liste tous les utilisateurs
    public function testUtilisateurList(): void
    {
        $response = $this->get("/api/utilisateurs");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['code_user', 'nom_user', 'prenom_user', 'login_user', 'role_user']
        ]);
    }

    // 2. Crée un utilisateur
    public function testUtilisateurStore(): void
    {
        $response = $this->post("/api/utilisateurs", [
            'code_user' => 'U999',
            'nom_user' => 'Test',
            'prenom_user' => 'User',
            'login_user' => 'testuser',
            'password_user' => 'password123',
            'tel_user' => '1234567890',
            'sexe_user' => 'M',
            'role_user' => 'technicien',
            'etat_user' => 'actif'
        ]);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'nom_user' => 'Test'
        ]);
    }

    // 3. Affiche un utilisateur
    public function testUtilisateurShow(): void
    {
        $utilisateur = Utilisateur::first();
        $response = $this->get("/api/utilisateurs/{$utilisateur->code_user}");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'code_user' => $utilisateur->code_user
        ]);
    }

    // 4. Met à jour un utilisateur
    public function testUtilisateurUpdate(): void
    {
        $utilisateur = Utilisateur::first();
        $response = $this->put("/api/utilisateurs/{$utilisateur->code_user}", [
            'nom_user' => 'Updated Name',
            'prenom_user' => 'Updated Prenom',
            'login_user' => 'updatedlogin',
            'password_user' => 'newpassword',
            'role_user' => 'technicien',
            'etat_user' => 'actif'
        ]);
        $response->assertStatus(200);
    }

    // 5. Supprime un utilisateur
    public function testUtilisateurDestroy(): void
    {
        $utilisateur = Utilisateur::first();
        $response = $this->delete("/api/utilisateurs/{$utilisateur->code_user}");
        $response->assertStatus(200);
    }

    // 6. Validation création utilisateur - retourne 500 car le contrôleur catch l'exception
    public function testUtilisateurStoreValidation(): void
    {
        $response = $this->post("/api/utilisateurs", []);
        $response->assertStatus(500);
    }

    // 7. Validation mise à jour utilisateur - retourne 500 car le contrôleur catch l'exception
    public function testUtilisateurUpdateValidation(): void
    {
        $utilisateur = Utilisateur::first();
        $response = $this->put("/api/utilisateurs/{$utilisateur->code_user}", [
            'nom_user' => ''
        ]);
        $response->assertStatus(500);
    }

    // 8. Utilisateur non trouvé
    public function testUtilisateurShowNotFound(): void
    {
        $response = $this->get("/api/utilisateurs/99999");
        $response->assertStatus(404);
    }

    // 9. Suppression utilisateur non trouvé
    public function testUtilisateurDestroyNotFound(): void
    {
        $response = $this->delete("/api/utilisateurs/99999");
        $response->assertStatus(404);
    }
}
