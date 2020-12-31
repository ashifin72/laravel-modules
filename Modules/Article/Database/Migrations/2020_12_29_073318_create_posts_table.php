<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('title_uk');
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('img')->nullable();
            $table->enum('status_img',['0','1'])->default(0);
            $table->text('description_uk')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->text('content_uk')->nullable();
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();
            $table->string('keywords')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('youtube')->nullable();
            $table->string('github')->nullable();
            $table->string('file_sharing')->nullable();
            $table->string('title_soc')->nullable();
            $table->text('video')->nullable();
            $table->text('description_soc')->nullable();

            $table->enum('status',['0','1'])->default(1);
            $table->integer('sort')->default(1);

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
        Schema::dropIfExists('posts');
    }
}
