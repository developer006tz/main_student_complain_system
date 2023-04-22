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
        Schema::table('academic_year_semester', function (Blueprint $table) {
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
        Schema::table('academic_year_semester', function (Blueprint $table) {
            $table->dropForeign(['semester_id']);
            $table->dropForeign(['academic_year_id']);
        });
    }
};
