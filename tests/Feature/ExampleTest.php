<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_api_routes_are_accessible(): void
    {
        // Test that the API is accessible
        $response = $this->getJson('/api/competences');
        $response->assertStatus(200);
    }
}
