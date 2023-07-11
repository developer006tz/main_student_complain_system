<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resolves', function (Blueprint $table) {
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('lecture_id')
                ->references('id')
                ->on('lectures')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('complaint_id')
                ->references('id')
                ->on('complaints')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resolves', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['complaint_id']);
        });
    }
};
