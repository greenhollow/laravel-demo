<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HumanControllerTest extends TestCase
{
    public function test_create_with_prohibited_uuid_input(): void
    {
        $response = $this->post('/api/humans', [
            'uuid' => '11111111-2222-3333-4444-555555555555',
            'name' => 'Some Gal',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function test_create_with_valid_input(): void
    {
        $response = $this->post('/api/humans', [
            'name' => 'Some Gal',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(['data' => ['name' => 'Some Gal']]);
        $response->assertJsonPath('data.uuid', fn($value) => is_string($value));
        $response->assertJsonMissingPath('data.id');
    }
}
