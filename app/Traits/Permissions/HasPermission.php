<?php

namespace App\Traits\Permissions;

use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermission
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissionTo($permission): bool
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    protected function hasPermission(Permission $permission): bool
    {
        return (bool)$this->permissions->where('name', $permission->name)->count();
    }

    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    protected function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
}
