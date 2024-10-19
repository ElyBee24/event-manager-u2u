<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Attendee;

class AttendeeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Attendee::factory()->count(2)->create();

        $this->withHeaders([
            'x-api-key' => env('API_KEY'),
        ]);
    }

    public function test_api_attendee_index(): void 
    {
        $response = $this->get('/api/attendees');

        $response->assertStatus(200);
    }

    public function test_api_attendee_show(): void 
    {
        $attendee = Attendee::first();

        $response = $this->get('/api/attendees/' . $attendee->id);

        $response->assertStatus(200);
    }

    public function test_api_attendee_store(): void 
    {
        $response = $this->post('/api/attendees', [
            'firstname' => 'MyAttendee',
            'lastname' => 'Surname',
            'email' => 'test@email.com'
        ]);

        $response->assertStatus(201);
    }

    public function test_api_attendee_update(): void 
    {
        $attendee = Attendee::first();

        $response = $this->put('/api/attendees/' . $attendee->id, [
            'firstname' => 'Updated Firstname',
            'lastname' => 'Updated Lastname',
            'email' => 'testupdate@email.com'
        ]);

        $response->assertStatus(200);
    }

    public function test_api_attendee_destroy(): void 
    {
        $attendee = Attendee::first();

        $response = $this->delete('/api/attendees/' . $attendee->id);

        $response->assertStatus(200);
    }

    public function tearDown(): void
    {
        Attendee::query()->delete();
        parent::tearDown();
    }
}
