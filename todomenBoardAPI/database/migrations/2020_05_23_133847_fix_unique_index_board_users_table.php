<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixUniqueIndexBoardUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('board_users', function (Blueprint $table) {
            $table->dropUnique('user_id');
            $table->unique(['board_id', 'user_id'], 'unique_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('board_users', function (Blueprint $table) {
            $table->dropUnique('unique_index');
            $table->unique('board_id', 'user_id');
        });
    }
}
