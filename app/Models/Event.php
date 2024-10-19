<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'scheduled_at', 'location', 'max_attendees'];

    public function attendees()
    {
        return $this->belongsToMany(Attendee::class, 'attendees_events', 'event_id', 'attendee_id');
    }
}
