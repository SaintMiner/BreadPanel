<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 24);
            $table->date('expires_at');
            
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
        });

        Schema::table("invitations", function($table) {
            $table->foreign("create_by")->references("id")->on("users")->onDelete("set null");
        });

        Schema::table("users", function($table) {
            $table->foreign("invitation_id")->references("id")->on("invitations")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
