<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param  \  $user
     * @return mixed
     */
    public function viewAny( $user)
    {
        return is_permission('category-management');
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function view( $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update( $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete( $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function restore( $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function forceDelete( $user, Category $category)
    {
        //
    }
}
