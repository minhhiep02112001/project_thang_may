<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";

    protected $fillable = [
        'name', 'image', 'slug' ,'position' , 'description','is_active' , 'type' , 'parent_id'
    ];
    public $timestamps = true;
    protected $guarded =[
        'id'
    ];

    public function categoryChildrens()
    {
        return $this->hasMany("App\Model\Category" , "parent_id" , 'id');
    }

    public function categoryParent()
    {
    	# code...
        return $this->belongsTo("App\Model\Category" , "parent_id" , 'id');

    }

    public function products(){
        return $this->hasMany('App\Model\Product', 'category_id', 'id');
    }
}
