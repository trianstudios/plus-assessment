<?php

namespace Database\Seeders;

use App\Helpers\RolePermission;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(RolePermission::ROLE_PERMISSION as $item){

            $role = Role::create([
                'name' => $item['role'],
                'slug' => Str::slug($item['role'])
            ]);

            if(count($item['permissions']) > 0){
                foreach($item['permissions'] as $permission){
                    $permission_ = Permission::updateOrCreate(
                    [
                        'slug' => Str::slug($permission)
                    ],
                    [
                        'name' => $permission,
                        'slug' => Str::slug($permission)
                    ]);
                    $role->permissions()->attach($permission_->id);
                }
            }
        }
    }
}
