<?php

namespace Tests\Feature;

use App\Models\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
    public function setUp(): void
    {
        Event::factory()->count(2)->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_api_index(): void
    {
        $response = $this->get('/api/events');

        dd($response->dump());

        $response->assertStatus(200);
    }
}
