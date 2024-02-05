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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();

            $table->string('number');

            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->unsignedBigInteger('teacher_id')
                ->nullable();
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->nullOnDelete();

            $table->unsignedBigInteger('subject_id')
                ->nullable();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->nullOnDelete();

            $table->string('type');
            $table->string('status');

            $table->dateTime('time_in');
            $table->dateTime('time_out');

            $table->double('total', 10, 2)->default(0)->comment('per hour');

            $table->longText('note')->nullable();
            $table->longText('approval_note')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
