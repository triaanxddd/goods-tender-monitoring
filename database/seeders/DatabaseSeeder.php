<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Permission
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'member-list',
            'member-create',
            'member-edit',
            'member-delete',
            'setting-list',
            'setting-edit',
            'task-list',
            'task-create',
            'task-edit',
            'task-delete',
            'manage-list'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

         // create admin and role
        $user = User::create([
            'name' => 'admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        
        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        //create category
        Category::create([
            'name' => 'KAPOR',
            'slug' => 'kapor',
        ]);

        Category::create([
            'name' => 'ALSATRI',
            'slug' => 'alsatri',
        ]);
        // Task::factory(30)->create();
    }
}
