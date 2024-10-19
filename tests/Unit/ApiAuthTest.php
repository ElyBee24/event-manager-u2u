<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    public function test_api_with_key(): void 
    {
        $this->withHeaders([
            'x-api-key' => env('API_KEY'),
        ]);

        $response = $this->get('/api/attendees');

        $response->assertStatus(200);
    }

    public function test_api_no_key(): void 
    {
        $response = $this->get('/api/attendees');

        $response->assertStatus(401);
    }

    public function test_api_wrong_key(): void 
    {
        $this->withHeaders([
            'x-api-key' => 'let me in',
        ]);

        $response = $this->get('/api/attendees');

        $response->assertStatus(401);
    }
}
