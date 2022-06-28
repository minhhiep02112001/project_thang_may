<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $fillable = [ 'name' , 'slug' ,'image' , 'stock' , 'price' , 'sale', 'position' , 'is_active' , 'is_hot' , 'category_id' , 'url' , 'sku' , 'color' ,'memory' , 'brand_id' , 'vendor_id' , 'summary' , 'description' , 'meta_title' , 'meta_description' , 'user_id'];

    public function category()
    {
        // code...
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }

    public function brand()
    {
        // code...
        return $this->belongsTo('App\Model\Brand' , 'brand_id' , 'id');
    }

    public function vendor()
    {
        // code...
        return $this->belongsTo('App\Model\Vendor' , 'vendor_id' , 'id');
    }    

   
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product_images()
    {
        return $this->hasMany('App\Model\ProductImage', 'product_id', 'id');
    }
    
}
