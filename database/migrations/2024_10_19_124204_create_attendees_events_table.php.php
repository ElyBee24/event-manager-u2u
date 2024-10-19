<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendees_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendee_id')->constrained('attendees', 'id')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees_events');
    }
};
