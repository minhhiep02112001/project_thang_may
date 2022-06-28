<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->collation('utf8_unicode_ci'); // Tiêu đề của khuyến mại  slide
            $table->string('slug')->unique();
            $table->string('email',255)->nullable()->default(null);
            $table->string('phone',255)->nullable()->default(null);
            $table->string('image',255)->nullable()->default(null);
            $table->string('website',255)->nullable()->default(null);
            $table->text('address')->collation('utf8_unicode_ci')->nullable()->default(null); // địa chỉ
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
        Schema::dropIfExists('vendors');
    }
}
