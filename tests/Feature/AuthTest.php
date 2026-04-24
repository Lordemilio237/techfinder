<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // 1. Enregistre un nouvel utilisateur
    public function testRegister(): void
    {
        $response = $this->post("/api/auth/register", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);
        
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'message' => 'User registered successfully'
        ]);
        
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com'
        ]);
    }

    // 2. Teste la connexion
    public function testLogin(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post("/api/auth/login", [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Login successful'
        ]);
        $response->assertJsonStructure([
            'token'
        ]);
    }

    // 3. Teste la connexion avec mauvais identifiants
    public function testLoginInvalid(): void
    {
        $response = $this->post("/api/auth/login", [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthorized'
        ]);
    }

    // 4. Teste la déconnexion
    public function testLogout(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $this->actingAs($user);
        
        $response = $this->post("/api/auth/logout");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Successfully logged out'
        ]);
    }

    // 5. Teste le renouvellement du token
    public function testRefresh(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $this->actingAs($user);
        
        $response = $this->post("/api/auth/refresh");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Token refreshed'
        ]);
        $response->assertJsonStructure([
            'token'
        ]);
    }

    // 6. Teste la récupération de l'utilisateur authentifié
    public function testMe(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $this->actingAs($user);
        
        $response = $this->get("/api/auth/me");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => ['id', 'name', 'email']
        ]);
    }
}
