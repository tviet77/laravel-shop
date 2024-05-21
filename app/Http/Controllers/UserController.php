<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $roleIds = $request->role_id;
            $user->roles()->attach($roleIds);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
        }
    }

    //Method 1
    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $roleUser = $user->roles->pluck('id')->toArray();
        return view('admin.user.edit', compact('user', 'roles', 'roleUser'));
    }


    public function update(Request $request, $id){
        try {
            DB::beginTransaction();
            $user = $this->user->find($id);
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];

            $user->update($userData);
            $user->roles()->attach($request->role_id); // Sync roles
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
        }
    }

    public function delete($id){
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xóa user thành công!',
            ], status: 200);
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Xóa user thất bại!',
            ], status: 500);
        }
    }

}
