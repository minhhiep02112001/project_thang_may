<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Role;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(User::class , 'tai_khoan');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index(Request $request)
    {
        //
        $users = User::latest()->paginate(10);
        if($request->has('search')){

            $users = User::where('name','like',"%{$request->get('search')}%")->orWhere('email','like',"%{$request->get('search')}%")->paginate(10);
        }
        $rank = $users->firstItem();
        return view('admin.users.index' , compact('users', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();

        return view('admin.users.create' , compact('roles'));
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

        $validated = $request->validate(
            [
                'name' => "required|max:255",
                'avatar' => 'mimes:jpg,png,jpeg,gif,svg',
                'email' => 'required|unique:users,email|max:255',
                'password' => 'required|min:6|max:255',
                'roles' => 'required'
            ],
            [
                'name.required'=> 'Tên không được để trống !!!',
                'name.max' => 'Tên không được quá 255 ký tự !!!',
                'avatar.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
                'email.required'=> 'Email không được để trống !!!',
                'email.unique' => 'Email đã tồn tại !!!',
                'email.max' => 'Email không được quá 255 ký tự !!!',
                'password.required'=> 'Mật khẩu không được để trống !!!',
                'password.min' => 'Mật khẩu min : 6 ký tự  !!!',
                'password.max' => 'Mật khẩu max : 255 ký tự !!!',
                'roles.required' => 'Chức vụ quản trị chưa được chọn !!!',
            ]
        );

        $image = '';
        if ($request->hasFile('avatar')) {
            // code...
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName();
            while(file_exists("./uploads/users/$fileName")){
                $fileName = str_random(10).$fileName;
            }
            $file->move('./uploads/users',$fileName);
            $image = "./uploads/users/$fileName";
        }
        try{
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'avatar' => $image,
                'is_active'=>($request->has('is_active'))? 1 : 0,
                'is_admin' => $request->is_admin,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if(!$request->is_admin){
                $user->roles()->attach($request->roles);
            }

            DB::commit();
        }catch(\Exception $ex){
            dd($ex);
            if(file_exists($image)){
                unlink($image);
            }
            DB::rollback();
        }
        return redirect()->route('tai-khoan.index')->with('success','Thêm thành công !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $tai_khoan)
    {
        //

        $roles = Role::all();
        $user_roles = $tai_khoan->roles()->get()->pluck('id');
        return view('admin.users.edit',[
            'user'=>$tai_khoan ,
            'roles' => $roles,
            'user_roles'=> $user_roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $tai_khoan)
    {
        //


        $validated = $request->validate(
            [
                'name' => "required|max:255",
                'avatar' => 'mimes:jpg,png,jpeg,gif,svg',
                'email' => "required|unique:users,email,$tai_khoan->id|max:255",
                'password' => 'max:255',

            ],
            [
                'name.required'=> 'Tên không được để trống !!!',
                'name.max' => 'Tên không được quá 255 ký tự !!!',
                'avatar.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
                'email.required'=> 'Email không được để trống !!!',
                'email.unique' => 'Email đã tồn tại !!!',
                'email.max' => 'Email không được quá 255 ký tự !!!',
                'password.max' => 'Mật khẩu max : 255 ký tự !!!',

            ]
        );

        if($request->has('password') && strlen($request->password) < 6){
            return redirect()->back()->with('err_psw','Mật khẩu min:6 ký tự');
        }

        $old_image = $tai_khoan->avatar;
        $image = '';
        if ($request->hasFile('avatar')) {
            // code...
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName();
            while(file_exists("./uploads/users/$fileName")){
                $fileName = str_random(10).$fileName;
            }
            $file->move('./uploads/users',$fileName);
            $image = "./uploads/users/$fileName";
        }

        $arr =[
            'name' => $request->name,
            'is_active'=>($request->has('is_active'))? (boolean)1 : (boolean)0,
            'avatar' => ($image != '') ? $image : $old_image,
            'is_admin' => $request->is_admin ? (boolean)1 : (boolean)0,
            'email' => $request->email
        ];

        if($request->has('password')){
            $arr['password'] = Hash::make($request->password);
        }
        try{
            DB::beginTransaction();
            $tai_khoan->update($arr);
            if(!$request->is_admin){

                $tai_khoan->roles()->detach();
            }else{
                $tai_khoan->roles()->sync($request->roles);
            }
            DB::commit();
            if($image!=''){
                if(file_exists($old_image)){
                    unlink($old_image);
                }
            }
        }catch(\Exception $ex){
            dd($ex);
            if($image!=''){
                if(file_exists($image)){
                    unlink($image);
                }
            }
            DB::rollback();
        }
        return redirect()->route('tai-khoan.index')->with('success','Sửa thành công !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $tai_khoan)
    {
        $old_image = $tai_khoan->avatar;
        $status = $text = $iconColor = '';
        if($tai_khoan->delete()){
            @unlink($old_image);
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
        ] , 200);
    }
}
