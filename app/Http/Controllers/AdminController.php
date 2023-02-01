<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    //show login page
    public function loginPage(){
        return view('auth.login');
    }//end method

    //dashboard show nethod
    public function Dashboard(){
        return view('pages.dashboard');
    }//end method

    //login method
    public function Login(Request $request){
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            $notification = array(
                'message' => 'Login Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
           return redirect()->route('app.dashboard')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Email or Password invalid',
                'alert-type' => 'error',
            ); // returns Notification,
           return redirect()->back()->with($notification);
        }
    }//end loginmethod

    //logout start method
    public function Logout(){
        $logout = Auth::guard('admin')->logout();
        if( $logout){
            $notification = array(
                'message' => 'Logout Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
           return redirect()->route('admin.login')->with($notification);
        }
         else{
                $notification = array(
                    'message' => 'Logout failed',
                    'alert-type' => 'error',
                ); // returns Notification,
               return redirect()->back()->with($notification);
            }


    }//end method

     // Application Cache Clear Methord
     public function cacheClear()
     {
         Artisan::call('cache:clear');
         $notification = array(
             'message' => 'Application Cache Clear',
             'alert-type' => 'success',
         ); // returns Notification,

         return redirect()->back()->with($notification);
     }//end method

}
