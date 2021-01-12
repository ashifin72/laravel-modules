<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title_ru')->nullable();
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->string('path')->nullable();
            $table->enum('status',['0','1'])->default(1);
            $table->integer('sort')->default(1);
            $table->string('icon')->nullable();
            $table->bigInteger('parent_id')->unsigned()->default(1);
            $table->bigInteger('menu_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('menu_items');
            $table->foreign('menu_id')->references('id')->on('menus');
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
        Schema::dropIfExists('menu_items');
    }
}
