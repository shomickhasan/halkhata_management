<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{
    public function index(){
        $userAdmins = Admin::OrderBy('created_at','DESC')->get();
        return view('pages.users.index',compact('userAdmins'));
    }

    public function adminCreate(Request $request){
        $request->validate([
            'name' => 'required|unique:admins,name',
            'email' => 'required|unique:admins,email',
            'password' => 'required',

        ]);


        $adminUser= new Admin;
        $adminUser->name = $request->name;
        $adminUser->slug = Str::slug($request->name);
        $adminUser->email  = $request->email;
        $adminUser->password  = Hash::make($request->password);
        $adminUser->status  = 1;
        $adminUser->save();
        if ($adminUser) {
            $notification = array(
                'message' => 'User Create Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'User Create Failed!',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }//end method

    public function adminUpdate(Request $request){

        $adminUser= Admin::find($request->id);
        $adminUser->name = $request->name;
        $adminUser->slug = Str::slug($request->name);
        $adminUser->email  = $request->email;
        $adminUser->password  = Hash::make($request->password);
        $adminUser->status  = 1;
        $adminUser->update();
        if ($adminUser) {
            $notification = array(
                'message' => 'Admin Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Admin Create Failed!',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }//end method

    //admin delete Method
    public function adminDelete($id){
        $adminUser= Admin::find($id);
        $adminUser->delete();
        if ($adminUser) {
            $notification = array(
                'message' => 'Admin Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Admin Delete Failed!',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }
}
