<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title_ru')->nullable();
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->text('content_ru')->nullable();
            $table->text('content_uk')->nullable();
            $table->text('content_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_en')->nullable();
            $table->text('slogan_ru')->nullable();
            $table->text('slogan_uk')->nullable();
            $table->text('slogan_en')->nullable();
            $table->text('operating_time_ru')->nullable();
            $table->text('operating_time_uk')->nullable();
            $table->text('operating_time_en')->nullable();
            $table->string('data_email')->nullable();
            $table->string('data_phone1')->nullable();
            $table->string('data_phone2')->nullable();
            $table->string('data_phone3')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('img')->nullable();
            $table->string('img_head')->nullable();
            $table->string('img_footer')->nullable();
            $table->text('head_code')->nullable();
            $table->text('footer_code')->nullable();
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
        Schema::dropIfExists('infos');
    }
}
