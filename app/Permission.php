<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
