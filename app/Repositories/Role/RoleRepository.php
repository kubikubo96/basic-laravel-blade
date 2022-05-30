<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use App\Role;

class RoleRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }

    public function getAll()
    {
        return Role::with('permissions', 'users', 'permission_roles')->get();
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
