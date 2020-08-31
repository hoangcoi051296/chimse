<?php

namespace App\Policies;

use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;


class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any customers.
     *
     * @param  \  $user
     * @return mixed
     */
    public function viewAny()
    {
        return is_permission('customer-management');
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function view( $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function update( $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function delete( $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can restore the customer.
     *
     * @param  \  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function restore( $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the customer.
     *
     * @param  \  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function forceDelete( $user, Customer $customer)
    {
        //
    }
}
