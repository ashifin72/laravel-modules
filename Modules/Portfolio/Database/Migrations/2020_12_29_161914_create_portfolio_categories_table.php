<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('img')->nullable();

            $table->string('slug')->unique();
            $table->string('title_ru');
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->text('content_ru')->nullable();
            $table->text('content_uk')->nullable();
            $table->text('content_en')->nullable();
            $table->string('icon')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_en')->nullable();
            $table->enum('status',['0','1'])->default(1);
            $table->integer('sort')->default(1);
            $table->integer('price_starting')->nullable();

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
        Schema::dropIfExists('portfolio_categories');
    }
}
