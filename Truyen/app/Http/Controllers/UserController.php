<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Role::create(['name' => 'no_role']);  // tạo vai trò

        // Permission::create(['name' => 'add articles']); //Tạo permission

        // Gán quyền chỉnh định cho một vai trò
        // $role = Role::find(5);
        // $permission = Permission::find([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]);
        // $role->givePermissionTo($permission);  
        // $permission->assignRole($role); 
        // $role->revokePermissionTo($permission); // xóa
        // $permission->removeRole($role);  // xóa

        $user = User::with('roles','permissions')->orderBy('id','DESC')->get();
        return view('Admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->back()->with('success','Thêm user thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // chuyển quyền nhanh
    public function impersonate($id){
        $user = User::find($id);
        //user lưu session  
        if($user){
            Session::put('impersonate',$user->id);        
        }
        return redirect('/home');
    }

    public function phanvaitro($id){
        $user = User::find($id);
        //lấy user => role
        $all_column_roles = $user->roles->first();
        //echo($all_column_roles);
        $role = Role::orderBy('id', 'DESC')->get();
        return view('Admin.user.phanvaitro', compact('user', 'all_column_roles', 'role'));
    }

    public function insert_roles(Request $request, $id){
        $data = $request->all();
        $user = User::find($id);
        //cấp quyền
        $user->syncRoles($data['role']); 
        return redirect()->back()->with('success','Thêm vai trò cho user thành công');
    }

    public function phanquyen($id){
        $user = User::find($id);
        // cấp quyền
        $name_roles = $user->roles->first()->name; 
        $permission = Permission::orderBy('id', 'ASC')->get();
         // lấy ra quyền thông qua vai trò
         $get_permission_via_role = $user->getPermissionsViaRoles(); 
        // dd($get_permission_via_role);
        
        return view('Admin.user.phanquyen', compact('user', 'name_roles', 'permission', 'get_permission_via_role'));
    }
    
    public function insert_permission(Request $request, $id){
        $data = $request->all();
        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        //dd($role_id);
        // Cấp quyền 
        $role = Role::find($role_id); // tìm được quyền dựa vào role_id
        $role->syncPermissions($data['permission']);
         //dd($role);
        return redirect()->back()->with('success','Thêm quyền cho user thành công');
    }

    public function axtra_permission(Request $request){
        $data = $request->all();
        $permission = new Permission();
        $permission->name = $data['permission'];
        $permission->save();

        return redirect()->back()->with('success','Thêm quyền thành công');

    }
}
