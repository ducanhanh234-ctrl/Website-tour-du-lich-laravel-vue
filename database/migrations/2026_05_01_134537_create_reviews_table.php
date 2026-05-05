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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('tour_schedules')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');

            // Polymorphic cho phép đánh giá cả Tour, HDV, hoặc Nhà cung cấp
            $table->unsignedBigInteger('target_id');
            $table->string('target_type');

            $table->integer('rating')->default(5); // 1-5 sao
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['target_id', 'target_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
