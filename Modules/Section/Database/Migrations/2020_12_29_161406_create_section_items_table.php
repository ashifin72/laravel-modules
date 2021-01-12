<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title_ru');
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->string('img')->nullable();
            $table->text('content_ru');
            $table->text('content_uk')->nullable();
            $table->text('content_en')->nullable();
            $table->enum('status',['0','1'])->default(1);
            $table->integer('sort')->default(1);
            $table->bigInteger('section_id')->unsigned();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_en')->nullable();
            $table->string('path')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_items');
    }
}
