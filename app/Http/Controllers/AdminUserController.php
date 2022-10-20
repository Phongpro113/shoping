<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Traits\deleteTrait;

class AdminUserController extends Controller
{
    use deleteTrait;
    private $user;
    private $role;
    public function __construct(User $user, Role $role) {
        $this->user = $user;
        $this->role = $role;
    }
    public function index() {
        $users = $this->user->paginate(10);
        return view('admin.user.index', compact('users'));
    }
    public function create() {
        $role = $this->role->all();
        return view('admin.user.add', compact('role'));
    }
    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }
    public function edit($id) {
        $user = $this->user->find($id);
        $role = $this->role->all();
        $roleUser = $user->roles;
        return view('admin.user.edit', compact('user', 'role', 'roleUser'));
    }
    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $user = $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }
    public function delete($id) {
        $this->deleteTrait($id, $this->user);
    }
}
