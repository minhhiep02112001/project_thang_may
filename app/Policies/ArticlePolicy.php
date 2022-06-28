<?php

namespace App\Policies;

use App\User;
use App\Model\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Article  $article
     * @return mixed
     */
    public function view(User $user)
    {
        //
        return $user->checkPermissionAccess('view-articles');
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess('create-articles');
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        //
        return $user->checkPermissionAccess('edit-articles');
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        //
        return $user->checkPermissionAccess('delete-articles');
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Article  $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        //
    }
}
