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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('reminder_id')->unique();
            $table->string('title');
            $table->text('description');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['upcoming', 'completed'])->default('upcoming');
            $table->json('members');  // Emails of members to send notifications
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
