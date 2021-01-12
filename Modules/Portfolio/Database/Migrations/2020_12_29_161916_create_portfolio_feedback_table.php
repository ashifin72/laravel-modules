<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_feedback', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->bigInteger('portfolio_id')->unsigned()->default(1);
            $table->string('img')->nullable();
            $table->string('title_ru');
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_uk')->nullable();
            $table->string('name_en')->nullable();
            $table->string('site')->nullable();
            $table->string('path')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_en')->nullable();
            $table->enum('status',['0','1'])->default(1);
            $table->string('screen')->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('portfolio_id')->references('id')->on('portfolios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_feedback');
    }
}
