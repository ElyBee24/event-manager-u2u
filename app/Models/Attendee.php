<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendee extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'attendees_events', 'attendee_id', 'event_id');
    }
}
