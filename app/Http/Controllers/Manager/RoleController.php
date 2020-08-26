<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    private $role;
    private $contruct;
    public function __construct(Role $role, Permission $permission)
    {
       $this->role=$role;
       $this->permission=$permission;
    }

    public function index(Request $request)
    {
       $data=$request->all();
        $roles =$this->role->getData($data);
        return view('manager.role.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view("manager.role.create", compact('permissions'));
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $request->validate($this->role->rules(),$this->role->message());
        DB::beginTransaction();
        $this->role->createData($data);
        try {

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Thêm thất bại');
        }
        return redirect()->route('manager.role.index')->with("success", "Thêm thành công");
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        return view("manager.role.edit", compact('role','permissions'));
    }

    public function update($id, Request $request)
    {
        $data=$request->all();
        $request->validate($this->role->rules($id),$this->role->message());
        DB::beginTransaction();
        try {
            $this->role->updateData($data,$id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Cập nhật thất bại');
        }
        return redirect()->route('manager.role.index')->with("success", "Cập nhật thành công");
    }

    public function delete($id)
    {
        $role = Role::find($id);
        DB::beginTransaction();
        try {
            $role->delete();
            $role->permissions()->detach();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Xoá thất bại');
        }
        return redirect()->route('manager.role.index')->with("success", "Xoá thành công");
    }
}
