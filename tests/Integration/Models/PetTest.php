<?php

namespace Tests\Integration\Models;

use App\Models\Pet;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetTest extends TestCase
{
    use RefreshDatabase;

    public function test_scope_born_this_month(): void
    {
        // create some pets born each month last year
        $dob = new DateTime('-1 year');
        for ($i = 1; $i <= 12; $i++) {
            $dob->setDate($dob->format('Y'), $i, 1);
            Pet::factory()->create([
                'name' => $dob->format('F'),
                'date_of_birth' => $dob,
            ]);
        }

        // query by born this month scope
        $petsOfTheMonth = Pet::bornThisMonth()->get();

        // confirm we got the expected pet
        $this->assertCount(1, $petsOfTheMonth);
        $this->assertInstanceOf(DateTime::class, $petsOfTheMonth->first()->date_of_birth);
        $this->assertEquals(date('m'), $petsOfTheMonth->first()->date_of_birth->format('m'));
    }
}
