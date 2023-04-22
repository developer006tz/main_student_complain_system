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
        Schema::table('complaints', function (Blueprint $table) {
            $table
                ->foreign('complain_type_id')
                ->references('id')
                ->on('complain_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('lecture_id')
                ->references('id')
                ->on('lectures')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('semester_id')
                ->references('id')
                ->on('semesters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('academic_year_id')
                ->references('id')
                ->on('academic_years')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['complain_type_id']);
            $table->dropForeign(['student_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['program_id']);
            $table->dropForeign(['course_id']);
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['semester_id']);
            $table->dropForeign(['academic_year_id']);
        });
    }
};
