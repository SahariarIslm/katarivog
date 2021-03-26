<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use Illuminate\Http\Request;
use App\Model\User;

class UserForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function passwordForget(){
      $title = "Forget Password";
      return view('layouts.pages.forget_password')->with(compact('title'));
    }

    public function passwordEmail(Request $request){
            $email = $request->email;
            $this->validate($request, [
            'email'=>'required|email|exists:users,email',
        ],
        [
            'email.exists'=>'The email is not exist',
        ]);

            //@$password = $customerEmail->storePassword;

            /*$soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl"); 
            $paramArray = array( 
                'userName' => "01832967276", 
                'userPassword' => "3e3198", 
                'messageText' => "Your Driver Vara Password:".$password, 
                'numberList' => $phone, 
                'smsType' => "TEXT", 
                'maskName' => 'DemoMask', 
                'campaignName' => '', );                         
*/              
                $user = Admin::where('email',$email)->first();
                if(@$user){
                  $request->_token = $request->_token.$email.rand(100000000,999999999);
                  $user->update( [
                    'token' => $request->_token,               
                  ]);
                }
                
                $message = "<p style='display:inline-block;width:auto;' class='alert alert-success'>Check your email inbox or spam</p>"; 
                $subject = "Your Password Reset Link";
            
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <piqood@web.com>' . "\r\n";
                $headers .= 'Cc: superbnexus@gmail.com' . "\r\n";
                
               $link = "Your password reset link ".url('/admin/new-password/'.$email.'/'.$request->_token);
               
              mail($email, $subject, $link);
            return redirect(route('admin.password.forget'))->with('msg',$message)->withInput();
          

        }

        public function newPassword($email,$token){
          @$users = Admin::where('email',$email)->where('token',$token)->first();
          if ($users) {
            return view('layouts.pages.reset_password',['users'=>$users]);
          }else{
            return redirect(route('admin.login'));
          }

        }

        public function changePasswordSave(Request $request){
          $this->validate($request,[
              'password' => 'required|min:6|same:password_confirmation',
              'password_confirmation' => 'required|min:6'
              ]

              );
          $users = Admin::where('email',$request->email)->first();
          $admin = Admin::find($users->id);
          $admin->password = bcrypt($request->password);
          $admin->save();
          $message = "<h5 style='display:inline-block;width:auto;text-align:center;' class='alert alert-success'>Your Password Reset Complete</h5>"; 
        return redirect(route('admin.login'))->with('msg',$message)->withInput();
      }
}
