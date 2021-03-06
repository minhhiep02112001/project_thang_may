<?php

namespace App\Policies;


use App\User;
use App\Model\Banner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function view(User $user)
    {
        //
         return $user->checkPermissionAccess('view-banners');
    }

    /**
     * Determine whether the user can create banners.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->checkPermissionAccess('create-banners');
    }

    /**
     * Determine whether the user can update the banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function update(User $user, Banner $banner)
    {
        //
        return $user->checkPermissionAccess('edit-banners');
    }

    /**
     * Determine whether the user can delete the banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function delete(User $user, Banner $banner)
    {
        //
        return $user->checkPermissionAccess('delete-banners');
    }

    /**
     * Determine whether the user can restore the banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function restore(User $user, Banner $banner)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function forceDelete(User $user, Banner $banner)
    {
        //
    }
}
