<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('complain_type_id');
            $table->foreignId('student_id');
            $table->foreignId('department_id')->nullable();
            $table->foreignId('program_id')->nullable();
            $table->foreignId('course_id')->nullable();
            $table->foreignId('lecture_id')->nullable();
            $table->foreignId('semester_id')->nullable();
            $table->foreignId('academic_year_id')->nullable();
            $table->text('description');
            $table->text('solution');
            $table->date('date');
            $table->enum('status', ['0', '1', '2', '3', '4'])->default('0');

            $table->index('complain_type_id');
            $table->index('student_id');
            $table->index('department_id');
            $table->index('program_id');
            $table->index('course_id');
            $table->index('semester_id');
            $table->index('academic_year_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
