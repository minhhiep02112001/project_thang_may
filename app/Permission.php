<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = 'permissions';
     protected $fillable = [
        'name', 'display_name', 'parent_id',
    ];
    public function permissionsChildren()
    {
        // code...
        return $this->hasMany('App\Permission' , 'parent_id' , 'id');
    }
}
