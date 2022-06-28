<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Tên thương hiệu
            $table->string('slug')->unique();
            $table->string('image',255)->nullable()->default(null);
            $table->string('website',255)->nullable()->default(null); // link trang website
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
        Schema::dropIfExists('brands');
    }
}
