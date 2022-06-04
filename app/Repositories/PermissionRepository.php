<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Permission::class;
    }

    public function getAll()
    {
        return Permission::with('roles')->get();
    }

    //xử lý postAdd bên PermissionController
    public function create_permission($attributes)
    {
        $data = array();
        $data['title'] = $attributes->title;
        $data['name'] = $attributes->name;
        return $this->create($data);
    }

    //xử lý openEditModal bên PermissionController
    public function openEditModal_permission($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];
        return $this->find($id);
    }

    //xử lý permissionEdit bên PermissionController
    public function permissionEditRepo($attributes)
    {
        $data = array();
        $data['id'] = $attributes->id;
        $data['title'] = $attributes->title;
        $data['name'] = $attributes->name;
        return $this->update($data['id'], $data);
    }
}
