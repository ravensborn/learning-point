<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('session_tags', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_tags');
    }
};
