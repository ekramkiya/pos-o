<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=> 'home view']);
        Permission::create(['name'=> 'product view']);
        Permission::create(['name'=> 'product create']);
        Permission::create(['name'=> 'product update']);
        Permission::create(['name'=> 'product delete']);

        Permission::create(['name'=> 'order view']);
        Permission::create(['name'=> 'order edit']);
        Permission::create(['name'=> 'order delete']);

        Permission::create(['name'=> 'customer view']);
        Permission::create(['name'=> 'customer create']);
        Permission::create(['name'=> 'customer update']);
        Permission::create(['name'=> 'customer delete']);

        Permission::create(['name'=> 'employe view']);
        Permission::create(['name'=> 'employe create']);
        Permission::create(['name'=> 'employe update']);
        Permission::create(['name'=> 'employe delete']);

        Permission::create(['name'=> 'cart view']);
        
        Permission::create(['name'=> 'role view']);
        Permission::create(['name'=> 'role create']);
        Permission::create(['name'=> 'role edit']);
        Permission::create(['name'=> 'role update']);
        Permission::create(['name'=> 'role delete']);

        Permission::create(['name'=> 'expenses view']);
        Permission::create(['name'=> 'expenses create']);
        Permission::create(['name'=> 'expenses edit']);
        Permission::create(['name'=> 'expenses delete']);

        Permission::create(['name'=> 'purchase view']);
        Permission::create(['name'=> 'purchase create']);
        Permission::create(['name'=> 'purchase edit']);
        Permission::create(['name'=> 'purchase delete']);
        
        Permission::create(['name'=> 'backup ']);

        
        Permission::create(['name'=> 'setting view']);
        Permission::create(['name'=> 'setting update']);
       

    }
}
