<?php

namespace App\Policies;

use App\User;
use App\Model\Setting;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the setting.
     *
     * @param  \App\User  $user
     * @param  \App\=Model\Setting  $setting
     * @return mixed
     */
    public function setting(User $user)
    {
        //
        return $user->checkPermissionAccess('setting-website');
    }

  
}
