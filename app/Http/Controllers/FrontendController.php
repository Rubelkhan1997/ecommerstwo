<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Card;
use Carbon\Carbon;
use App\Country;
use App\City;
use App\Shipping;
use App\Sale;
use App\Slider;
use App\User;
use App\Billing_detail;
use Auth;
use Session;

class FrontendController extends Controller
{
    function index(){
      $categories = Category::all();
      $products = Product::all();
      $sliders = Slider::all();
      return view('welcome', compact('products', 'categories', 'sliders'));
    }
    function contact(){
      return view('contact');
    }
    function productdetails($product_id){

      $singleproduct = Product::find($product_id);
      $all_product_info = Product::where('categorie_id', $singleproduct -> categorie_id)->where('id','!=', $product_id)-> get();
      return view('productdetails', compact('singleproduct','all_product_info'));
    }

    function categorypageview($categorty_id){
    $products = Product::where('categorie_id',$categorty_id)->get();
      return view('categoryviewproduct', compact('products'));
    }
    function addtocard($product_id){
      $ip_adderss = $_SERVER['REMOTE_ADDR'];

      if (Card::where('customer_ip', $ip_adderss)-> where('product_id', $product_id)->exists()) {
        Card::where('customer_ip', $ip_adderss)-> where('product_id', $product_id)->increment('product_quantity', 1);
         return back();
      }
      else {
        Card::insert([
          'customer_ip'=> $ip_adderss,
          'product_id'=> $product_id,
          'created_at'=> Carbon::now(),
        ]);
        return back();
      }
    }
    function customerregistationform(){
      return view('customerregistationform');
    }
    function customerregistationformpost(Request $request){
      User::insert([
        'name'=> $request-> name,
        'email'=> $request-> email,
        'password'=> bcrypt($request-> password),
        'role'=> 2,
        'created_at'=> Carbon::now(),
      ]);
      return back();
    }
    function checkout(Request $request){
     $total_amount =  $request->total_amount;
      $countris = Country::all();
      return view('checkout' , compact('countris','total_amount'));
    }
    function shippingaddress(Request $request){

      $shipping_id = Shipping::insertGetId([
        'user_id'=> Auth::id(),
        'first_name'=> $request-> first_name,
        'last_name'=> $request-> last_name,
        'last_name'=> $request-> last_name,
        'country_id'=> $request-> country_id,
        'city_id'=> $request-> city_id,
        'address'=> $request-> address,
        'zip_code'=> $request-> zip_code,
        'phone_number'=> $request-> phone_number,
        'payment_type'=> $request-> payment_type,
        'payment_status'=> 1,
        'created_at'=> Carbon::now(),
      ]);
      $sale_id = Sale::insertGetId([
        'user_id'=> Auth::id(),
        'shipping_id'=> $shipping_id,
        'total_amount'=> $request-> total_amount,
        'created_at'=> Carbon::now(),
      ]);
       $ip_adderss = $_SERVER['REMOTE_ADDR'];
       $card_items = Card::where('customer_ip', $ip_adderss)->get();
       foreach ($card_items as $card_item) {
         Billing_detail::insert([
           'user_id' => Auth::id(),
           'sale_id' => $sale_id,
           'product_id' => $card_item->product_id,
           'product_price' => Product::find($card_item->product_id)->product_price,
           'product_quantity' => $card_item->product_quantity,
           'created_at' => Carbon::now(),
         ]);
         Product::find($card_item->product_id)->decrement('product_quantity', $card_item->product_quantity);
         $card_item->delete();
       }
      if ($request-> payment_type == 1) {
        Session::flash('success_cod', 'Your Order Placed Successfully!');
        return redirect('card/page');
      }
      elseif ($request-> payment_type == 2) {
        $total_amount = $request-> total_amount;
        return redirect('stripe')->with('total_amount', $total_amount)->with('shipping_id',$shipping_id);
      }
    }
    function citylist(Request $request){
      $stringTosend = "<option>-Select One-</option>";
      $cities = City::where('country_id', $request->country_id)->get();
      foreach ($cities as $city) {
        $stringTosend .= "<option value='".$city->id."'>".$city->name."</option>";
      }
      echo $stringTosend;
    }
}
