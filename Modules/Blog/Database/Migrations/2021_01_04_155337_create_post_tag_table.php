<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {

            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onUpdate('cascade');
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade');
            $table->primary(['tag_id','post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
