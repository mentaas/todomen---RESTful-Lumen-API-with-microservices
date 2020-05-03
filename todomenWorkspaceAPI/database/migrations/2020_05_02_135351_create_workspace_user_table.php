<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspaceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('workspace_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('is_active');
            $table->bigInteger('create_by_id')->unsigned();
            $table->timestamps();
            $table->unique('workspace_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspace_users');
    }
}
