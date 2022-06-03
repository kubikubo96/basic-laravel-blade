<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Repositories\Post\PostRepository;
use App\Repositories\User\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    protected $userRepo;
    protected $postRepo;

    function __construct(UserRepository $userRepo, PostRepository $postRepo)
    {
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    public function storeRole(Request $request)
    {
        $name = $request->input('name', '');
        if (!$name) {
            return Res::error();
        }
        $role = Role::create($request->all());
        if ($role) {
            return Res::data();
        }
        return Res::error();
    }

    public function storePermission(Request $request)
    {
        $name = $request->input('name', '');
        if (!$name) {
            return Res::error();
        }
        $permission = Permission::create($request->all());
        if ($permission) {
            return Res::data();
        }
        return Res::error();
    }

    public function assignPermissionToRole(Request $request)
    {
        $role_id = $request->input('role_id', '');
        $permission_id = $request->input('permission_id', '');

        $role = Role::findById($role_id);
        $permission = Permission::findById($permission_id);

        if(!$role || !$permission) {
            return Res::error();
        }
        $permission->assignRole($role->name);

        return Res::data();
    }

    public function assignUserToRole(Request $request)
    {
        $role_id = $request->input('role_id', '');
        $user_id = $request->input('user_id', '');

        $role = Role::findById($role_id);
        $user =  $this->userRepo->find($user_id);

        if(!$role || !$user) {
            return Res::error();
        }

        $user->assignRole($role->name);

        return Res::data();
    }

    public function checkPermission(Request $request)
    {

        $permission_name = 'view_post';
        $user_id = $request->input('user_id', '');
        $user = $this->userRepo->find($user_id);
        $permission = Permission::findByName($permission_name);

        $res['in_permission'] = $user->hasPermissionTo($permission);

        return Res::data($res);
    }

    public function viewPost(Request $request)
    {
        $user = $this->userRepo->find(2);

        $res['allow1'] = $user->can('view_post');
        $res['allow2'] = Gate::forUser($user)->allows('view_post');

        return Res::data($res);
    }

    public function updatePost(Request $request)
    {
        $user = $this->userRepo->find(2);

        $res['allow1'] = $user->can('view_post');
        $res['allow2'] = Gate::forUser($user)->allows('view_post');

        return Res::data($res);
    }
}
