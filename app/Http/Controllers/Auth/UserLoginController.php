<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\User;
use Hash;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('adminLogout');
    }
    
    public function showLoginForm()
    {   
        $title = "Admin Login";
        return view('layouts.pages.login')->with(compact('title'));
    }

    
    public function login(Request $request)
    {
        $users = User::where('email',$request->email)->first();
        //$usersPassword = Hash::make($request->password);
        //validate data
        $this->validate($request, [
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:6',
        ]);

        if ($users->status == 0) {
             $message = "You are not active for login"; 
            return redirect(route('admin.login'))->with('msg',$message)->withInput();
        }

        /*if (@$users->password != $usersPassword) {
             $message = "<span class='help-block' style='color:#a94442;'><strong>password not matched.</strong></span>"; 
            return redirect(route('admin.login'))->with('passwordMessage',$message)->withInput();
        }*/


        //attemt to log the admin in
        if(Auth::guard('user')->attempt(['email'=> $request->email, 'password'=> $request->password], $request->remember)){
            //if successful, then redirect to their intended location
            return redirect()->intended(route('admin.index'));
        }else{
            $message = "Password not matched"; 
            return redirect(route('admin.login'))->with('passwordMessage',$message)->withInput();
        }

        //if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function adminLogout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect(route('admin.login'));
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
