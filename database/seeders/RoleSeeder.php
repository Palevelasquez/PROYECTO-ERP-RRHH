<?php

namespace Database\Seeders;

use Google\Service\AndroidEnterprise\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role1 = Role::create(['name'=>'Admin']);
       $role2 = Role::create(['name'=>'Recursos Humanos']);
       $role3 = Role::create(['name'=>'Estandar']);
       
       Permission::create(['name' => 'admin.users.index']);
       //Permission::create(['name' => 'admin.users.create']);
       //Permission::create(['name' => 'admin.users.edit']);
       //Permission::create(['name' => 'admin.users.destroy']);

    }
}
