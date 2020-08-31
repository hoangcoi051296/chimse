<?php

namespace App\Policies;

use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \  $user
     * @return mixed
     */
    public function viewAny()
    {
        return is_permission('post-management');
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view()
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update( $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete( $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore( $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete( $user, Post $post)
    {
        //
    }
}
