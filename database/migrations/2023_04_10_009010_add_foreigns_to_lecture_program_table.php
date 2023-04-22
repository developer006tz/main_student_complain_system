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
        Schema::table('lecture_program', function (Blueprint $table) {
            $table
                ->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('lecture_id')
                ->references('id')
                ->on('lectures')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecture_program', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropForeign(['lecture_id']);
        });
    }
};
