<?php

namespace Database\Seeders;

use App\Helpers\RolePermission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->unverified()->create()->each(function($user, $index){
            if($index === 0){
                $user->update([
                    'first_name' => 'Admin',
                    'last_name' => 'User',
                    'email' => 'admin@test.com',
                    'remember_token' => null,
                    'email_verified_at' => now()
                ]);
                $roles = Role::whereIn('name', [RolePermission::ADMIN_ROLE, RolePermission::CONTENT_MANAGER_ROLE])->pluck('id');
                $user->roles()->attach($roles);
            }else{
                $role = Role::whereNotIn('name', [RolePermission::ADMIN_ROLE, RolePermission::CONTENT_MANAGER_ROLE])->get()->random()->id;
                $user->roles()->attach($role);
            }
        });
    }
}
