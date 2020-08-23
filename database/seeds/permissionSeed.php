<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class permissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission;
        $permission->name = 'Super Manager';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->save();

        $permission = new Permission;
        $permission->name = 'Attribute Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->save();

        $permission = new Permission;
        $permission->name = 'CRUPost Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->save();

        $permission = new Permission;
        $permission->name = 'User Management';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->save();

        $permission = new Permission;
        $permission->name = 'CRUDPost Managerment';
        $permission->slug = Str::slug( $permission->name, '-');
        $permission->save();

    }
}
