<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('club_id')->unique(); // Custom unique ID
            $table->string('club_name');
            $table->string('club_leader');
            $table->date('founded_date');
            $table->integer('member_count');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
