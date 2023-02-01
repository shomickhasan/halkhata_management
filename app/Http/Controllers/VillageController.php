<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;
use Illuminate\Support\Str;
use App\Models\Laid;

class VillageController extends Controller
{
    public function index(){
        $village= Village::Orderby('created_at', 'DESC')->get();
        return view('pages.village',compact('village'));
    }//end method

    public function Store(Request $request){
        $request->validate([
            'name' => 'required|unique:villages,village_name',
        ]);
        $village = new  Village;
        $village->village_name = $request->name;
        $village->village_slug = Str::slug($request->name);
        $village->save();
        if ($village) {
            $notification = array(
                'message' => 'নতুন গ্রাম যোগ হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'নতুন গ্রাম যোগ হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }

    public function Edit(Request $request){
        $village= Village::find($request->id);
        $village->village_name = $request->name;
        $village->village_slug = Str::slug($request->name);
        $village->update();
        if ($village) {
            $notification = array(
                'message' => ' গ্রাম আপডেট হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'গ্রাম আপডেট হযনাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }

    public function Delete($id){
        $village = Village::find($id);
        $village->delete();
        if ($village) {
            $notification = array(
                'message' => ' গ্রাম ডিলিট হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'গ্রাম ডিলিট হযনাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }//end method

    //leads management function start here

    public function LeadIndex(){
        $village=Village::all();
        $laids =Laid::with('village')->OrderBy('created_at','ASC')->get();
        return view('pages.laid',compact('laids','village'));
    }

    public function LaidStore(Request $request){
        $request->validate([
            'name' => 'required|unique:laids,laid_name',
            'village_id' => 'required',
        ]);
        $laid = new  Laid;
        $laid->laid_name = $request->name;
        $laid->slug = Str::slug($request->name);
        $laid->village_id = $request->village_id;
        $laid->save();
        if ($laid) {
            $notification = array(
                'message' => 'নতুন গ্রাম যোগ হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'নতুন গ্রাম যোগ হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }//end method

    public function LaidUpdate(Request $request){


        $laid= Laid::find($request->id);
        $laid->laid_name = $request->name;
        $laid->slug = Str::slug($request->name);
        $laid->village_id = $request->village_id;
        $laid->update();
        if ($laid) {
            $notification = array(
                'message' => ' গ্রাম আপডেট হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'গ্রাম আপডেট  হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }//end method

    public function LaidDelete($id){
        $laid= Laid::find($id);
        $laid->delete();
        if ($laid) {
            $notification = array(
                'message' => ' গ্রাম ডিলিট হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'গ্রাম ডিলিট হযনাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }



}
