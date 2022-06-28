<?php

namespace App\Policies;

use App\User;
use App\Model\Coupon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
      public function view(User $user)
    {
        //
       
        return $user->checkPermissionAccess('view-coupons');
    }

    /**
     * Determine whether the user can create coupons.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user )
    {
        //
        return $user->checkPermissionAccess('create-coupons');
    }

    /**
     * Determine whether the user can update the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $Coupon
     * @return mixed
     */
    public function update(User $user , Coupon $category)
    {
        //
        return $user->checkPermissionAccess('edit-coupons');
    }

    /**
     * Determine whether the user can delete the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $Coupon
     * @return mixed
     */
    public function delete(User $user , Coupon $category)
    {
        return $user->checkPermissionAccess('delete-coupons');
    }

    /**
     * Determine whether the user can restore the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $Coupon
     * @return mixed
     */
    public function restore(User $user, Coupon $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $Coupon
     * @return mixed
     */
    public function forceDelete(User $user, Coupon $category)
    {
        //
    }
}
