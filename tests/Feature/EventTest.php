<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Event::factory()->count(2)->create();

        $this->withHeaders([
            'x-api-key' => env('API_KEY'),
        ]);
    }

    public function test_api_event_index(): void
    {
        $response = $this->get('/api/events');

        $response->assertStatus(200);
    }

    public function test_api_event_show(): void
    {
        $event = Event::first();

        $response = $this->get('/api/events/' . $event->id);

        $response->assertStatus(200);
    }

    public function test_api_event_store(): void
    {
        $response = $this->post('/api/events', [
            'title' => 'Test Event',
            'description' => 'Test Description',
            'scheduled_at' => '2022-01-01 00:00:00',
            'location' => 'Test Location',
            'max_attendees' => 10,
        ]);

        $response->assertStatus(201);
    }

    public function test_api_event_update(): void
    {
        $event = Event::first();

        $response = $this->put('/api/events/' . $event->id, [
            'title' => 'Updated Test Event',
            'description' => 'Updated Test Description',
            'scheduled_at' => '2022-01-01 00:00:00',
            'location' => ' Updated Test Location',
            'max_attendees' => 10,
        ]);

        $response->assertStatus(200);
    }

    public function test_api_event_destroy(): void
    {
        $event = Event::first();

        $response = $this->delete('/api/events/' . $event->id);

        $response->assertStatus(200);
    }

    public function test_api_event_add_attendee(): void
    {
        $event = Event::first();
        $attendee = Attendee::factory()->create();

        $response = $this->post('/api/events/' . $event->id . '/add-attendee', [
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(200);
    }

    public function test_api_event_add_attendee_max_capacity(): void
    {
        $attendeeLimit = 10;

        $event = Event::factory()
            ->hasAttendees($attendeeLimit)
            ->create([
                'max_attendees' => $attendeeLimit,
            ]);

        $attendee = Attendee::factory()->create();

        $response = $this->post('/api/events/' . $event->id . '/add-attendee', [
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(400);
    }

    public function test_api_event_attendee_already_exists(): void
    {
        $event = Event::factory()
            ->hasAttendees(1)
            ->create();

        $attendee = $event->attendees->first();

        $response = $this->post('/api/events/' . $event->id . '/add-attendee', [
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(400);
    }


    public function tearDown(): void
    {
        Attendee::query()->delete();
        Event::query()->delete();
        parent::tearDown();
    }

}
