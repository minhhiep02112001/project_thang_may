<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $role;
    private $permission;
    public function __construct(Role $role , Permission $permission){
        $this->role = $role;
        $this->permission = $permission;
        $this->authorizeResource(Role::class);
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index(Request $request)
    {
        //
        $roles = $this->role->latest()->paginate(10);
        if($request->has('search')){

            $roles = Role::where('name','like',"%{$request->get('search')}%")->orWhere('display_name','like',"%{$request->get('search')}%")->paginate(10);
        }
        $rank = $roles->firstItem();
        return view('admin.roles.index' , compact('roles', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissionParent = $this->permission->where('parent_id' , 0)->get();

        return view('admin.roles.create' , ['permissionParent'=>$permissionParent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'display_name' => 'required',
            'permission'=> 'required'
        ],[
            'name.required'=>'Tên chức vụ không được để trống !!!',
            'name.unique'=>'Tên chức vụ đã tồn tại !!!',
            'name.max'=>'Tên chức vụ  không được quá 255 ký tự!!!',
            'display_name.required'=>'Mô tả chức vụ không được để trống !!!',
            'permission.required'=>'Chức vụ không được để trống !!!'
        ]);

        try{
            DB::beginTransaction();
            $role = $this->role->create([
                'name'=>$request->name,
                'display_name'=>$request->display_name,
            ]);
            $role->permissions()->attach($request->permission);
            DB::commit();
        }catch(\Exception $ex){

            DB::rollback();
        }
        return redirect()->route('roles.index')->with('success','Tạo thành công !!!');
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
    public function edit(Role $role)
    {
        //
        $permissionParent = $this->permission->where('parent_id' , 0)->get();
        $permissionChecked = $role->permissions;
        return view('admin.roles.edit', compact('permissionParent' , 'role' , 'permissionChecked'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$role->id,
            'display_name' => 'required',
            'permission'=> 'required'
        ],[
            'name.required'=>'Tên chức vụ không được để trống !!!',
            'name.unique'=>'Tên chức vụ đã tồn tại !!!',
            'name.max'=>'Tên chức vụ  không được quá 255 ký tự!!!',
            'display_name.required'=>'Mô tả chức vụ không được để trống !!!',
            'permission.required'=>'Chức vụ không được để trống !!!'
        ]);

        try{
            DB::beginTransaction();
            $role->update([
                'name'=>$request->name,
                'display_name'=>$request->display_name,
            ]);
            $role->permissions()->sync($request->permission);
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
        }
        return redirect()->route('roles.index')->with('success','Sửa thành công !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
     {
        //

        $status = $text = $iconColor = '';
        if($role->delete()){
            $status='success';
            $text='Xóa thành công';
            $iconColor = 'green';
        }else{
            $status='error';
            $text='Xóa không thành công';
            $iconColor = 'red';
        }
        return response()->json([
            'icon'=>$status,
            'text'=>$text,
            'iconColor' => $iconColor
        ]);
    }
}
