<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->collation('utf8_unicode_ci'); // Tiêu đề của khuyến mại  slide
            $table->string('slug')->unique();
            $table->string('image',255)->nullable()->default(null);
            $table->string('url',255)->nullable()->default(null);
            $table->integer('target')->unsigned()->nullable();
            $table->text('description')->collation('utf8_unicode_ci')->nullable()->default(null); // mô tả
            $table->integer('type')->unsigned()->default(0); // Loại banner : có thể là logo , slide, background..
            $table->integer('position')->unsigned()->default(0); // Vị trí hiển thị
            $table->integer('is_active')->unsigned()->default(1); // Trạng thái có hiển thị hay không
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
        Schema::dropIfExists('banners');
    }
}
