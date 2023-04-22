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
        Schema::table('courses', function (Blueprint $table) {
            $table
                ->foreign('semester_id')
                ->references('id')
                ->on('semesters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('nta_level_id')
                ->references('id')
                ->on('nta_levels')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['semester_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['nta_level_id']);
            $table->dropForeign(['program_id']);
        });
    }
};
