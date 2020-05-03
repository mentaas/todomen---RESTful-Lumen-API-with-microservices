<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspaceInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace_invitations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('workspace_id')->unsigned();
            $table->string('email_address');
            $table->tinyInteger('status_id')->unsigned();
            $table->timestamps();
            $table->unique('workspace_id', 'email_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspace_invitations');
    }
}
