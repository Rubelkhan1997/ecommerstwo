<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Card;
use App\Coupon;
use Carbon\Carbon;
class CardController extends Controller
{

    function cardpage($coupon_name = ""){
      if ( $coupon_name == "") {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $card_items = Card::where('customer_ip', $ip_address)->get();
        $coupon_amount = 0;
        return view('cardpage', compact('card_items', 'coupon_amount', 'coupon_name'));
      }
      else {
        if (Coupon::where('coupon_name' , $coupon_name )->exists()) {
          if (Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_name' , $coupon_name )->first() -> valid_till) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $card_items = Card::where('customer_ip', $ip_address)->get();
            $coupon_amount = Coupon::where('coupon_name' , $coupon_name )->first() -> discount_amount	;
              return view('cardpage', compact('card_items', 'coupon_amount', 'coupon_name'));
           }
           else {
             print "non Valide";
           }
        }
        else {
          echo "coupan nai";
        }
      }

    }
    function cardclear(){
      $ip_address = $_SERVER['REMOTE_ADDR'];
      Card::where('customer_ip', $ip_address)->delete();
      return back();
    }
    function singleproductdelete ($product_id){
      Card::find($product_id)->delete();
      return back();
   }
   function cardupdate(Request $request){

     $ip_adderss = $_SERVER['REMOTE_ADDR'];
     foreach ($request->product_id as $key => $product_id) {
       if ( Product::find($product_id)->product_quantity >= $request->customer_quantity[$key]) {
         Card::where('customer_ip', $ip_adderss)-> where('product_id', $product_id)->update([
           'product_quantity' => $request->customer_quantity[$key],
         ]);
       }
     }
     return back();
   }
}
