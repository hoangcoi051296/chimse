<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;


class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any employees.
     *
     * @param  \  $user
     * @return mixed
     */
    public function viewAny()
    {
        return is_permission('employee-management');
    }

    /**
     * Determine whether the user can view the employee.
     *
     * @param  \  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function view( $user, Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can create employees.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the employee.
     *
     * @param  \  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function update( $user, Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can delete the employee.
     *
     * @param  \  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function delete( $user, Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can restore the employee.
     *
     * @param  \  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function restore( $user, Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the employee.
     *
     * @param  \  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function forceDelete( $user, Employee $employee)
    {
        //
    }
}
