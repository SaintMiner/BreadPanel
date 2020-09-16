<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');

            $table->unsignedBigInteger('invitation_id')->nullable();
            $table->boolean('blocked')->default(false);
            $table->integer('crumbs')->default(0);
            
            //settings
                //avatar
                $table->string('status')->nullable();
                $table->boolean('initial_avatar')->default(true);
                $table->boolean('with_initials')->default(true);
                $table->string('initials', 4)->nullable();
                $table->string('initial_background', 7)->default('#ffffff');
                $table->unsignedBigInteger('image_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
