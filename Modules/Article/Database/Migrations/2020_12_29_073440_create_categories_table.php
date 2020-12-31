<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('icon')->nullable();
            $table->bigInteger('parent_id')->unsigned()->default(1);
            $table->string('slug')->unique();
            $table->string('title_uk');
            $table->string('title_ru')->nullable();;
            $table->string('title_en')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('sort')->default(1);
            $table->enum('status',['0','1'])->default(1);
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
        Schema::dropIfExists('categories');
    }
}
