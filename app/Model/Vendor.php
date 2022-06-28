<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $table ='vendors';
    protected $fillable = [ 'name' , 'slug' , 'email' , 'phone' , 'is_active' , 'image' , 'website' , 'address' , 'position'];
}
