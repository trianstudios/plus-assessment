<?php

namespace App\Policies;

use App\Helpers\RolePermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true);
    }

    public function create(User $user)
    {
        return in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true);
    }

    public function show(User $user)
    {
        return in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true);
    }

    public function store(User $user)
    {
        return in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true);
    }

    public function update(User $user)
    {
        return in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true);
    }

    public function destroy(User $user)
    {
        return in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true);
    }
}
