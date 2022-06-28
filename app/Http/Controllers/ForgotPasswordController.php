<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon; 
use Mail;
use Hash;
use Auth;
use DB;
class ForgotPasswordController extends Controller
{
    //
    public function index(){
        return view('auth.password_reset');
    }

    public function submitForgetPasswordForm(Request $request){

        $request->validate([
           'email' => 'required|email|exists:users',
        ]);

        $token = str_random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('mail.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'Vui lòng check email để thay đổi mật khẩu');
    }
    
    public function showResetPasswordForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);
  
        $updatePassword = DB::table('password_resets')->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])->first();
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
  
        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
 
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        
        if(Auth::check() || Auth::guard('customer')->check()){
            Auth::logout();
            Auth::guard('customer')->logout();

        }
        return back()->with('message', 'Thay đổi mật khẩu thành công');
      }
}
