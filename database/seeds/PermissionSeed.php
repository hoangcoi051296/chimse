<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission;
        $permission->name = 'Manager';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'View Manager';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'Attribute Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'View Post Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'CreateUpdateEdit Post Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'Post Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'Employee Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

        $permission = new Permission;
        $permission->name = 'Customer Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->timestamps;
        $permission->save();

    }
}
