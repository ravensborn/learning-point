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
        Schema::create('student_relations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('related_id');

            $table->foreign('student_id')->references('id')
                ->on('students')
                ->cascadeOnDelete();
            $table->foreign('related_id')->references('id')
                ->on('students')
                ->cascadeOnDelete();

            $table->unique(['student_id', 'related_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_relations');
    }
};
