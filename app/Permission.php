<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = "permissions";

    protected $fillable = [
        'title', 'name',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_roles');
    }

    public function permission_roles()
    {
        return $this->hasMany(Permission_Roles::class, 'permission_id', 'id');
    }
}
