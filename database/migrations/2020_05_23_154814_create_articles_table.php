<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->text('desc')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('type')->unsigned()->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->integer('is_active')->default(1); // trạng thái
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
        Schema::dropIfExists('articles');
    }
}
