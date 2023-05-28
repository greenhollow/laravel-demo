<?php

namespace Tests\Integration\Models;

use App\Models\Human;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HumanTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_human(): void
    {
        // create a human
        $human = Human::factory()->create();

        // confirm the human was created
        $this->assertTrue(is_int($human->id));
        $this->assertMatchesRegularExpression('/[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/',$human->uuid);
        $this->assertGreaterThan(0, strlen($human->name));
    }
}
