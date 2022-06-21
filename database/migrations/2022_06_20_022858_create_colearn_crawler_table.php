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
            $table->string('category_id')->nullable();
            $table->string('category_name')->nullable();
            $table->string('topic_id')->nullable();
            $table->string('topic_name')->nullable();
            $table->string('topic_parent_name')->nullable();
            $table->string('topic_parent_name_no_accents')->nullable();
            $table->string('class_id')->nullable();
            $table->string('class_name')->nullable();
            $table->string('name')->nullable();
            $table->string('tag')->nullable();
            $table->text('content')->nullable();
            $table->text('images')->nullable();
            $table->text('new_images')->nullable();
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
