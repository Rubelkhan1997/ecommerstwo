<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customerprofile;
use App\Sale;
use App\Billing_detail;
use App\Card;
use Auth;
use Carbon\Carbon;
class CustomerController extends Controller
{
    function customerdashbord(){
     $products = Sale::where('user_id', Auth::id())->count() ;
      return view('customer/dashbord', compact('products'));
    }
    function customerprofileform(){
      return view('customer/profileform');
    }
    function customerprofileformpost(Request $request){
      $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'address'   => 'required',
        'phone_number'=> 'required',
        'zip_code'  => 'required',
      ]);
      Customerprofile::insert([
        'user_id' => Auth::user()-> id,
        'first_name' => $request-> first_name,
        'last_name' => $request-> last_name,
        'address' => $request-> address,
        'phone_number' => $request-> phone_number,
        'zip_code' => $request-> zip_code,
        'created_at' => Carbon::now(),
      ]);
      return back()->with('add','Information Added Successfully');
    }
    function customerprofileformupdatepost(Request $request){
      Customerprofile::where('user_id', Auth::user()-> id)->update([
        'first_name' => $request-> first_name,
        'last_name' => $request-> last_name,
        'address' => $request-> address,
        'phone_number' => $request-> phone_number,
        'zip_code' => $request-> zip_code,
        ]);
        return back()->with('update','Information Updated Successfully');
    }
    function customerorder(){
      $all_orders = Sale::where('user_id', Auth::id())->get();
      return view('customer/coustomerorderlist' , compact('all_orders'));
    }
    function customerproductview($shipping_id){
     $shipping_id = Sale::where('shipping_id', $shipping_id)->first()->shipping_id;
     $product_orders = Billing_detail::where('sale_id',$shipping_id)->get();
      return view('customer/customerproductview',compact('product_orders'));
    }
}
