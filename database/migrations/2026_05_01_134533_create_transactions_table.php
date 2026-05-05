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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->nullable()->constrained('tour_schedules');
            // Cặp khóa ngoại đa hình (Polymorphic relations)
            $table->unsignedBigInteger('reference_id');
            $table->string('reference_type');

            $table->string('type'); // income, expense
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('paid'); // paid, debt
            $table->timestamps();
            $table->softDeletes();

            $table->index(['reference_id', 'reference_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
