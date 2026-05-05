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
        Schema::create('tour_diaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('tour_schedules')->onDelete('cascade');
            $table->foreignId('guide_id')->constrained('users');
            $table->date('log_date');
            $table->text('content');
            $table->text('issues')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_diaries');
    }
};
