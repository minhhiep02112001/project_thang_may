<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $table='banners';
    protected $fillable = ['title' , 'slug' , 'image' , 'url' , 'target' , 'description' , 'type' ,'position' ,'is_active'];
}
