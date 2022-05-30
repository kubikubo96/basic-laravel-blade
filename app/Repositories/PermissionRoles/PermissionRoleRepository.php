<?php

namespace App\Repositories\PermissionRoles;

use App\Repositories\BaseRepository;

class PermissionRoleRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Permission_Roles::class;
    }

    //xử lý postAdd bên PermissionController
    public function create_permission_role($attributes)
    {
        $data = array();
        $data['title'] = $attributes->title;
        $data['name'] = $attributes->name;

        $result = $this->create($data);

        return $result;
    }
}
