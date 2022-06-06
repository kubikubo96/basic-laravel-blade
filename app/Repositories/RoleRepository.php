<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Role::class;
    }

    public function getAll()
    {
        return Role::with('permissions', 'users')->get();
    }

    public  function addRole($attributes)
    {
        $data = array();

        $data['title'] = $attributes->title;

        return $this->create($data);
    }

    //xử lý openEditModal bên RoleController
    public function openEditModal_role($attributes)
    {
        return $this->find($attributes->id);
    }
}
