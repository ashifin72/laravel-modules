<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->bigInteger('portfolio_categories_id')->unsigned()->default(1);
            $table->bigInteger('portfolio_feedback_id')->nullable();
            $table->string('slug')->unique();
            $table->string('title_ru');
            $table->string('title_uk')->nullable();
            $table->string('title_en')->nullable();
            $table->string('img')->nullable();
            $table->string('customer_ru')->nullable();
            $table->string('customer_uk')->nullable();
            $table->string('customer_en')->nullable();
            $table->string('url_site')->nullable();
            $table->string('cms_site')->nullable();
            $table->string('type_site')->nullable();
            $table->integer('time_site')->nullable();

            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('description_en')->nullable();

            $table->text('content_ru');
            $table->text('content_uk')->nullable();
            $table->text('content_en')->nullable();

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
        Schema::dropIfExists('portfolios');
    }
}
