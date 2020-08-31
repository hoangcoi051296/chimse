<?php

namespace App\Policies;

use App\Models\Attribute;
use Illuminate\Auth\Access\HandlesAuthorization;


class AttributePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any attributes.
     *
     * @param  \  $user
     * @return mixed
     */
    public function viewAny( $user)
    {
        return is_permission('attribute-management');
    }

    /**
     * Determine whether the user can view the attribute.
     *
     * @param  \  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function view( $user, Attribute $attribute)
    {
        //
    }

    /**
     * Determine whether the user can create attributes.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the attribute.
     *
     * @param  \  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function update( $user, Attribute $attribute)
    {
        //
    }

    /**
     * Determine whether the user can delete the attribute.
     *
     * @param  \  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function delete( $user, Attribute $attribute)
    {
        //
    }

    /**
     * Determine whether the user can restore the attribute.
     *
     * @param  \  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function restore( $user, Attribute $attribute)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the attribute.
     *
     * @param  \  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function forceDelete( $user, Attribute $attribute)
    {
        //
    }
}
