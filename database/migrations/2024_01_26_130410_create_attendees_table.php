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
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('session_id')
                ->nullable();
            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->nullOnDelete();

            $table->unsignedBigInteger('student_id')
                ->nullable();
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->nullOnDelete();

            $table->boolean('attending')->default(false);
            $table->boolean('charged')->default(false);

            $table->json('charge_list');
            $table->json('cancellation_charge_list');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
