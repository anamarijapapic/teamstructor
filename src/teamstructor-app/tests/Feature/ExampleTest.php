<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_requires_authentication(): void
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('login');
    }
}
