<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Role;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel(): string
    {
        return User::class;
    }

    function getAll()
    {
        return User::with('comments', 'posts', 'roles')
            ->where('id', '!=', '1')->get();
    }

    //xử lý postAdd bên UserController
    public function create($attributes)
    {
        $data = $attributes->all();
        if (!empty($attributes->admin)) {
            $data['admin'] = $attributes->admin;
        } else {
            $data['admin'] = 0;
        }
        return $this->create($data);
    }

    //xử lý openEditModal bên UserController
    public function openModalUpdate($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];
        return $this->find($id);
    }

    //xử lý userEdit bên UserController
    public function userEditRepo($attributes)
    {
        $data = array();
        $id = $attributes->id;
        $data['name'] = $attributes->name;
        if ($attributes->password != null) {
            $data['password'] = bcrypt($attributes->password);
        }
        return $this->update($id, $data);
    }

    function getRolesForAddUser()
    {
        return Role::with('users', 'permissions')->get();
    }
}
