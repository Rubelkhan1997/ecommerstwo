<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;
class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolechecker');
    }
    function couponinsertform(){
      $coupon_infor = Coupon::all();
      return view('coupon/couponinsertform', compact('coupon_infor'));
    }
    function couponinsertformpost(Request $request){
      $request->validate([
        'coupon_name'=> 'required',
        'discount_amount'=> 'required|numeric',
        'valid_till'=> 'required',
      ],
      [
        'coupon_name.required'=> "Enter Your Coupon Name",
        'discount_amount.required'=> "Enter Your Discount Amount",
        'valid_till.required'=> "Enter Your Valid Till Date",
      ]);

      $request->validate([
        'coupon_name'=>'unique:coupons,coupon_name',
        'discount_amount'=>'numeric|max:70',
      ]);

      Coupon::insert([
        'coupon_name'=> $request-> coupon_name,
        'discount_amount'=> $request-> discount_amount,
        'valid_till'=> $request-> valid_till,
        'created_at'=> Carbon::now(),
      ]);
      return back()->with('status', ' Coupon  Add Successfully');
    }
    function coupanitemdelete($coupon_id){
      Coupon::find($coupon_id)->delete();
      return back()->with('delete','Copon Deleted Successfully');
    }
}
