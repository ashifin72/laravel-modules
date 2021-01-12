<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('img')->nullable();

            $table->string('title_ru');
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->string('slogan_ru')->nullable();
            $table->string('slogan_uk')->nullable();
            $table->string('slogan_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_en')->nullable();
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
        Schema::dropIfExists('sections');
    }
}
