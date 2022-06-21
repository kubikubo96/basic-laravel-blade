<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColearnCrawlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colearn_crawler', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_question')->nullable();
            $table->string('name_subject')->nullable();
            $table->string('title_subject')->nullable();
            $table->string('name_topic')->nullable();
            $table->string('name')->nullable();
            $table->string('tag')->nullable();
            $table->text('question')->nullable();
            $table->text('image_question')->nullable();
            $table->text('image_question_name')->nullable();
            $table->text('option')->nullable();
            $table->text('solution')->nullable();
            $table->text('answer')->nullable();
            $table->text('correct_answer')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('colearn_crawler');
    }
}
