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
        Schema::table('programs', function (Blueprint $table) {
            $table
                ->foreign('nta_level_id')
                ->references('id')
                ->on('nta_levels')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['nta_level_id']);
            $table->dropForeign(['department_id']);
        });
    }
};
