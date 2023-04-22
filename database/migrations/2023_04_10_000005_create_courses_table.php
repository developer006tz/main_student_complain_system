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
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->decimal('credit');
            $table->enum('elective', ['0', '1'])->default('1');
            $table->foreignId('semester_id')->nullable();
            $table->foreignId('department_id');
            $table->foreignId('nta_level_id');
            $table->unsignedBigInteger('program_id');

            $table->index('semester_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
