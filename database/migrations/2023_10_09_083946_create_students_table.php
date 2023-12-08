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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');

            $table->double('wallet', 10, 2)->default(0);

            $table->unsignedBigInteger('school_id')
                ->nullable();
            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->nullOnDelete();

            $table->unsignedBigInteger('grade_id')
                ->nullable();
            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
                ->nullOnDelete();

            $table->string('academic_stream')->default(\App\Models\School::ACADEMIC_STREAM_OTHER);
            $table->string('school_username')->nullable();
            $table->string('school_password')->nullable();


            $table->enum('gender', ['male', 'female']);
            $table->date('birthday')->nullable();
            $table->enum('blood_type', ['A+', 'A-', 'AB+', 'AB-', 'B+', 'B-', 'O+', 'O-'])->nullable();
            $table->string('primary_phone_number')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->string('email')->nullable();

            $table->string('country', 3)
                ->comment('iso_alpha_2');

//            $table->foreign('country')
//                ->references('iso_alpha_2')
//                ->on('lc_countries');

            $table->unsignedBigInteger('city_id');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->restrictOnDelete();

            $table->string('address')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
