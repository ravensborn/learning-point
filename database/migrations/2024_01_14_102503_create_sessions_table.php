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

//            $table->unsignedBigInteger('user_id')
//                ->nullable();
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->nullOnDelete();
//
//            $table->unsignedBigInteger('teacher_id')
//                ->nullable();
//            $table->foreign('teacher_id')
//                ->references('id')
//                ->on('teachers')
//                ->nullOnDelete();
//
//            $table->unsignedBigInteger('teacher_id')
//                ->nullable();
//            $table->foreign('teacher_id')
//                ->references('id')
//                ->on('teachers')
//                ->nullOnDelete();


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
