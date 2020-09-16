<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('discord_id');
            $table->smallInteger('level')->default(0);
            $table->integer('experience')->default(0);
            $table->integer('voice_points')->default(0);
            $table->timestamps();
        });
        
        Schema::table("discord_users", function($table) {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("set null");
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discord_users');        
    }
}
