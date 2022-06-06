<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequests\UserAddRequest;

class UserController extends Controller
{

    protected $userAddRequest;
    protected $userRepo;
    protected $roleRepo;

    function __construct(RoleRepository $roleRepo, UserRepository $userRepo, UserAddRequest $userAddRequest)
    {
        $this->userAddRequest = $userAddRequest;
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;

        $rolesForAddUser = $this->userRepo->getRolesForAddUser();
        view()->share('rolesForAddUser', $rolesForAddUser);
    }

    function getAll()
    {
        $user = $this->userRepo->getAll();
        return view('admin.users.index', ['user' => $user]);
    }

    function postAdd(Request $request)
    {
        $validator = $this->userAddRequest->rules($request);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $this->userRepo->create($request);
        $user = $this->userRepo->getAll();
        return view('admin.users.row_user', compact('user'));
    }

    function openModalUpdate(Request $request)
    {
        $user = $this->userRepo->openModalUpdate($request);
        return view('admin.users.edit', compact('user'));
    }

    function postEdit(Request $request)
    {
        if (empty($request->name) || ($request->password != $request->confirm_password)) {
            return ['status' => 1, 'message' => 'Edit thất bại! '];
        }
        $this->userRepo->userEditRepo($request);
        $user = $this->userRepo->getAll();
        return view('admin.users.row_user', compact('user'));
    }

    function postDelete(Request $request)
    {
        $user = $this->userRepo->find($request->id);
        $user->delete();
        $user = $this->userRepo->getAll();
        return view('admin.users.row_user', compact('user'));
    }

    public function getLoginAdmin()
    {
        $user = Auth::user();
        return view('admin.login.index', ['user' => $user]);
    }

    public function postLoginAdmin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('admin');
        } else {
            return redirect('admin/login')->with('notify', 'Đăng nhập không thành công !!');
        }
    }

    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
