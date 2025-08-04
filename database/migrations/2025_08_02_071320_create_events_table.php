<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id');
            $table->string('event_name');
            $table->string('organizer')->nullable();
            $table->text('description');
            $table->date('event_date');
            $table->string('price')->nullable();
            $table->integer('rsvp_limit')->nullable();
            $table->integer('attendee_count')->default(0);
            $table->boolean('rsvp_enabled')->default(true);
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
