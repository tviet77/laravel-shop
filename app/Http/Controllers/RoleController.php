<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->latest()->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.create', compact('permissionParents'));
    }

    public function store(Request $request)
    {
        $role =$this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionRole = $role->permissions->pluck('id')->toArray();
        return view('admin.role.edit', compact('role','permissionParents', 'permissionRole'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        try {
            $this->role->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xóa role thành công!',
            ], status: 200);
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Xóa role thất bại!',
            ], status: 500);
        }
    }
}
