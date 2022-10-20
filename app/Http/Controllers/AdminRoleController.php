<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

    }

    public function index() {
        $roles = $this->role->paginate(5);
        return view('admin.role.index', compact('roles'));
    }
    public function create() {
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionParent'));
    }
    public function store(Request $request) {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }
    public function edit($id) {
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions;
        return view('admin.role.edit', compact('role', 'permissionParent', 'permissionChecked'));
    }
    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $this->role->find($id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role = $this->role->find($id);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd('rollback');
        }
    }
    public function delete($id) {
        $this->role->find($id)->delete();
    }
    public function createPermission() {
        return view('admin.permission.add');
    }

}
