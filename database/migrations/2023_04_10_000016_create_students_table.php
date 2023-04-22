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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->foreignId('program_id');
            $table->unsignedBigInteger('country_id');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('date_of_birth');
            $table->string('admission_id');
            $table
                ->enum('maritial_status', ['single', 'maried'])
                ->default('single');
            $table->string('photo')->nullable();
            $table->enum('status', ['1', '0'])->default('1');

            $table->index('program_id');

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
