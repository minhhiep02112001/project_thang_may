<?php

namespace App\Policies;

use App\User;
use App\Model\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $Category
     * @return mixed
     */
    public function view(User $user)
    {
        //
       
        return $user->checkPermissionAccess('view-categories');
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user )
    {
        //
        return $user->checkPermissionAccess('create-categories');
    }

    /**
     * Determine whether the user can update the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $Category
     * @return mixed
     */
    public function update(User $user , Category $category)
    {
        //
        return $user->checkPermissionAccess('edit-categories');
    }

    /**
     * Determine whether the user can delete the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $Category
     * @return mixed
     */
    public function delete(User $user , Category $category)
    {
        return $user->checkPermissionAccess('delete-categories');
    }

    /**
     * Determine whether the user can restore the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $Category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the Category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $Category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
