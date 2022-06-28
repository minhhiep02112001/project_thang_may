<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->collation('utf8mb4_unicode_ci');
            $table->string('slug')->index()->collation('utf8mb4_unicode_ci');
            $table->string('image',255)->collation('utf8mb4_unicode_ci')->nullable(); // anh
            $table->integer('stock')->default(0); // số lượng trong kho
            $table->integer('price')->default(0); // giá gốc
            $table->integer('sale')->default(0); // giá khuyến mại
            $table->integer('position')->default(0); // vi trí
            $table->integer('is_active')->default(1); // trạng thái
            $table->integer('is_hot')->default(0); // sản phẩm hot
            $table->integer('views')->default(0); // lượt xem == khi dùng click vào xem sản phẩm trong trang chủ
            $table->integer('category_id')->default(0); // danh mục sản phẩm
            $table->string('url')->nullable()->default(null); // link url tùy chỉnh
            $table->string('sku')->nullable()->default(null); // mã hàng
            $table->string('color')->nullable()->default(null); // màu
            $table->string('memory')->nullable()->default(null);
            $table->integer('brand_id')->default(0); // Id bảng thương hiệu
            $table->integer('vendor_id')->default(0); // Id bảng nhà cung cấp
            $table->text('summary')->collation('utf8mb4_unicode_ci')->nullable(); // thông tin tóm tắt về sản phẩm
            $table->text('description')->collation('utf8mb4_unicode_ci')->nullable(); // mô tả chi tiết
            $table->string('meta_title',255)->collation('utf8_unicode_ci')->nullable(); // từ khóa dùng để seo
            $table->string('meta_description',255)->collation('utf8_unicode_ci')->nullable(); // từ khóa dùng để seo
            $table->integer('user_id')->default(0); // Id user
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
        Schema::dropIfExists('products');
    }
}
