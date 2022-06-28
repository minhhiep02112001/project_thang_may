<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active' , 'avatar' ,  'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_user', 'user_id', 'role_id');
    }

    public function checkPermissionAccess($key_gate){
        // Bước 1 :lấy ra thông tin User login vào hệ thống ;

        $roles = Auth::user()->roles;

        // Bước 2 :So sánh giá trị đưa vào của route hiện tại Xem có tồn tại trong các quyền User hay không ;

        foreach($roles as $item){
            $permission = $item->permissions;
            if($permission->contains('key_code', $key_gate)){
                return true;
            }
        }
        return false;


    }
}
