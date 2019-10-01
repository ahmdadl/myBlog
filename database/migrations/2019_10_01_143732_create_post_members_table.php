<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_members', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->unsignedBigInteger('userId')->index();
            $table->unsignedBigInteger('postId')->index();
            $table->timestamps();

            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('postId')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_members');
    }
}
