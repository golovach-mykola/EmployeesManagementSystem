<?php

namespace App\Traits;

use App\Role;

trait HasRolesAndPermissions
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->role->slug == $role) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        return (bool) $this->role->permissions->where('slug', $permission->slug)->count();
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission);
    }

}
