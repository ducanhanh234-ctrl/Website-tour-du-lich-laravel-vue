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
        Schema::create('tour_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('tour_schedules')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->string('service_type');
            $table->string('booking_status')->default('pending');
            $table->decimal('cost', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_services');
    }
};
