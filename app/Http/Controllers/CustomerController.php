<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Village;
use App\Models\Laid;
use Illuminate\Support\Str;
use PDF;

class CustomerController extends Controller
{
    public function Index(){
        $village=Village::all();
        $laid= Laid::all();
        $customer = Customer::with('village', 'laid')->OrderBy('laids_id','ASC')->get();
        return view('pages.customer',compact('customer','village','laid'));
    }
    public function CustomarStore(Request $request){
        $request->validate([
            'english_name' => 'required',
            'bangla_name' => 'required',
            'village_id' => 'required',
            'laid_id' => 'required',
            'total_due' => 'required',
        ]);
        $customer = new Customer();
        $customer->customer_name= $request->bangla_name;
        $customer->customer_english_name= $request->english_name;
        $customer->slug= Str::slug($request->english_name);
        $customer->customer_relations= $request->customer_relations;
        $customer->village_id= $request->village_id;
        $customer->laids_id= $request->laid_id;
        $customer->privious_total_due= $request->total_due;
        $customer->save();
        if ($customer) {
            $notification = array(
                'message' => 'নতুন কাস্টমার যোগ হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'নতুন কাস্টমার যোগ হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }
    public function CustomarEdit(Request $request){

        $customer= Customer::find($request->id);
        $customer->customer_name= $request->bangla_name;
        $customer->customer_english_name= $request->english_name;
        $customer->slug= Str::slug($request->english_name);
        $customer->customer_relations= $request->customer_relations;
        $customer->village_id= $request->village_id;
        $customer->laids_id= $request->laid_id;
        $customer->privious_total_due= $request->total_due;
        $customer->update();
        if ($customer) {
            $notification = array(
                'message' => 'নতুন কাস্টমার আপডেট হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'নতুন কাস্টমার আপডেট হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function CustomarDelete($id){
        $customer= Customer::find($id);
        $customer->delete();
        if ($customer) {
            $notification = array(
                'message' => ' কাস্টমার ডিলিট হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => ' কাস্টমার ডিলিট হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);

    }
    //halkhata
    public function HalkhataView(){
        $customer = Customer::with('village', 'laid')->OrderBy('laids_id','ASC')->OrderBy('created_at','ASC')->get();
        return view('pages.halkhata',compact('customer'));
    }
    public function HalkhataStore(Request $request){
        $request->validate([
            'payment' => 'required',
        ]);
        $halkhata = Customer::find($request->id);
        $halkhata->payment = $request->payment;
        $halkhata->status=1;
        $currentDue= $halkhata->privious_total_due - $request->payment;
        $halkhata->current_due =  $currentDue;
        $halkhata->update();
        if ($halkhata) {
            $notification = array(
                'message' => ' হালখাতা সম্পন্ন হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => ' হালখাতা সম্পন্ন হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    //halkhata edit method
    public function HalkhataEdit($id){
        $customer= Customer::find($id);
        return view('pages.halkhataEdit',compact('customer'));
    }//end method

    public function HalkhataUpdate(Request $request){
        $halkhata = Customer::find($request->id);
        $halkhata->payment = $request->payment;
        $currentDue= $halkhata->privious_total_due - $request->payment;
        $halkhata->current_due =  $currentDue;
        $halkhata->update();
        if ($halkhata) {
            $notification = array(
                'message' => ' হালখাতা আপডেট সম্পন্ন হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => ' হালখাতা আপডেট সম্পন্ন হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->route('customer.HalkhataView')->with($notification);

    }//end method

    public function HalkhataCancle($id){
        $halkhata =Customer::find($id);
        $halkhata->payment =0;
        $halkhata->status=0;
        $halkhata->current_due =0;
        $halkhata->update();
        if ($halkhata) {
            $notification = array(
                'message' => ' হালখাতা বাতিল সম্পন্ন হযেছে',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => ' হালখাতা বাতিল সম্পন্ন হয়নাই',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->route('customer.HalkhataView')->with($notification);

    }
     public function GenaratePdf(){
        $data = Customer::with('village', 'laid')
                  ->OrderBy('laids_id','ASC')
                  ->OrderBy('created_at','ASC')
                  ->get();
        $fileName = 'Halkhata_document.pdf';
        $mpdf = new \Mpdf\Mpdf([
            'format'                     => 'A4',
            'default_font_size'          => '16',
            'default_font'               => 'nikosh',
            'margin_left'                => 10,
            'margin_right'               => 10,
            'margin_top'                 => 10,
            'margin_bottom'              => 10,
            'margin_header'              => 0,
            'margin_footer'              => 0,
        ]);
        $html = \View::make('pages.report')->with('data',$data);
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');


    }


}
