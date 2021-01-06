<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

            $table->id();
            $table->text('text');

            $table->string('name');
            $table->string('email');
            $table->string('site')->nullable();
            $table->enum('status',['0','1'])->default(0);

            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('blog_post_id')->unsigned()->default(1);
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->foreign('parent_id')->references('id')->on('comments');
            $table->foreign('blog_post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
