<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginAdminRequest;
class LoginAdminController extends Controller
{
    //
    public function index()
    {
        // code...
        if(Auth::check()){
            return redirect()->route('admin.home');  
        }
        return view('admin.login');
    }

    public function postLogin(LoginAdminRequest $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($data , $request->has('remember'))) {
            // code...
            return redirect()->route('admin.home')->with('success','Đăng nhập thành công !!!');
        }else{
            return redirect()->route('admin.login')->withInput()->with('msg','Tài khoản hoặc mật khẩu không chính xác !!!');
        }
    }

    public function logout()
    {
        // code...
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
